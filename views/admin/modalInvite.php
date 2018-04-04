<div id="modalInvite" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- En-tête de la fenêtre modale-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title col-lg-7 offset-lg-3 col-sm-7 offset-sm-3">Inviter vos proches</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>


      <!-- Contenu de la fenêtre modale-->
      <div class="modal-body">
        <form method="post" novalidate id="inviteForm">
          <p>Saisissez l'adresse mail de la personne que vous souhaitez inviter.</p>
          <input type="text" class="form-control col-lg-12"  id="inviteMail"  name ="inviteMail" required data-validation-required-message="Entrer votre mail.">
        </form></br>
        <button type="button" id="inviteMailSend" class="btn btn-success col-lg-4 offset-lg-4 col-sm-4 offset-sm-4">Valider</button>
        <div id="inviteMessage"></div>
      </div>
    </div>
  </div>
</div>
