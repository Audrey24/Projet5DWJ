<section class="page-section cta">
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <div class="cta-inner text-center rounded">
          <h2 class="section-heading mb-4">
            <span class="section-heading-lower">Souvenirs d'un jour</span>
            <span class="section-heading-upper">Invitation</span>
          </h2>
          <?php $data = $this->data[0];?>
            <p>Vous avez reçu une invitation de la part de <?php echo $data['pseudo']?> à l'évènement qu'il a crée : <?php echo $data['title']?></p>
            <p class="mb-0">Vous pourrez ainsi voir les photos et vidéos de cet évènements partagés par les autres participants !</p></br>
            <p>Mais vous aurez également la possibilité de partager vos propres photos et vidéos ainsi qu'un message dans le Livre d'Or.</p></br>
            <p>Pour cela, vous devez seulement vous connecter à votre compte et si vous n'en avez pas encore, en créer un !</p></br>
            <p>Souvenirs d'un jour</p></br>
            <?php if (empty(Session::get('pseudo'))) {
    ?>
    <div id="acceptContainer">
    <!--Formulaire de connexion-->
      <form name="signinForm" id="signinForm" method="post" novalidate>
        <div>
          <h4 clas="col-lg-4 offset-lg-4">Connexion</h4>
        </div></br>

        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Pseudonyme</label>
            <input type="text" class="form-control col-lg-6 offset-lg-3 col-md-6 offset-md-3" name="signinPseudo" id="signinPseudo" placeholder="Votre pseudo"  required data-validation-required-message="Entrer votre pseudo.">
            <p class="help-block text-danger"></p>
          </div>
        </div>

        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Mot de passe</label>
            <input type="password" class="form-control col-lg-6 offset-lg-3 col-md-6 offset-md-3" name="signinPass" id="signinPass" placeholder="Votre mot de passe"  required data-validation-required-message="Entrer votre mot de passe.">
            <p class="help-block text-danger"></p>
          </div>
        </div>

        <div id="successSignin" class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3"></div></br>

        <div>
          <input type="submit" class="btn btn-success col-lg-3 col-md-3 col-sm-3" id="btnCreateSignin" value="Valider"/>
          <button type="button" class=" btn btn-info col-lg-4 col-md-4 col-sm-5 offset-lg-2 offset-md-2 offset-sm-2" id="btnCreateAccount">Créer votre compte</button>
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
            <input type="text" class="form-control col-lg-6 offset-lg-3 col-md-6 offset-md-3" name="signupPseudo" id="signupPseudo" placeholder="Votre pseudo"  required data-validation-required-message="Entrer votre pseudo.">
            <p class="help-block text-danger"></p>
          </div>
        </div>

        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Adresse mail</label>
            <input type="email" class="form-control col-lg-6 offset-lg-3 col-md-6 offset-md-3" name="signupMail" id="signupMail" placeholder="Adresse Mail"   required data-validation-required-message="Entrer votre adresse mail.">
            <p class="help-block text-danger"></p>
          </div>
        </div>

        <div class="control-group">
          <div class="form-group floating-label-form-group controls">
            <label>Mot de passe</label>
            <input type="password" class="form-control col-lg-6 offset-lg-3 col-md-6 offset-md-3" name="signupPass" id="signupPass" placeholder="Votre mot de passe"  required data-validation-required-message="Entrer votre mot de passe.">
            <p class="help-block text-danger"></p>
          </div>
        </div>
        <div>
          <div class="g-recaptcha" data-sitekey="6Lc0LU0UAAAAAOW7crKFnGiOnZAyYWa9-bJzDK2l"></div>
          <input type="submit" class="btn btn-success col-lg-6 col-md-6" id="btnSignup" value="Créer"/>
        </div>
      </form>
    </div>

<?php
} else {
        ?>
          <button type="button" data-user="<?php echo Session::get('id')?>" class=" btn btn-info col-lg-4 col-md-4 col-sm-4" id="btnacceptEvent">Je participe</button></br>
        <?php
    }
        ?>
        <div id="successSignup"  data-event="<?php echo $data['id']?>"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="<?php echo URL; ?>lib/js/eventInvitation.js" defer></script>
