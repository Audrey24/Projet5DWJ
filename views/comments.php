<section class="page-section cta">
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <div class="bg-faded rounded p-5" id="bookContainer">
          <h2 class="section-heading mb-5" id="bookTitle">
            <span class="section-heading-upper">Laisser un message</span>
            <span class="section-heading-lower">Livre d'or</span>
          </h2>
        </div>
        <div class="bg-faded rounded p-5" id="book">
          <div class="control-group">
            <?php $data = $this->data;
            for ($i=0; $i<count($data); $i++) {
                $text = '<p><strong>'.$data[$i]['pseudo'].'</strong>le<em>'.$data[$i]['publicationDate'].'</em>';
                if (!empty(Session::get('pseudo')) && (Session::get('role') == 1)) {
                    $text = $text . '<th><i class="fa fa-times" data-toggle="modal" data-target="#modalDelete" data-id="'.($data[$i]["id"]).'"></i></th></tr>';
                }
                $text = $text . '</p>';
                echo $text;
                echo('<p>'.$data[$i]['content'].'</p>');
            }
              ?>

            <div id="tableMessage"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="sectionComments" class="page-section about-heading">
  <div class="container">
    <div class="about-heading-content">
      <div class="row">
        <div class="col-xl-9 col-lg-10 mx-auto">
          <div class="bg-faded rounded p-5">
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <form id="commentsForm">
                  <div>
                    <h2 class="section-heading mb-5">
                      <span class="section-heading-upper">Commenter</span>
                    </h2>
                    <textarea rows="7" class="col-lg-12" id="comments" name="comments" placeholder="Votre commentaire" required data-validation-required-message="Veuillez écrire un commentaire."></textarea>
                  </div></br>
                  <button type="submit" class="btn btn-success" id="sendComment">Commenter</button>
                  <div id="commentMessage"></div>
                </form>
              </div></br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript" src="lib/js/comments.js" defer></script>

<table class="table table-sm">
  <thead></thead>
  <tbody id="containComments">
    <?php $data = $this->data;
    for ($i=0; $i<count($data); $i++) {
        echo '<tr id="'.($data[$i]["id"]).'"><th>'.$data[$i]['pseudo'].'</th>';
        echo '<th>'.$data[$i]['content'].'</th>';
        echo '<th>'.$data[$i]['publicationDate'].'</th>';
        if (!empty(Session::get('pseudo')) && (Session::get('role') == 1)) {
            echo '<th><i class="fa fa-times" data-toggle="modal" data-target="#modalDelete" data-id="'.($data[$i]["id"]).'"></i></th></tr>';
        }
    }
      ?>
      <?php include("views/event/modalDelete.php");?>
  </tbody>
</table>
