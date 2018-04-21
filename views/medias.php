<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">

<section id="sectionMedias" class="page-section about-heading">
    <img id="imgEvent" class="img-thumbnail about-heading-img mb-3 mb-lg-0" src="eventsData/<?php echo Session::get('event'); ?>/backgroundImg.jpg" alt="BackgroundImg">
      <div  class="about-heading-content">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div  class="bg-faded rounded p-5">
            <h2  class="section-heading mb-4">
              <span class="section-heading-upper"><?php echo Session::get('titleEvent'); ?></span>
            </h2>
          </div>
        </div>
      </div>

      <div class="grid tz-gallery"></div>

</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js" defer></script>
<script src="lib/js/medias.js" defer></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js" defer></script>
<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js" defer></script>
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js" defer></script>
