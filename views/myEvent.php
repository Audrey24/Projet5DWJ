<section id="sectionMyEvent" class="page-section cta">
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <div class="cta-inner text-center rounded">
          <h2 class="section-heading mb-4">
            <span class="section-heading-lower">Vos évènements</span>
          </h2>
            <p>Veuillez choisir l'évènement que vous souhaitez ouvrir</p>
            <div><?php $data = $this->data;
              for ($i=0; $i<count($data); $i++) {
                  ?>
                  <input type="radio" name="title" value="title" id="title" /> <label for="title"> <?php echo($data[$i]['title']) ?></label><br />
                <?php
              }
                ?></div>
        </div>
      </div>
    </div>
  </div>
</section>


<script type="text/javascript" src="lib/js/myEvent.js" defer></script>
