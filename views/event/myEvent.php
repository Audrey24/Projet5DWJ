<section class="page-section">
  <div class="container">
    <div class="about-heading-content">
      <div class="row">
        <div class="col-xl-9 mx-auto">
          <div class="bg-faded rounded p-5">
            <h2 class="section-heading mb-4">
              <span class="section-heading-lower" id="titleMyEvent">Vos évènements ! </span>
            </h2>
              <form id="getEventForm" action="MyEvent/register" method="post">
                <?php $data = $this->data;
                  for ($i=0; $i<count($data); $i++) {
                      ?>
                  <i class="fa fa-times" data-toggle="modal" data-target="#modalDelete" data-id='<?php echo($data[$i]["id"])?>'></i><input type="radio" name="titleEvent" class="titleEvent" value='<?php echo($data[$i]["id"].','.$data[$i]["role"].','.$data[$i]["title"])?>'/><label for="title"><?php echo($data[$i]["title"]) ?></label><br>

                  <?php
                  }
                  ?>


                  <button type="submit" id="btnChoiceEvent" class="btn btn-success col-lg-3 offset-lg-5 col-md-3 offset-md-5">Choisir</button><br>
                  <div id="messageEvent"></div>
                </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include("modalDelete.php");?>

<script type="text/javascript" src="lib/js/myEvent.js" defer></script>
