<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">

<section id="sectionMedias" class="page-section about-heading">
    <img id="imgEvent" class="img-thumbnail about-heading-img mb-3 mb-lg-0" src="eventsData/<?php echo Session::get('event'); ?>/backgroundImg.jpg" alt="BackgroundImg">
      <div  class="about-heading-content">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div  class="bg-faded rounded p-5">
            <h2  class="section-heading mb-4">
              <span class="section-heading-lower"><?php echo Session::get('titleEvent'); ?></span>
            </h2>
          </div>
        </div>
      </div></br>
      <div class="col-lg-7 col-md-7 mx-auto bg-faded rounded p-2">
        <p id="msgclique" class="m-0 small">N'hésitez pas à cliquez sur les vignettes.</p>
      </div>

      <div class="grid tz-gallery"></div>

</section>

<?php include("views/modalImage.php");?>
<?php include("views/event/modalDelete.php");?>


<script src="lib/js/medias.js" defer></script>
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js" defer></script>
