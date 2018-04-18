<section id="sectionAdmin" class="page-section about-heading">
  <div class="container">
    <div class="row">
      <div class="bg-faded rounded p-5 col-lg-4 offset-lg-1">
        <h2 class="section-heading mb-4">
          <span class="section-heading-upper">Envie de changement ?</span>
        </h2>
        <form novalidate id="updateForm" name="updateForm">
          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Titre de l'évènement</label>
              <input type="text" class="form-control"  id="newTitle" name="newTitle" placeholder="Titre" required data-validation-required-message="Entrer le titre de votre événement.">
              <p class="help-block text-danger"></p>
            </div>
          </div>

          <div class="control-group">
            <div class="form-group floating-label-form-group controls">
              <label>Choix de la couleur d'arrière-plan</label>
              <input class="form-control col-lg-2 offset-lg-5" id="newColor" name="newColor" type="color" />
            </div>
          </div>

          <div class="control-group">
            <div class="control-group">
              <label>Choisir une image (formats JPG ou PNG)</label><br />
              <label tabindex="0" for="newImg" class="input-img-trigger form-control">Parcourir</label>
              <input class="input-img form-control" id="newImg" name="newImg" type="file" accept="image/*">
            </div>
            <p class="img-return"></p><br />
          </div><br>

          <div class="form-group">
            <button type="submit" class="btn btn-success col-lg-12" id="bntUpdate">Valider</button>
          </div>
          <div id="updateMessage"></div>
        </form>
      </div>

      <div class="page-section cta col-lg-6 offset-lg-1">
        <div class="col-lg-12">
          <div class="cta-inner text-center rounded">
            <h2 class="section-heading mb-4">
              <span class="section-heading-upper">Liste de vos proches inscrits</span>
            </h2>
            <div>
              <?php $data = $this->data;
              for ($i=0; $i<count($data); $i++) {
                  if (!empty(Session::get('pseudo')) && (Session::get('role') == 1)) {
                      $text = '<div><p><i class="fa fa-times" data-toggle="modal" data-target="#modalDelete" data-id="'.($data[$i]["id_user"]).'"></i>';
                  }
                  $text = $text . '<span id="pseudo'.($data[$i]["id_user"]).'"><strong>'.$data[$i]['pseudo'].'</strong></span>';
                  $text = $text . '</p></div>';
                  echo $text;
              }
                ?>
            </div>
            <div id="deletePseudo"></div>
          </div>
        </div><br>
      </div>
    </div>
  </div>
</section>


<section  class="page-section about-heading">
  <div class="container">
    <div class="row">
      <div class="bg-faded rounded p-5 col-lg-4 offset-lg-1" id="deleteContainer">
        <h2 class="section-heading mb-4">
          <span class="section-heading-upper">Supprimer</span>
        </h2>
        <p>Attention, si vous choisissez de supprimer un évènement, vous ne pourrez plus annuler cette action !</p></br>
        <div class="form-group">
          <button type="submit" class="btn btn-danger col-lg-12"><a href="<?php echo  URL; ?>MyEvent" id="btnDelete">Supprimer</a></button>
        </div>
      </div>

      <div class="bg-faded rounded p-5 col-lg-6 offset-lg-1"  id="invitContainer">
        <div class="col-lg-12">
          <div class="cta-inner text-center rounded">
            <h2 class="section-heading mb-4">
              <span class="section-heading-upper">Inviter un proche</span>
            </h2>
              <p>Vous pouvez inviter une personne en entrant son adresse mail. Il recevra alors un mail l'invitant à se connecter à votre évènement</p></br>
              <div class="form-group">
                  <button type="button" data-toggle="modal" data-target="#modalInvite" class="btn btn-primary col-lg-4">Inviter</button>
              </div>
          </div>
        </div><br>
      </div>
    </div>
  </div>
</section>

<?php include("views/event/modalDelete.php");?>


<?php include('modalInvite.php');?>
<script type="text/javascript" src="lib/js/modalInvite.js" defer></script>
<script type="text/javascript" src="lib/js/admin.js" defer></script>
