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

var generateThumbnail = function(med) {
  var canvas = document.getElementById('canvasMin');
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
  var agent = navigator.userAgent;
  var regExp = /iPhone/i;
  if(regExp.test(agent)){
    ctx.rotate((Math.PI / 180) * 90);
    ctx.translate(0, -canvas.height);
    ctx.drawImage(med, 0, 0, width, height, 0, 0, canvas.height, canvas.width);
  } else {
    ctx.drawImage(med, 0, 0, width, height, 0, 0, canvas.width, canvas.height);
  }

  return canvas.toDataURL('image/jpeg', 0.8);
};



var downsize = function(med, callback) {
  img = new Image();
  img.src = med;
  img.onload = function(){
    var width = img.naturalWidth;
    var height = img.naturalHeight;

    var canvas = document.getElementById('canvasMax');
    var ctx = canvas.getContext('2d');

    if(height > 2880) {
      canvas.height = 2880;
      canvas.width = (2880 * width)/ height;
    } else {
      canvas.height = height;
      canvas.width = width;
    }

    var agent = navigator.userAgent;
    var regExp = /iPhone/i;
    if(regExp.test(agent)){
      ctx.rotate((Math.PI / 180) * 90);
      ctx.translate(0, -canvas.height);
    }

    ctx.drawImage(img, 0, 0, width, height, 0, 0, canvas.width, canvas.height);
    callback(canvas.toDataURL('image/jpeg', 0.5));
  };
};
// Multiple images preview in browser
var imagesPreview = function(input, place) {
            var type = input.type.split('/')[0];

            if(type=='image') {

              $this = $("#sendButton");
              $this.prop("disabled", false);
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
                    var dataImg = result;
                    fileList.append(input.name, dataImg);
                    console.log(dataImg);
                  });

              };
              reader.readAsDataURL(input);

            } else if(type=='video') {

              $this = $("#sendButton");
              $this.prop("disabled", false);
              var video = URL.createObjectURL(input);
              var container = $('<div class="containImg" data-id="'+input.name+'"></div>');

              $( "<p class='closeImg' data-id='"+input.name+"'>&times;</p>" ).appendTo(container);
              var videoContainer = $('<video class="preview" width="400" controls><source src='+video+'></video>');
              videoContainer.appendTo(container);
              $("<input type='text' class='legend form-control col-lg-8 offset-lg-2' placeholder='Légende (obligatoire)' name='legend' id='legend' required/><br/>").appendTo(container);
              container.appendTo(place);
              $(".closeImg").on('click', function(e) {
                $(this).parent().remove();
                fileList.delete($(this).data('id'));
              });

              fileList.append(this.files[i].name, input);
            } else {
              $this = $("#sendButton");
              $this.prop("disabled", true);
              $('#messageSend').html("<div class='alert alert-danger'>");
              $('#messageSend > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
              $('#messageSend > .alert-danger').append("<strong>" + "Ce type de fichier n'est pas autorisé ! Veuillez réessayer !" + "</strong>" );
              $('#messageSend > .alert-danger').append('</div>');
              setTimeout(function() {
                $('#messageSend').html("");
              }, 3000);
            }
};

$(function() {
    $('#my-file').on('change', function() {
        for (var i = 0; i < this.files.length; i++) {
          if(!fileList.has(this.files[i].name)) {
            imagesPreview(this.files[i], 'div.gallery');
          } else {
            $('#messageSend').html("<div class='alert alert-danger'>");
            $('#messageSend > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#messageSend > .alert-danger').append("<strong>" + "Vous avez déjà cette photo de sélectionnée !" + "</strong>" );
            $('#messageSend > .alert-danger').append('</div>');
            setTimeout(function() {
              $('#messageSend').html("");
            }, 3000);
          }

        }
    });

    $('#sendButton').on('click', function(event) {
      event.preventDefault();
      $this = $("#sendButton");
      $this.prop("disabled", true);
      $('.legend').each(function() {
        fileList.append($(this).parent().data('id')+"leg", $(this).val());
      });
      $('.preview').each(function() {
        var img = generateThumbnail(this);
        fileList.append($(this).parent().data('id')+"min", img);
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
            $('#loader').fadeOut(2000);
            $('#loader').css('display', 'none');
            console.log(data);
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

var test;
