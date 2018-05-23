//Ajout de la classe JS à HTML
document.querySelector("html").classList.add('js');

$(function() {
  //Action lorsque la "barre d'espace" ou "Entrée" est pressée
  $(".input-img-trigger").on("keydown", function(event) {
      if (event.keyCode == 13 || event.keyCode == 32) {
          this.focus();
      }
  });

  //Action lorsque le label est cliqué
  $(".input-img-trigger").on("click", function(event) {
     this.focus();
     return false;
  });

  //Affiche un retour visuel dès que input:file change
  $(".input-img").on("change", function( event ) {
      $(".img-return").innerHTML = this.value.split('/').pop().split('\\').pop();
  });

  //Création de l'évènement
  $('#createEventSend').on('click', function(event) {
    $this = $("#createEventSend");
    event.preventDefault();
    $this.prop("disabled", true);
    var typeSend = $('#myImg')[0].files[0].type.split('/')[0];
    console.log(typeSend);
    if(typeSend == "image") {
      var formData = new FormData();
      formData.append("color", $('#createEventColor').val());
      formData.append("title", $('#createEventTitle').val());
      var reader = new FileReader();
      reader.onload = function(event) {
        downsize(event.target.result, function(result){
          formData.append("backgroundImg", result);
          console.log(formData);
          $.ajax({
            url: "CreateEvent/create",
            type: "POST",
            data : formData,
            processData : false,
            contentType: false,
            success: function(data) {
              console.log(data);
              var call = function() {
                //window.location.replace("myEvent");
              };
              alerte('#messageCreateEvent', "Votre évènement a été crée.", "success", call);
              $('#createEventForm').val("");
              $('#createEventForm').trigger("reset");
            },
            error: function(data) {
              alerte('#messageCreateEvent', "Désolé, votre message n'a pas pu être envoyé !", "danger");
              $('#createEventForm').val("");
              $('#createEventForm').trigger("reset");
            },
            complete: function() {
              setTimeout(function() {
                $this.prop("disabled", false);
              }, 1000);
            }
          });
        });
      };
      reader.readAsDataURL($('#myImg')[0].files[0]);
    } else {
      var call = function() {
        $this.prop("disabled", false);
      };
    alerte('#messageCreateEvent', "Désolé, vous ne pouvez pas utiliser ce type de fichier !", "danger", call);
    }
  });
});
