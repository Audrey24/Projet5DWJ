<?php
class Admin_model extends Model
{
    //Construction sur le model du parent qui est Model.
    public function __construct()
    {
        parent::__construct();
    }

    /*public function invite()
    {
        $mail = $_POST[''];

        $body = "Vous avez reçu une invitation de la part de" . $headers . "\n\n"."Veuillez cliquer sur ce lien pour visiter le site de son évènement:\n\n". "http://projet3.projetsdwjguilloux.ovh/projet_4/Login/recovery/" . "N'oubliez pas de vous inscrire pour pouvoir visualiser les photos et les vidéos.";
        $headers = "From: noreply@yprojetsdwjguilloux.ovh\n";
        $headers .= "Reply-To: noreply@yprojetsdwjguilloux.ovh\n" ;

        mail($mail, "Souvenirs d'un jour, invitation à un évènement", $body, $headers);
    }*/
}
