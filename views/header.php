<?php Session::init(); ?>

<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Souvenirs d'un jour</title>

    <!-- Bootstrap core CSS-->
    <link href="<?php echo  URL; ?>other/theme/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style type="text/css" style="display: none">

    :root {
        --main-bg-color: <?php echo Session::get('background_color'); ?>;
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

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo  URL; ?>other/theme/css/business-casual.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

  <body>

    <h1 class="site-heading text-center text-white d-none d-lg-block">
      <span id="title" class="site-heading-lower">Souvenirs d'un jour</span>
      <span class="site-heading-upper text-primary mb-3">Partagez vos évènements</span>
    </h1>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
      <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">MENU</a>
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

           if (!empty(Session::get('pseudo')) && (!empty(Session::get('event')))) {
               ?>

            <div class="dropdown">
              <li class="dropdown-toggle link linkMenu nav-item px-lg-4 nav-link text-uppercase text-expanded" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Evènements
                <span class="caret"></span>
              </li>
                   <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                     <li><a class="link nav-link text-uppercase text-expanded" href="<?php echo  URL; ?>Medias">Album</a></li>
                     <li><a class="link nav-link text-uppercase text-expanded" href="<?php echo  URL; ?>Send">Envoyer</a></li>
                     <li><a class="link nav-link text-uppercase text-expanded" href="<?php echo  URL; ?>Comments">Livre d'or</a></li>
                     <li><a class="link nav-link text-uppercase text-expanded" href="<?php echo  URL; ?>MyEvent">Mes évènements</a></li>
                     <li role="separator" class="divider"></li>
                     <?php
                      if (!empty(Session::get('pseudo')) && (Session::get('role') == 1)) {
                          ?>
                            <li><a class="link nav-link text-uppercase text-expanded" href="<?php echo  URL; ?>Admin">Gérer mon évènement</a></li>
                          <?php
                      } ?>
                   </ul>
              </div>

              <li class="nav-item px-lg-4">
                <a class="nav-link text-uppercase text-expanded" href="<?php echo  URL; ?>Login/disconnect">Déconnexion</a>
              </li>

            <?php
           } elseif (!empty(Session::get('pseudo'))) {
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



    <?php
      if (!empty(Session::get('pseudo'))) {
          ?>
    <script>
      var id ="<?php echo Session::get('id'); ?>"
      var pseudo ="<?php echo Session::get('pseudo'); ?>"
      var idevent ="<?php echo Session::get('event'); ?>"
      var titleEvent ="<?php echo Session::get('role'); ?>"
      var color ="<?php echo Session::get('background_color'); ?>"
    </script>
     <?php
      } else {
          ?>
      <script>
        var role ="Inconnu";
      </script>
    <?php
      } ?>
