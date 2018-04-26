<div class="container bg-faded p-3 rounded">
  <div class="row">
    <form method="post" id="resetLog" name="resetLog" novalidate class="col-lg-8 col-md-8 col-sm-8 col-xs-8 offset-lg-2 offset-md-2 offset-sm-2 offset-xs-2">
      <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <p class="msgForgetLogin">Veuillez entrer votre nouveau mot de passe</p>
            <label>Mot de passe</label>
            <input type="password" class="form-control" placeholder="Votre mot de passe" id="resetPass" name="resetPass" required data-validation-required-message="Entrer votre mot de passe."/>
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <input type="submit" class="btn btn-success col-lg-4 col-md-4 col-sm-4 col-xs-4 offset-lg-4 offset-md-4 offset-sm-4 offset-xs-4" id="btnReset" value="Valider"/>
      <div id="resetSuccess"></div>
    </form>
  </div>
</div>

<script src="<?php echo URL; ?>lib/js/login.js" defer></script>
