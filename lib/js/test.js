//Ajout de la classe JS à HTML
document.querySelector("html").classList.add('js');

//Initialisation des variables
var fileInput  = document.querySelector( ".input-file" ),
    button     = document.querySelector( ".input-file-trigger" ),
    returnFile = document.querySelector(".file-return");

//Action lorsque la "barre d'espace" ou "Entrée" est pressée
button.addEventListener( "keydown", function( event ) {
    if ( event.keyCode == 13 || event.keyCode == 32 ) {
        fileInput.focus();
    }
});

//Action lorsque le label est cliqué
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});


//Affiche un retour visuel dès que input:file change
fileInput.addEventListener( "change", function( event ) {
    returnFile.innerHTML = this.value.split('/').pop().split('\\').pop();

});

/*$(function() {
  var photo = $("#my-file");

  function readURL(photo) {
    if (photo.files && photo.files[0]) {
      var reader = new FileReader();

      //Un gestionnaire pour l'évènement load.
      //Cet évènement est déclenché à chaque fois qu'une opération de lecture est menée à bien.
      reader.onload = function(e) {
        $('#fileImage').attr('src', e.target.result);
      };
      //Cette méthode démarre la lecture du contenu pour le blob indiqué.
      //Une fois que la lecture est terminée, l'attribut result contient une URL de données qui représente les données du fichier
      reader.readAsDataURL(photo.files[0]);
    }
  }

  photo.change(function() {
    for (var i = 0; i < photo.files.length; i++) {
      readURL(this);
    }
  });
});*/


/*$(function() {
  var photo = $("#my-file");

  function readURL(photo) {
    if (photo.files && photo.files[0]) {
      var reader = new FileReader();

      //Un gestionnaire pour l'évènement load.
      //Cet évènement est déclenché à chaque fois qu'une opération de lecture est menée à bien.
      reader.onload = function(e) {
        $('#fileImage').attr('src', e.target.result);
      };
      //Cette méthode démarre la lecture du contenu pour le blob indiqué.
      //Une fois que la lecture est terminée, l'attribut result contient une URL de données qui représente les données du fichier
      reader.readAsDataURL(photo.files[0]);
    }
  }

  photo.change(function() {
    for (var i = 0; i < photo.files.length; i++) {
      readURL(this);
    }
  });
});*/


$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, place) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img class="preview">')).attr('src', event.target.result).appendTo(place);
                };

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#my-file').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});




//Formulaire de connexion
$(function() {
  $('#btnaccept').on('click', function() {
    event.preventDefault();
    $this = $("#btnaccept");
    $this.prop("disabled", true);
    $.ajax({
        async: true,
        url: url+ "Login/signin",
        type: "POST",
        data: $("#acceptSigninForm").serialize(),
        cache: false,
        success: function(data) {
          data = JSON.parse(data);
          if(data.hasOwnProperty('message11')) {
            $('#messageAcceptInvite').html("<div class='alert alert-success'>");
            $('#messageAcceptInvite > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#messageAcceptInvite > .alert-success').append("<strong>" + data.message11 + "</strong>");
            $('#messageAcceptInvite > .alert-success').append('</div>');
            $('#acceptSigninForm').trigger("reset");
            setTimeout(function() {
              $('#messageAcceptInvite').html("");
                window.location.replace("../../myEvent");
            }, 3000);
          } else {
            console.log("pas de conexion");
            msg = "";
            for(i = 10; i<11; i++) {
              if(data.hasOwnProperty('message'+i)) {
                msg += data['message' + i];
                msg += ' ' ;
              }
            }
            $('#messageAcceptInvite').html("<div class='alert alert-danger'>");
            $('#messageAcceptInvite > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#messageAcceptInvite > .alert-danger').append($("<strong>").text(msg));
            $('#messageAcceptInvite > .alert-danger').append('</div>');
            //On nettoie les champs
            $('#acceptSigninForm').trigger("reset");
            //On efface le msg après un délais de 3s.
            setTimeout(function() {
              $('#messageAcceptInvite').html("");
            }, 3000);
          }
        },
        error: function(data) {
          console.log(data);
          $('#messageAcceptInvite').html("<div class='alert alert-danger'>");
          $('#messageAcceptInvite > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
          $('#messageAcceptInvite > .alert-danger').append($("<strong>").text("Désolé, il semble y avoir un problème : " + data ));
          $('#messageAcceptInvite > .alert-danger').append('</div>');
          $('#acceptSigninForm').trigger("reset");
          setTimeout(function() {
            $('#messageAcceptInvite').html("");
          }, 3000);
        },
        complete: function() {
          setTimeout(function() {
            $this.prop("disabled", false);
          }, 1000);
        }
    });
});
});


<div id="acceptContainer">
<!--Formulaire de connexion-->
  <form name="signinForm" id="acceptSigninForm" method="post" novalidate>
    <div>
      <h4 clas="col-lg-4 offset-lg-4">Connexion</h4>
    </div></br>

    <div class="control-group">
      <div class="form-group floating-label-form-group controls">
        <label>Pseudonyme</label>
        <input type="text" class="form-control col-lg-6 offset-lg-3 col-md-6 offset-md-3" name="acceptsigninPseudo" id="acceptsigninPseudo" placeholder="Votre pseudo"  required data-validation-required-message="Entrer votre pseudo.">
        <p class="help-block text-danger"></p>
      </div>
    </div>

    <div class="control-group">
      <div class="form-group floating-label-form-group controls">
        <label>Mot de passe</label>
        <input type="password" class="form-control col-lg-6 offset-lg-3 col-md-6 offset-md-3" name="acceptsigninPass" id="acceptsigninPass" placeholder="Votre mot de passe"  required data-validation-required-message="Entrer votre mot de passe.">
        <p class="help-block text-danger"></p>
      </div>
    </div>

    <div id="successSignin" class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3"></div></br>

    <div>
      <input type="submit" class="btn btn-success col-lg-3 col-md-3 col-sm-3" id="btnaccept" value="Valider"/>
      <button type="button" class=" btn btn-info col-lg-4 col-md-4 col-sm-4 offset-lg-2 offset-md-2 offset-sm-2" id="btnCreateAccountAccept">Créer votre compte</button>
    </div>
  </form>

  <!--Formulaire d'inscription-->
  <form name="acceptsignupForm" id="acceptSignupForm" method="post" novalidate>
    <div>
      <h4 clas="col-lg-4 offset-lg-4">Inscription</h4>
    </div></br>

    <div class="control-group">
      <div class="form-group floating-label-form-group controls">
        <label>Pseudonyme</label>
        <input type="text" class="form-control col-lg-6 offset-lg-3 col-md-6 offset-md-3" name="acceptsignupPseudo" id="acceptsignupPseudo" placeholder="Votre pseudo"  required data-validation-required-message="Entrer votre pseudo.">
        <p class="help-block text-danger"></p>
      </div>
    </div>

    <div class="control-group">
      <div class="form-group floating-label-form-group controls">
        <label>Adresse mail</label>
        <input type="email" class="form-control col-lg-6 offset-lg-3 col-md-6 offset-md-3" name="acceptsignupMail" id="acceptsignupMail" placeholder="Adresse Mail"   required data-validation-required-message="Entrer votre adresse mail.">
        <p class="help-block text-danger"></p>
      </div>
    </div>

    <div class="control-group">
      <div class="form-group floating-label-form-group controls">
        <label>Mot de passe</label>
        <input type="password" class="form-control col-lg-6 offset-lg-3 col-md-6 offset-md-3" name="acceptsignupPass" id="acceptsignupPass" placeholder="Votre mot de passe"  required data-validation-required-message="Entrer votre mot de passe.">
        <p class="help-block text-danger"></p>
      </div>
    </div>

    <div id="successSignup" class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3"></div></br>

    <div>
      <!--<div class="g-recaptcha" data-sitekey="6Lc0LU0UAAAAAOW7crKFnGiOnZAyYWa9-bJzDK2l"></div>-->
      <input type="submit" class="btn btn-success col-lg-6 col-md-6" id="btnAcceptSignup" value="Créer"/>
    </div>
  </form>
</div>
