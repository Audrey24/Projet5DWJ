<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">

<section id="sectionMedias" class="page-section about-heading">
  <div  class="container">
    <img id="imgEvent" class="img-thumbnail about-heading-img mb-3 mb-lg-0" src="eventsData/<?php echo $_SESSION['event']; ?>/backgroundImg.jpg" alt="BackgroundImg">
    <div  class="about-heading-content">
      <div class="row">
        <div class="col-xl-9 col-lg-10 mx-auto">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 col-md-10 mx-auto">
                <div  class="bg-faded rounded p-5">
                  <h2  class="section-heading mb-4">
                    <span class="section-heading-upper"><?php echo $_SESSION['titleEvent']; ?></span>
                  </h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container gallery-container">
  <div class="tz-gallery">
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <a class="lightbox" href="lib/images/temoin.jpg">
            <img src="lib/images/temoin.jpg" class="center">
          </a>
            <div class="caption">
              <p>Les témoins</p>
            </div>
          </div>
        </div>

        <div class="col-sm-6 col-md-4">
          <div class="thumbnail">
            <a class="lightbox" href="lib/images/mariage.jpg">
              <img src="lib/images/mariage.jpg" class="center">
            </a>
              <div class="caption">
                <p>Les mariés.</p>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
              <a class="lightbox" href="lib/images/enfant.jpg">
                <img src="lib/images/enfant.jpg" class="center">
              </a>
                <div class="caption">
                  <p>Les enfants</p>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-md-4">
              <div class="thumbnail">
                <a class="lightbox" href="lib/images/famille.jpg">
                  <img src="lib/images/famille.jpg" class="center">
                </a>
                  <div class="caption">
                    <p>La Famille</p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js" defer></script>

<script src="lib/js/medias.js" defer></script>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js" defer></script>
