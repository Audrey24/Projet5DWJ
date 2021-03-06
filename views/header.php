<?php Session::init(); ?>

<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/jpg" href="lib/images/logo.png">
    <title>Souvenirs d'un jour</title>


    <style id="globalColor">

    :root {
      <?php if (!empty(Session::get('pseudo')) && (!empty(Session::get('event')))) {
    ?>
        --main-bg-color: <?php echo Session::get('background_color'); ?>;
      <?php
} else {
        ?>
        --main-bg-color: rgba(2, 204, 228, 0.8);
    <?php
    } ?>
    }
    </style>


    <!-- My CSS -->
    <link href="<?php echo  URL; ?>lib/css/home.css" rel="stylesheet">
    <link href="<?php echo  URL; ?>lib/css/createEvent.css" rel="stylesheet">
    <link href="<?php echo  URL; ?>lib/css/login.css" rel="stylesheet">
    <link href="<?php echo  URL; ?>lib/css/send.css" rel="stylesheet">
    <link href="<?php echo  URL; ?>lib/css/medias.css" rel="stylesheet">
    <link href="<?php echo  URL; ?>lib/css/comments.css" rel="stylesheet">
    <link href="<?php echo  URL; ?>lib/css/contact.css" rel="stylesheet">
    <link href="<?php echo  URL; ?>lib/css/admin.css" rel="stylesheet">
    <link href="<?php echo  URL; ?>lib/css/myEvent.css" rel="stylesheet">
    <link href="<?php echo  URL; ?>lib/css/eventInvitation.css" rel="stylesheet">
    <link href="<?php echo  URL; ?>lib/css/mentions.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo  URL; ?>other/theme/css/business-casual.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <!--<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">-->

  </head>

  <body>

    <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span id="title" class="site-heading-lower">Souvenirs d'un jour</span>
      <span id="subTitle" class="site-heading-upper text-primary mb-3">Partagez vos évènements</span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="<?php echo  URL; ?>Home">MENU</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="<?php echo  URL; ?>Home">Accueil
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="<?php echo  URL; ?>CreateEvent">Créer un événement</a>
            </li>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="<?php echo  URL; ?>Contact">Contact</a>
            </li>

            <?php
            if (!empty(Session::get('pseudo'))) {
                ?>
            <ol class="nav">
              <li>
                <a href="#" class="link linkMenu nav-item px-lg-4 nav-link text-uppercase text-expanded">Evènement</a>
                <ol>
                  <li><a class="nav-link text-uppercase text-expanded link" href="<?php echo  URL; ?>Medias">Album</a></li>
                  <li><a class="nav-link text-uppercase text-expanded link" href="<?php echo  URL; ?>Send">Envoyer</a></li>
                  <li><a class="nav-link text-uppercase text-expanded link" href="<?php echo  URL; ?>Comments">Livre d'or</a></li>
                  <li><a class="nav-link text-uppercase text-expanded link" href="<?php echo  URL; ?>MyEvent">Mes évènements</a></li>
                <?php
                if (!empty(Session::get('pseudo')) && (Session::get('role') == 1)) {
                    ?>
                      <li><a class="nav-link text-uppercase text-expanded link" href="<?php echo  URL; ?>Admin">Gérer mon évènement</a></li>
                    <?php
                } ?>
              </ol>
            </li>
          </ol> <?php
            } ?>



            <?php
           if (!empty(Session::get('pseudo'))) {
               ?>
               <li class="nav-item px-lg-4">
                 <a class="nav-link text-uppercase text-expanded" href="<?php echo  URL; ?>Login/disconnect">Déconnexion</a>
               </li>

            <?php
           } else {
               ?>
            <li class="nav-item px-lg-4">
              <a class="nav-link text-uppercase text-expanded" href="<?php echo  URL; ?>Login">Connexion</a>
            </li>
          <?php
           } ?>

          </ul>
        </div>
      </div>
    </nav>
