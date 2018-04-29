<?php
class Login_model extends Model
{
    //Construction sur le model du parent qui est Model.
    public function __construct()
    {
        parent::__construct();
    }

    public function signin()
    {
        //Déclaration des var.
        $error = 0;
        $msgs[] = array();

        $pseudo = $_POST['signinPseudo'];
        $pass = $_POST['signinPass'];

        //Comparaison des données saisies avec celles de la Bdd.
        $req = $this->db->prepare('SELECT id, pseudo, pass FROM visitors WHERE pseudo = :pseudo');
        $req->execute(array(
        'pseudo' => $pseudo));
        $resultat = $req->fetch();

        //Appel de la fonction pour compter le nb de tentatives de connexion.
        Session::trySignin();
        $max = 3;
        $val = $max - Session::get('tries') +1;

        //Si erreur de pseudo ou mdp, msg d'erreur qui s'affiche + décompte de nombre d'essais restants.
        //Sinon connexion et création d'une session(qui récupère le pseudo et le rôle).
        if (Session::get('tries') > $max) {
            $msgs['message13'] = "Vous avez dépassé le nombre de tentative de connexion. Veuillez réesayer daans 30 min.";
            $error = 1;
        } elseif (password_verify($pass, $resultat['pass'])) {
            $msgs["message11"] =" Bienvenue " . $pseudo . ", bonne visite !";
            Session::init(); //sans ceci cela ne marche pas
            Session::authenticate($pseudo, $resultat['id']);
        } else {
            $msgs["message10"] = " Erreur, mauvais identifiant ou mauvais mot de passe ! Il vous reste " .  $val . " essais ";
            $error = 1;
        }
        //Retourne les msgs sous forme d'objets JSON pour pouvoir les traiter en JS.
        echo json_encode($msgs);
        return true;
    }


    public function signup()
    {
        $error = 0;
        $msgs[] = array();

        $secret = '6Lc0LU0UAAAAAJUMPZb2bOwSonrx52xRz6Bn5sDc';
        $sitekey = '6Lc0LU0UAAAAAOW7crKFnGiOnZAyYWa9-bJzDK2l';
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $response = $_POST['g-recaptcha-response'];

        $api_url = "https://www.google.com/recaptcha/api/siteverify?secret=". $secret. "&response=" . $response. "&remoteip=" . $remoteip;
        $decode = json_decode(file_get_contents($api_url), true);

        if ($decode['success'] == false) {
            $msgs["message8"] = "Vous n'avez pas réussi l'épreuve Recaptcha, prenez votre flambeau et rejoignez moi !";
            $error = 1;
        }

        $non_droit = empty($_POST['droitAuteur']);
        if ($non_droit) {
            $msgs["message8"] ="Vous devez accepter les conditions";
            $error = 1;
        }
        $pseudo = $_POST['signupPseudo'];
        //Convertit les caractères spéciaux en entités HTML.
        $pseudo = htmlspecialchars($pseudo);
        if (!isset($pseudo) || !preg_match("#^[a-z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ@_&]{3,16}+$#i", $pseudo)) {
            $msgs["message3"] ="Le pseudo n'est pas valide : il doit contenir entre 3 et 16 caractères et se composer de chiffres, de lettres, de lettres accentués ou de ces signes : @  _ &";
            $error = 1;
        }

        //On vérifie si le champs est rempli et la validité de l'email. Si pb, on retourne un msg d'erreur.
        $email = $_POST['signupMail'];
        //Convertit les caractères spéciaux en entités HTML.
        $email = htmlspecialchars($email);
        if (!isset($email) || !preg_match("#^[a-z0-9._-]+@[a-z0-9._\-]{2,10}\.[a-z]{2,4}$#i", $email)) {
            $msgs["message4"] = "L'adresse mail n'est pas valide, elle doit se composer comme ceci : exemple@bla.com";
            $error = 1;
        }

        //On vérifie si le champs est rempli et la validité du mdp. Si pb, on retourne un msg d'erreur.
        $passbrut = $_POST['signupPass'];
        //Convertit les caractères spéciaux en entités HTML.
        $passbrut = htmlspecialchars($passbrut);
        if (!isset($passbrut) || !preg_match("#^[a-z0-9ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ@_&/(){}]{3,16}+$#", $passbrut)) {
            $msgs["message5"] = "Le mot de passe n'est pas valide : il doit contenir entre 3 et 16 caractères et se composer de chiffres, de lettres ou de ces signes : _ & / () {} )";
            $error = 1;
        }
        //Hachage du mdp pour le sécuriser.
        $passbrut = password_hash($passbrut, PASSWORD_DEFAULT);

        //Si un des champs est vide, msg d'erreur.
        if (empty($_POST['signupPseudo']) ||
                empty($_POST['signupMail']) ||
                empty($_POST['signupPass']) ||
                !filter_var($_POST['signupMail'], FILTER_VALIDATE_EMAIL)) {
            $msgs["message2"] = "Aucune donnée n'a été fournie !";
            $error = 1;
        }


        //On vérifie que les données ne sont pas déjà utilisées dans la bdd.
        //Si on a un résultat, cela veut dire qu'il est déjà utilisé donc msg d'erreur.
        $req = $this->db->prepare('SELECT pseudo FROM visitors WHERE pseudo = :pseudo');
        $req->execute(array(
                'pseudo' => $pseudo));

        $res = $req->fetch();
        if ($res) {
            $msgs["message6"] = "Le pseudo est déjà utilisé, veuillez en choisir un nouveau!";
            $error = 1;
        }

        $req = $this->db->prepare('SELECT mail FROM visitors WHERE mail = :mail');
        $req->execute(array(
                'mail' => $email));

        $res = $req->fetch();
        if ($res) {
            $msgs["message7"] = "L'adresse mail est déjà utilisée, veuiller recommencer!";
            $error = 1;
        }

        //Si les données sont disponibles, on les insère dans la bdd et on début une session.
        if ($error == 0) {
            try {
                $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $req = $this->db->prepare('INSERT INTO visitors (pseudo, mail, pass) VALUES(:pseudo, :mail, :pass)');
                $req->execute(array(
                  'pseudo' => $pseudo,
                  'mail' => $email,
                  'pass' => $passbrut));
                $msgs["message1"] = "L'inscription est validée, bienvenue sur notre site " . $pseudo;
                Session::init();
                Session::authenticate($pseudo, $this->db->lastInsertId());
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        echo json_encode($msgs);
        return true;
    }

    public function disconnect()
    {
        //Réinitialisatin de la session ( lui assigner un array vide = la remettre à 0)
        $_SESSION = array();

        //On modifie les paramètres du cookie de session pour pouvoir la supprimer.
        if (ini_get('session.use_cookies')) {
            $param = session_get_cookie_params();
            setcookie(session_name(), '', time()-42000, $param['path'], $param['domain'], $param['secure']);
        }
        //Suppression et redirection.
        session_destroy();
        header('Location: ../home');
    }

    public function accept()
    {
        $id_event = $_POST['id'];
        $user = Session::get('id');

        $req = $this->db->prepare('INSERT INTO attendance (id_user, id_event, role) VALUES(:id_user, :id_event, :role )');
        $req->execute(array(
                  'id_user' => $user,
                  'id_event' => $id_event,
                  'role' => 2 ));
    }

    public function generateLog()
    {
        $mail = $_POST['mail'];

        $req = $this->db->prepare('SELECT id FROM visitors WHERE mail = :mail');
        $req->execute(array(
        "mail" => $mail));
        $res = $req->fetch();

        $hash = md5(random_bytes(16));

        $req = $this->db->prepare('INSERT INTO recovery (id_user, hash) VALUES(:id_user, :hash)');
        $req->execute(array(
              'id_user' => $res['id'],
              'hash' => $hash ));

        $body = "Vous avez demandé une réinitialisation de votre mot de passe.\n\n"."Veuillez suivre ce lien pour choisir votre nouveau mot de passe:\n\n". "http://projet3.projetsdwjguilloux.ovh/projet5/Login/recovery/" . $hash ."";
        $headers = "From: noreply@yprojetsdwjguilloux.ovh\n";
        $headers .= "Reply-To: noreply@yprojetsdwjguilloux.ovh\n" ;

        mail($mail, "Demande de récupération de mot de passe", $body, $headers);
    }

    public function recovery($hash)
    {
        $req = $this->db->prepare('SELECT id_user FROM recovery WHERE hash = :hash');
        $req->execute(array(
              'hash' => $hash));
        $res = $req->fetch();
        return $res;
    }

    public function updateLog()
    {
        $req = $this->db->prepare('SELECT id_user FROM recovery WHERE hash = :hash');
        $req->execute(array(
            'hash' => $_POST['id']));
        $res = $req->fetchAll();

        $id = $res[0]['id_user'];
        echo 'coucou '. $id;

        $pass = $_POST['pass'];
        echo $pass;
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $req = $this->db->prepare('UPDATE visitors SET pass = :pass WHERE id = :id');
        $req->execute(array(
        'id' => $id,
        'pass' => $pass));

        $req = $this->db->prepare('DELETE FROM recovery WHERE id_user = :id_user');
        $req->execute(array(
        'id_user' => $id));
    }
}
