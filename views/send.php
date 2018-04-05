<section class="page-section about-heading">
      <div class="container">
        <img id="imgSendForm" class="img-thumbnail about-heading-img mb-3 mb-lg-0" src="lib/images/appareilPhoto_mariage.jpg" alt="Appareil photo sur une table de fête">
        <div class="about-heading-content">
          <div class="row">
            <div class="col-xl-9 col-lg-10 mx-auto">
              <div class="bg-faded rounded p-5">
                <h2 class="section-heading mb-4">
                  <span class="section-heading-upper">Vos souvenirs, vos photos, vos vidéos !</span>
                  <span class="section-heading-lower">Partager les ! </span>
                </h2>
                <div id="textMediasForm">
                <p>Nous prenons souvent des photos pour pouvoir garder un souvenir d'un évènement qui nous a marqué ! Seulement, nous gardons nos photos ou vidéos mais ne pouvons pas toujours les partager avec les autres. Grâce à ce site, vous aller pouvoir partager tous vos souvenirs avec vos proches mais également partager les leurs.</p>
                <p class="mb-0">Veuiller choisir le fichier que vous souhaitez partager et valider l'envoi. Il apparaitra alors dans l'Album Photo de votre évènement. Vous pouvez également rédiger une légende pour décrire votre fichier.</p>
              </div><br />
                <div id="sendMediasForm" class="control-group">
                  <form class="form-group floating-label-form-group controls" method="post" enctype="multipart/form-data">
                    <p>
                      <div class="control-group">
                        <label>Choisir un fichier (formats JPG, PNG ou MP4)</label><br />
                        <label tabindex="0" for="my-file" class="input-file-trigger form-control" multiple>Parcourir</label>
                        <input class="input-file form-control multi" maxlength="2" id="my-file" name"my-file" type="file" multiple accept="image/*|video/*">
                      </div>
                      <p class="file-return"></p><br />

                      <label for="legend">Légende du fichier (facultatif) :</label><br />
                      <input type="text" class="form-control" name="legend" id="legend" /><br />
                      <input class="btn btn-success col-lg-4" type="submit" value="Envoyer le fichier" />
                    </p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>


<script type="text/javascript" src="lib/js/send.js" defer></script>
