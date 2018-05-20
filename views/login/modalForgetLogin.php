<div id="modalForgetLogin" class="modal bg-faded rounded">
  <form name="getLogin" id="getLogin" method="post" novalidate>
    <div>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 clas="col-lg-4 offset-lg-4">Mot de passe oublié</h4>
    </div></br>
    <div class="control-group">
      <div class="form-group floating-label-form-group controls">
        <p>Veuillez entrer votre adresse mail afin de récupérer votre mot de passe</p>
          <label>Adresse mail</label>
          <input type="email" class="form-control col-lg-6 col-sm-6 offset-lg-3 offset-sm-3" placeholder="Adresse Mail" name="mailGetLogin" id="mailGetLogin" required data-validation-required-message="Entrer votre adresse mail..">
          <p class="help-block text-danger"></p>
        </div>
        <div id="sendMail"></div>
        <input type="submit" class="btn btn-success col-lg-4 col-sm-4" id="btnGetLogin" value="Valider"/>
      </div>
    </form>
  </div>
