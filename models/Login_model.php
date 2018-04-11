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
        if (!$resultat) {
            $msgs["message10"] = " Erreur, mauvais identifiant ou mauvais mot de passe !";
            $error = 1;
        } elseif (password_verify($pass, $resultat['pass'])) {
            $msgs["message11"] =" Bienvenue " . $pseudo . ", bonne visite !";
            Session::init(); //sans ceci cela ne marche pas
            Session::authenticate($pseudo, $resultat['id']);
        }
        //Retourne les msgs sous forme d'objets JSON pour pouvoir les traiter en JS.
        echo json_encode($msgs);
        return true;
    }


    public function signup()
    {
        $error = 0;
        $msgs[] = array();
        //On vérifie si le champs est rempli et la validité du pseudo. Si pb, on retourne un msg d'erreur.
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
}
