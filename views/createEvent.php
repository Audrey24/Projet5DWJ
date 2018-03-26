<div class="container" id="createContainer">
  <div class="row">
    <div class="col-lg-8 col-md-10 mx-auto">
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
          <div class="form-group floating-label-form-group controls">
            <label>Image d'arrière-plan</label>
            <input class="form-control" type="texte" />
          </div>
        </div>

        <br>
        <div id="successCreateEvent"></div>

        <div class="form-group">
          <button type="submit" class="btn btn-success col-lg-2">Envoyer</button>
        </div>
      </form>
    </div>
  </div>
</div>
