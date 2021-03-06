<section class="page-section cta">
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <div class="cta-inner text-center rounded">
          <h2 class="section-heading mb-4">
            <span class="section-heading-upper">Présentation </span>
          </h2>

          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="lib/images/titrePhoto.jpg" alt="Choix du titre et de la photo">
                <div>
                  <p>Choisissez le titre de votre évènement et la photo qui l'accompagnera.</p>
                </div>
              </div>

              <div class="carousel-item">
                <img class="d-block w-100" src="lib/images/livreDor.jpg" alt="Livre d'or">
                <div>
                  <p>Choisissez la couleur de votre livre d'or.</p>
                </div>
              </div>

              <div class="carousel-item">
                <img class="d-block w-100" src="lib/images/site.jpg" alt="Livre d'or">
                <div>
                  <p>Partagez vos photos et profitez de votre site.</p>
                </div>
              </div>
          </div>
        </div>
      </div>

      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <i class="fa fa-angle-left fa-2x"></i>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <i class="fa fa-angle-right fa-2x"></i>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
</div>
</section>

<?php if (!empty(Session::get('pseudo'))) {
    ?>
<section id="sectionCreateEvent" class="page-section about-heading">
  <div class="container">
    <img id="imgCreateEvent" class="img-thumbnail about-heading-img mb-3 mb-lg-0" src="lib/images/createEvent.jpg" alt="Calendrier avec une date d'évènement">
      <div class="about-heading-content">
        <div class="row">
          <div class="col-xl-9 col-lg-10 mx-auto">
            <div class="container" id="createContainer">
              <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                  <div class="bg-faded rounded p-5">
                    <h2 class="section-heading mb-4">
                      <span class="section-heading-upper">Un évènement que vous souhaitez partager avec vos proches !</span>
                      <span class="section-heading-lower">Créer le ! </span>
                    </h2>

                    <form id="createEventForm" action="CreateEvent/create" novalidate enctype="multipart/form-data">
                      <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                          <label>Titre de l'évènement</label>
                          <input type="text" class="form-control" id="createEventTitle" name='createEventTitle' placeholder="Titre" required data-validation-required-message="Entrer le titre de votre événement.">
                          <p class="help-block text-danger"></p>
                        </div>
                      </div>

                      <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                          <label>Choix de la couleur d'arrière-plan</label>
                          <input class="form-control col-lg-2 offset-lg-5 col-sm-2 offset-sm-5" name="createEventColor" id="createEventColor" type="color" />
                        </div>
                      </div>

                      <div class="control-group">
                        <div class="control-group">
                          <label>Choisir une image (formats JPG ou PNG)</label><br>
                          <label tabindex="0" for="myImg" class="input-img-trigger form-control">Parcourir</label>
                          <input class="input-img form-control" name="myImg" id="myImg" type="file" accept="image/*">
                          <label>Choisir un fichier (formats JPG ou PNG)</label><br>
                        </div>
                        <p class="img-return"></p><br>
                      </div><br>

                      <div id="messageCreateEvent" class="col-lg-10 offset-lg-1 col-md-10 offset-md-1"></div>

                      <div class="form-group">
                        <button type="submit" id="createEventSend" class="btn btn-success col-lg-3">Envoyer</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

 <?php
} else {
        ?>
        <section id="sectionLog" class="page-section about-heading">
          <div class="container">
            <div class="about-heading-content">
              <div class="row">
                <div class="col-xl-9 col-lg-10 mx-auto">
                  <div id="connexionMsg">
                    <div>Vous devez avoir un compte et être connecté pour pouvoir créer un événement!</div><br>
                      <a class="btn btn-info col-lg-3 col-sm-3 Btnconnexion" role="button" aria-pressed="true" href="<?php echo  URL; ?>Login" >Connexion</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
      <?php
    } ?>

<script type="text/javascript" src="lib/js/createEvent.js" defer></script>
