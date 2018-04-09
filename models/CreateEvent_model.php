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
        print_r($_POST);
        $creator = $_POST['createEventMail'];
        $title = $_POST['createEventTitle'];
        $color = $_POST['createEventColor'];

        echo($creator);
        echo($title);
        echo($color);

        if ($_FILES['myImg']['error'] > 0) {
            $erreur = "Erreur lors du transfert";
        }
        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
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

        $req = $this->db->prepare('INSERT INTO event (creator, title, background_color) VALUES(:creator, :title, :background_color)');
        $req->execute(array(
                  'creator' => $creator,
                  'title' => $title,
                  'background_color' => $color));
    }
}
