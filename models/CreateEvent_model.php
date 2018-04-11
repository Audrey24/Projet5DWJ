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
        $id = Session::get('id');

        //On récupère le mail associé à l'id de l'user connecté pour envoyer le mail de confirmation.
        $req = $this->db->prepare('SELECT mail FROM visitors WHERE id = :id');
        $req->execute(array('id' => $id));
        $res = $req->fetch();

        //Traitement des données.
        $creator = $id;
        $title = $_POST['createEventTitle'];
        $color = $_POST['createEventColor'];

        //Vérification des fichiers envoyés
        if ($_FILES['myImg']['error'] > 0) {
            $erreur = "Erreur lors du transfert";
        }
  
        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png');
        //1. strrchr renvoie l'extension avec le point (« . »).
        //2. substr(chaine,1) ignore le premier caractère de chaine.
        //3. strtolower met l'extension en minuscules.
        $extension_upload = strtolower(substr(strrchr($_FILES['myImg']['name'], '.'), 1));
        if (in_array($extension_upload, $extensions_valides)) {
            echo "Extension correcte";
        }
        $image = file_get_contents($_FILES['myImg']['tmp_name']);

        mkdir("eventsData/{$title}/", 0777, true);
        $nom = "eventsData/{$title}/backgroundImg.{$extension_upload}";
        $resultat = move_uploaded_file($_FILES['myImg']['tmp_name'], $nom);
        if ($resultat) {
            echo "Transfert réussi";
        }

        //Insert en BDD les données du formulaire
        $req = $this->db->prepare('INSERT INTO event (creator, title, background_color) VALUES(:creator, :title, :background_color)');
        $req->execute(array(
                  'creator' => $creator,
                  'title' => $title,
                  'background_color' => $color));

        $recipient = 'guilloux.audrey24@gmail.com';
        $email_address = strip_tags(htmlspecialchars($res['mail']));

        //Envoi d'un mail de confirmation de création de l'evt.
        $to = $email_address;
        $email_subject = "Création évènement sur Souvenirs d'un jour";
        $email_body = "Vous avez récemment crée un évènement sur Souvenirs d'un jour. Nous vous remercions de votre confiance !
          \n\n". "Attention, si votre évènement n'est pas actif dans un mois, il sera supprimé ! (Un évènement actif est un évènement contenant des photos.)\n\n".
          "Merci de votre compréhension et bonne navigation sur notre site !\n\n"."Souvenirs d'un jour";
        $headers = "From: noreply@yprojetsdwjguilloux.ovh\n";
        $headers .= "Reply-To: noreply@yprojetsdwjguilloux.ovh\n";
        mail($to, $email_subject, $email_body, $headers);
    }
}
