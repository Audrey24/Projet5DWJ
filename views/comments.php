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
          <div class="cta-inner text-center rounded" id="book">
          <div class="control-group">
            <table class="table table-sm">
              <thead>
                <tr>
                      <th scope="col">#</th>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Handle</th>
                    </tr>
              </thead>
              <tbody>
                <?php $data = $this->data;
                for ($i=0; $i<count($data); $i++) {
                    echo '<tr><th>'.$data[$i]['pseudo'].'</th>';
                    echo '<th>'.$data[$i]['content'].'</th>';
                    echo '<th>'.$data[$i]['id_user'].'</th>';
                    echo '<th>'.$data[$i]['publicationDate'].'</th></tr>';
                }
                  ?>
              </tbody>
            </table>
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
                    <textarea rows="7" class="col-lg-12" placeholder="Votre commentaire" required data-validation-required-message="Veuillez écrire un commentaire."></textarea>
                  </div></br>
                  <button type="submit" class="btn btn-success">Commenter</button>
                </form>
              </div></br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
