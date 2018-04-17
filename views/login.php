<section id="sectionLogin" class="page-section about-heading">
  <div class="container">
    <div class="about-heading-content">
      <div class="row">
        <div class="col-xl-9 col-lg-10 mx-auto">
          <div id="loginContainer">
          <!--Formulaire de connexion-->
            <form name="signinForm" id="signinForm" method="post" novalidate>
              <div>
                <h4 clas="col-lg-4 offset-lg-4">Connexion</h4>
              </div></br>

              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Pseudonyme</label>
                  <input type="text" class="form-control col-lg-6 offset-lg-3 col-sm-6 offset-sm-3" name="signinPseudo" id="signinPseudo" placeholder="Votre pseudo"  required data-validation-required-message="Entrer votre pseudo.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>

              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Mot de passe</label>
                  <input type="password" class="form-control col-lg-6 offset-lg-3 col-sm-6 offset-sm-3" name="signinPass" id="signinPass" placeholder="Votre mot de passe"  required data-validation-required-message="Entrer votre mot de passe.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>

              <div id="successSignin" class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3"></div></br>

              <div>
                <input type="submit" class="btn btn-success col-lg-3 col-md-3 col-sm-3" id="btnCreateSignin" value="Valider"/>
                <button type="button" class=" btn btn-info col-lg-4 col-md-4 col-sm-4 offset-lg-2 offset-md-2 offset-sm-2" id="btnCreateAccount">Créer votre compte</button>
              </div>
            </form>

            <!--Formulaire d'inscription-->
            <form name="signupForm" id="signupForm" method="post" novalidate>
              <div>
                <h4 clas="col-lg-4 offset-lg-4">Inscription</h4>
              </div></br>

              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Pseudonyme</label>
                  <input type="text" class="form-control col-lg-6 offset-lg-3 col-sm-6 offset-sm-3" name="signupPseudo" id="signupPseudo" placeholder="Votre pseudo"  required data-validation-required-message="Entrer votre pseudo.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>

              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Adresse mail</label>
                  <input type="email" class="form-control col-lg-6 offset-lg-3 col-sm-6 offset-sm-3" name="signupMail" id="signupMail" placeholder="Adresse Mail"   required data-validation-required-message="Entrer votre adresse mail.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>

              <div class="control-group">
                <div class="form-group floating-label-form-group controls">
                  <label>Mot de passe</label>
                  <input type="password" class="form-control col-lg-6 offset-lg-3 col-sm-6 offset-sm-3" name="signupPass" id="signupPass" placeholder="Votre mot de passe"  required data-validation-required-message="Entrer votre mot de passe.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>

              <div id="successSignup" class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3"></div></br>

              <div>
                <!--<div class="g-recaptcha" data-sitekey="6Lc0LU0UAAAAAOW7crKFnGiOnZAyYWa9-bJzDK2l"></div>-->
                <input type="submit" class="btn btn-success col-lg-6 col-md-6" id="btnSignup" value="Créer"/>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="<?php echo URL; ?>lib/js/login.js" defer></script>
