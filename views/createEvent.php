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

                    <form novalidate>
                      <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                          <label>Titre de l'évènement</label>
                          <input type="text" class="form-control" placeholder="Titre" required data-validation-required-message="Entrer le titre de votre événement.">
                          <p class="help-block text-danger"></p>
                        </div>
                      </div>

                      <div class="control-group">
                        <div class="form-group floating-label-form-group controls">
                          <label>Choix de la couleur d'arrière-plan</label>
                          <input class="form-control col-lg-2 offset-lg-5" type="color" />
                        </div>
                      </div>

                      <div class="control-group">
                        <div class="control-group">
                          <label>Choisir une image (formats JPG ou PNG)</label><br />
                          <label tabindex="0" for="my-img" class="input-img-trigger form-control">Parcourir</label>
                          <input class="input-img form-control" id="my-img" type="file" accept="image/*">
                        </div>
                        <p class="img-return"></p><br />
                      </div><br>

                      <div id="successCreateEvent"></div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-success col-lg-3">Envoyer</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

<script type="text/javascript" src="lib/js/createEvent.js"></script>