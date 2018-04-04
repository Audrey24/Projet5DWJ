<section id="sectionAdmin" class="page-section about-heading">
  <div class="container">
    <div class="row">
      <div class="bg-faded rounded p-5 col-lg-4 offset-lg-1">
        <h2 class="section-heading mb-4">
          <span class="section-heading-upper">Envie de changement ?</span>
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
              <label tabindex="0" for="newImg" class="input-img-trigger form-control">Parcourir</label>
              <input class="input-img form-control" id="newImg" type="file" accept="image/*">
            </div>
            <p class="img-return"></p><br />
          </div><br>

          <div></div>

          <div class="form-group">
            <button type="submit" class="btn btn-success col-lg-12">Valider</button>
          </div>
        </form>
      </div>

      <div class="page-section cta col-lg-6 offset-lg-1">
        <div class="col-lg-12">
          <div class="cta-inner text-center rounded">
            <h2 class="section-heading mb-4">
              <span class="section-heading-upper">Liste de vos proches inscrits</span>
            </h2>

          </div>
        </div><br>
        <button type="button" data-toggle="modal" data-target="#modalInvite" class="btn btn-primary col-lg-4 offset-lg-4">Inviter</button>
      </div>
    </div>
  </div>
</section>

  <?php include('modalInvite.php');?>
