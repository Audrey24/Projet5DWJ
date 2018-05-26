<section class="page-section cta">
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <div class="cta-inner text-center rounded">
              <form method="post" novalidate id="contactForm">
              <h2 class="section-heading mb-5">
                <span class="section-heading-upper">Une question</span>
                <span class="section-heading-lower">Contactez-moi</span>
              </h2>

              <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <li class="list-unstyled-item list-hours-item d-flex">
                      Votre nom
                    </li>
                    <input type="text" class="form-control col-lg-12" id="contactName"  name ="contactName" required data-validation-required-message="Entrer votre nom.">
                  </div>
                </div>

                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <li class="list-unstyled-item list-hours-item d-flex">
                      Votre adresse mail
                    </li>
                    <input type="text" class="form-control col-lg-12"  id="contactMail"  name ="contactMail" required data-validation-required-message="Entrer votre mail.">
                  </div>
                </div>

                <div class="control-group">
                  <div class="form-group floating-label-form-group controls">
                    <li class="list-unstyled-item list-hours-item d-flex">
                      Votre message
                    </li>
                    <textarea class="form-control col-lg-12" rows="7"  id="contactMessage"  name ="contactMessage" required data-validation-required-message="Veuillez écrire votre message."></textarea>
                  </div>
                </div>
                <button type="button" id="contactSend" class="btn btn-success col-lg-8 offset-lg-2">Valider</button>
              </ul>
              <div id="contactSendMessage"></div>
            </form><br>

              <p class="address mb-5">
                <em>
                  <strong>Souvenirs d'un jour</strong>
                  <br>
                  Montréal - Canada
                </em>
              </p>
              <p class="mb-0">
                <em>Réseaux</em>
              <br>
              <i class="fab fa-linkedin fa-lg"></i>
              <i class="fab fa-facebook-square fa-lg"></i>
              </p>

            </div>
          </div>
        </div>
      </div>
    </section>


    <script type="text/javascript" src="lib/js/contact.js" defer></script>
