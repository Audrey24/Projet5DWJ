<?php

$idEvent = Session::get('event');

if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
    echo "Pas d'arguments fournis !";
    return false;
}

$to = strip_tags(htmlspecialchars($_POST['mail']));

// Create the email and send the message
 // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Invitation Souvenirs d'un jour";
$email_body = "Vous avez reçu une invitation à vous rendre sur le site de Souvenirs d'un jour.
.\n\n"."Voici le lien:\n\n https://projet3.projetsdwjguilloux.ovh/projet5/EventInvitation/invite/".$idEvent;
$headers = "From: noreply@yprojetsdwjguilloux.ovh\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: noreply@yprojetsdwjguilloux.ovh\n";
mail($to, $email_subject, $email_body, $headers);
return true;
