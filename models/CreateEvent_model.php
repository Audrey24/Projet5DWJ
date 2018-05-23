<?php
class CreateEvent_model extends Model
{
    //Construction sur le model du parent qui est Model.
    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        Session::init();
        $user = Session::get('id');

        print_r($_POST);
        //On récupère le mail associé à l'id de l'user connecté pour envoyer le mail de confirmation.
        $req = $this->db->prepare('SELECT mail FROM visitors WHERE id = :id');
        $req->execute(array('id' => $user));
        $res = $req->fetch();

        //Traitement des données.
        $title = htmlspecialchars($_POST['title']);
        $color = htmlspecialchars($_POST['color']);

        //Insert en BDD les données du formulaire
        $req = $this->db->prepare('INSERT INTO event (title, background_color) VALUES(:title, :background_color)');
        $req->execute(array(
                  'title' => $title,
                  'background_color' => $color));

        $id_event = $this->db->lastInsertId();
        echo($id_event);
        $req = $this->db->prepare('INSERT INTO attendance (id_user, id_event, role) VALUES(:id_user, :id_event, :role)');
        $req->execute(array(
                    'id_user' => $user,
                    'id_event' => $id_event,
                    'role' => 1));

        //Envoi d'un mail de confirmation de création de l'evt.
        $recipient = 'guilloux.audrey24@gmail.com';
        $email_address = strip_tags(htmlspecialchars($res['mail']));

        $to = $email_address;
        $email_subject = "Création évènement sur Souvenirs d'un jour";
        $email_body = "Vous avez récemment crée un évènement sur Souvenirs d'un jour. Nous vous remercions de votre confiance !
          \n\n". "Attention, si votre évènement n'est pas actif dans un mois, il sera supprimé ! (Un évènement actif est un évènement contenant des photos.)\n\n".
          "Merci de votre compréhension et bonne navigation sur notre site !\n\n"."Souvenirs d'un jour";
        $headers = "From: noreply@yprojetsdwjguilloux.ovh\n";
        $headers .= "Reply-To: noreply@yprojetsdwjguilloux.ovh\n";
        mail($to, $email_subject, $email_body, $headers);

        $backImg = Utils::decode_base64($_POST["backgroundImg"]);

        mkdir("eventsData/{$id_event}/", 0777, true);
        $nom = "eventsData/{$id_event}/backgroundImg.jpg";
        $resultat = file_put_contents($nom, $backImg);
        if ($resultat) {
            echo "Transfert réussi";
        }
    }
}
