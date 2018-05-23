//Ajout de la classe JS à HTML
document.querySelector("html").classList.add('js');

//Initialisation des variables
var fileInput  = document.querySelector(".input-file"),
    button     = document.querySelector(".input-file-trigger"),
    returnFile = document.querySelector(".file-return");

//Action lorsque la "barre d'espace" ou "Entrée" est pressée
button.addEventListener("keydown", function( event ) {
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

var generateThumbnail = function(med) {
  var canvas = document.createElement('canvas');
  var ctx = canvas.getContext('2d');
  var width;
  var height;
  if(med.tagName == 'VIDEO') {
      height = med.videoHeight;
      width = med.videoWidth;
  } else if (med.tagName == 'IMG') {
      height = med.naturalHeight;
      width = med.naturalWidth;
  }

    //objectif 250 width : 250 *h original/w original = height target
  canvas.width = 300;
  canvas.height = (300 * height)/ width;

  // les thumbnail de video sont tordues sur iOS en portrait
  var agent = navigator.userAgent;
  var regExp = /iPhone/i;
  if(regExp.test(agent) && med.tagName == 'VIDEO' && height>width){
    ctx.rotate((Math.PI / 180) * 90);
    ctx.translate(0, -canvas.width);
    ctx.drawImage(med, 0, 0, width, height, 0, 0, canvas.height, canvas.width*2);
  } else {
    ctx.drawImage(med, 0, 0, width, height, 0, 0, canvas.width, canvas.height);
  }

  return canvas.toDataURL('image/jpeg', 0.8);
};

// Multiple images preview in browser
var imagesPreview = function(input, place) {
            $this = $("#sendButton");
            var type = input.type.split('/')[0];

            if(type=='image') {
              var reader = new FileReader();
              reader.onload = function(event) {
                  var container = $('<div class="containImg" data-id="'+input.name+'"></div>');
                  var img = $($.parseHTML('<img class="preview">')).attr('src', event.target.result);
                  img.appendTo(container);
                  $( "<p class='closeImg' data-id='"+input.name+"'>&times;</p>" ).appendTo(container);
                  $("<input type='text' class='legend form-control col-lg-8 offset-lg-2' placeholder='Légende (obligatoire)' name='legend' id='legend' required/><br/>").appendTo(container);
                  container.appendTo(place);

                  $(".closeImg").on('click', function(e) {
                    $(this).parent().remove();
                    fileList.delete($(this).data('id'));
                  });

                  downsize(event.target.result, function(result){
                    fileList.append(input.name, result);
                  });

              };
              reader.readAsDataURL(input);

            } else if(type=='video') {
              var video = URL.createObjectURL(input);
              var container = $('<div class="containImg" data-id="'+input.name+'"></div>');
              $( "<p class='closeImg' data-id='"+input.name+"'>&times;</p>" ).appendTo(container);
              var videoContainer = $('<video class="preview" width="400" autoplay controls><source src='+video+'></video>');
              videoContainer.appendTo(container);
              $("<input type='text' class='legend form-control col-lg-8 offset-lg-2' placeholder='Légende (obligatoire)' name='legend' id='legend' required/><br/>").appendTo(container);
              container.appendTo(place);
              $(".closeImg").on('click', function(e) {
                $(this).parent().remove();
                fileList.delete($(this).data('id'));
              });
              fileList.append(input.name, input);

            } else {
              $this.prop("disabled", true);
              alerte('#messageSend', "Ce type de fichier n'est pas autorisé ! Veuillez réessayer !", "danger");
            }
            $this.prop("disabled", false);
};

$(function() {
    $('#my-file').on('change', function() {
        for (var i = 0; i < this.files.length; i++) {
          if(!fileList.has(this.files[i].name)) {
            imagesPreview(this.files[i], 'div.gallery');
          } else {
            alerte('#messageSend', "Vous avez déjà cette photo de sélectionnée !", "danger");
          }
        }
    });

    $('#sendButton').on('click', function(event) {
      event.preventDefault();
      $this = $("#sendButton");
      $this.prop("disabled", true);

      var content = $('.legend').val();
      if (content == "") {
        var call = function() {
          $this.prop("disabled", false);
        };
        alerte('#messageSend', "La légende est vide ! Vous devez légender votre photo", "danger", call);
      } else {
        $('.legend').each(function() {
          fileList.append($(this).parent().data('id')+"leg", $(this).val());
        });
        $('.preview').each(function() {
          var img = generateThumbnail(this);
          fileList.append($(this).parent().data('id')+"min", img);
        });

        $('#loader').css('display', 'block');
        $('#loader').fadeIn(1000);
        $.ajax({
          url: "Send/send",
          type: "POST",
          data : fileList,
          processData : false,
          contentType: false,
          //Si la requête a aboutit, on insère les données dans le tableau et on affiche un msg pour confirmer l'envoi.
          success: function(data) {
            console.log(data);
            $('#loader').fadeOut(2000);
            $('#loader').css('display', 'none');
            var call = function() {
              window.location.replace("Medias");
            };
            alerte('#messageSend', "Vos fichiers ont bien été enregistrés", "success", call);
        },
        //Si la requête échoue, on envoit un msg.
        error: function(data) {
          alerte('#messageSend', "Désolé, il semble y avoir un problème, vos fichers n'ont pas été enregistrés, veuillez réessayer.", "danger");
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
