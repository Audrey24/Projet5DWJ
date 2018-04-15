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
    require("controllers/Login.php");
    $contr = new Login();
    $contr->loadModel('Login');
    $contr->indexEventInvitation();
} else {
    ?>
          <button type="button" data-id="<?php echo $data['id']?>" data-user="<?php echo Session::get('id')?>" class=" btn btn-info col-lg-4 col-md-4 col-sm-4" id="btnacceptEvent">Je participe</button></br>
        <?php
}
        ?>
        <div id="messageAcceptInvite"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="<?php echo URL; ?>lib/js/eventInvitation.js" defer></script>
