<?php

if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
    echo "Pas d'arguments fournis !";
    return false;
}

$recipient = $_POST['recipient'];
$email_address = strip_tags(htmlspecialchars($_POST['mail']));

// Create the email and send the message
$to = $recipient; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Création évènement sur Souvenirs d'un jour";
$email_body = "Vous avez récemment crée un évènement sur Souvenirs d'un jour. Nous vous remercions de votre confiance !
\n\n"."Pour confirmer votre évènement, veuiller cliquer sur ce lien:\n\n http://projet3.projetsdwjguilloux.ovh/projet5/\n\n"."Attention, il n'est valide que pendant 24h
\n\n"."Souvenirs d'un jour";
$headers = "From: noreply@yprojetsdwjguilloux.ovh\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";
mail($to, $email_subject, $email_body, $headers);
return true;
