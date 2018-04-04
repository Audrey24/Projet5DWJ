<?php

if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
    echo "Pas d'arguments fournis !";
    return false;
}

$recipient = $_POST['recipient'];
$email_address = strip_tags(htmlspecialchars($_POST['mail']));

// Create the email and send the message
$to = $recipient; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Message de :  $name";
$email_body = "Vous avez reçu une invitation à vous rendre sur le site de Souvenirs d'un jour.
.\n\n"."Voici le lien:\n\n http://projet3.projetsdwjguilloux.ovh/projet5/Login";
$headers = "From: noreply@yprojetsdwjguilloux.ovh\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";
mail($to, $email_subject, $email_body, $headers);
return true;
