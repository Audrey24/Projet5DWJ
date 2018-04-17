<link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">

<section id="sectionMedias" class="page-section about-heading">
  <div  class="container">
    <img id="imgEvent" class="img-thumbnail about-heading-img mb-3 mb-lg-0" src="eventsData/<?php echo Session::get('event'); ?>/backgroundImg.jpg" alt="BackgroundImg">
      <div  class="about-heading-content">
        <div class="row">
          <div class="col-xl-9 col-lg-10 mx-auto">
            <div class="container">
              <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                  <div  class="bg-faded rounded p-5">
                    <h2  class="section-heading mb-4">
                      <span class="section-heading-upper"><?php echo Session::get('titleEvent'); ?></span>
                    </h2>
                  </div>
                </div>

                <div class="container gallery-container">
                  <div class="tz-gallery">

              <?php
              $data = $this->data;
              $extImg = array("jpg","jpeg","gif","png");
              $extVid = array("mp4");

              $filesEvent = scandir('eventsData/'.Session::get('event'));
              for ($i = 2; $i<count($filesEvent); $i++) {
                  if (!preg_match("#^[backgroundImg]+\.+[a-z]{2,5}+$#i", $filesEvent[$i])) {
                      $text = '<div class="row">
                              <div class="col-sm-6 col-md-4">
                                <div class="thumbnail">';
                      if (!empty(Session::get('pseudo')) && (Session::get('role') == 1)) {
                          $text = $text . '<button type="button" data-idimg="'.$filesEvent[$i].'" class="close" data-dismiss="alert" aria-hidden="true">&times</button>';
                      }
                      $text = $text.'<a class="lightbox" href="eventsData/'.Session::get('event').'/'.$filesEvent[$i].'">';

                      $extCurrent = strtolower(substr(strrchr($filesEvent[$i], '.'), 1));
                      if (in_array($extCurrent, $extImg)) {
                          $text = $text .'<img class="center" src="eventsData/'.Session::get('event').'/'.$filesEvent[$i].'">';
                      } elseif (in_array($extCurrent, $extVid)) {
                          $text = $text . '<video width="400" controls><source src="eventsData/'.Session::get('event').'/'.$filesEvent[$i].'"></video>';
                      } else {
                          $text = $text. 'Une erreur est survenue';
                      }

                      $text = $text .'</a><div class="caption"><p>'.$data[$i-2]['content'].'</p>
                                  </div></div></div></div>';
                      echo($text);
                  }
              }
              ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js" defer></script>
<script src="lib/js/medias.js" defer></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js" defer></script>
