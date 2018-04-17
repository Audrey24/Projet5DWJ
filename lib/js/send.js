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

var fileList = new FormData();
$(function() {

    // Multiple images preview in browser
    var imagesPreview = function(input, place) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var container = $('<div class="containImg"></div>');
                    $($.parseHTML('<img class="preview">')).attr('src', event.target.result).appendTo(container);
                    $( "<p class='closeImg'>&times;</p>" ).appendTo(container);
                    $("<input type='text' class='legend form-control col-lg-8 offset-lg-2' placeholder='Légende (obligatoire)' name='legend' id='legend' required/><br/>").appendTo(container);
                    container.appendTo(place);
                    $(".closeImg").on('click', function(e) {
                      $(this).parent().remove();
                      //TODO : retirer de formdata l'image associée
                    });
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#my-file').on('change', function() {
        imagesPreview(this, 'div.gallery');
        for (var i = 0; i < this.files.length; i++) {
          fileList.append(this.files[i].name, this.files[i]);
        }
    });

    $('#sendButton').on('click', function(event) {
      event.preventDefault();
      $this = $("#sendButton");
      $this.prop("disabled", true);
      $('.legend').each(function() {
        fileList.append('legs[]', $(this).val());
      });
      var content = $('.legend').val();
      if (content == "") {
        $('#messageSend').html("<div class='alert alert-danger'>");
        $('#messageSend > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
        $('#messageSend > .alert-danger').append("<strong>" + "La légende est vide ! Vous devez légender votre photo" + "</strong>" );
        $('#messageSend > .alert-danger').append('</div>');
        setTimeout(function() {
          $('#messageSend').html("");
          $this.prop("disabled", false);
        }, 3000);
      } else {
        $.ajax({
          url: "Send/send",
          type: "POST",
          data : fileList,
          processData : false,
          contentType: false,
          //Si la requête a aboutit, on insère les données dans le tableau et on affiche un msg pour confirmer l'envoi.
          success: function(data) {
            $('#messageSend').html("<div class='alert alert-success'>");
            $('#messageSend > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#messageSend > .alert-success').append("<strong>Vos fichiers ont bien été enregistrés </strong>");
            $('#messageSend > .alert-success').append('</div>');
          //Après un délais, on redirige vers Home.
          setTimeout(function() {
              $('#messageSend').html("");
              window.location.replace("Medias");
            }, 3000);
        },
        //Si la requête échoue, on envoit un msg.
        error: function(data) {
          console.log(data);
          $('#messageSend').html("<div class='alert alert-danger'>");
          $('#messageSend > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
          $('#messageSend > .alert-danger').append($("<strong>").text("Désolé, il semble y avoir un problème, vos fichers n'ont pas été enregistrés, veuillez réessayer." ));
          $('#messageSend > .alert-danger').append('</div>');
          //Après 3s, on efface le msg.
          setTimeout(function() {
            $('#messageSend').html("");
          }, 3000);
        },
          complete: function() {
            //On réactive le bouton "créer" lorsque l'appel AJAX est terminé
            setTimeout(function() {
              $this.prop("disabled", false);
            }, 1000);
          }
      });
    }
  });
});
