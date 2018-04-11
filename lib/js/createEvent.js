//Ajout de la classe JS à HTML
document.querySelector("html").classList.add('js');

//Initialisation des variables
var imgInput  = document.querySelector( ".input-img" ),
    button     = document.querySelector( ".input-img-trigger" ),
    returnImg = document.querySelector(".img-return");

//Action lorsque la "barre d'espace" ou "Entrée" est pressée
button.addEventListener( "keydown", function( event ) {
    if ( event.keyCode == 13 || event.keyCode == 32 ) {
        imgInput.focus();
    }
});

//Action lorsque le label est cliqué
button.addEventListener( "click", function( event ) {
   imgInput.focus();
   return false;
});

//Affiche un retour visuel dès que input:file change
imgInput.addEventListener( "change", function( event ) {
    returnImg.innerHTML = this.value.split('/').pop().split('\\').pop();
});

//Création de l'évènement
$('#createEventSend').on('click', function() {
  $this = $("#createEventSend");

  // On désactive le bouton "valider" jusqu'à ce que l'appel Ajax soit terminé pour éviter les messages en vide
  $this.prop("disabled", true);

  //Requête pour envoyer au serveur les données contenu, id de l'user et id du texte.
  $.ajax({
    url: "CreateEvent/create",
    type: "POST",
    data : new FormData($('#createEventForm')[0]),
    processData : false,
    contentType: false,
    //Si la requête a aboutit, on insère les données dans le tableau et on affiche un msg pour confirmer l'envoi.
    success: function(data) {
      console.log(data);
        $('#messageCreateEvent').html("<div class='alert alert-success'>");
        $('#messageCreateEvent > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
        $('#messageCreateEvent> .alert-success').append("<strong>" + "Votre évènement a été crée. Vous allez recevoir un mail de confirmation afin de valider votre évènement !" + "</strong>");
        $('#messageCreateEvent > .alert-success').append('</div>');
        //On efface les champs/
        $('#createEventForm').val("");
        //Délai avant la fin du message.
        setTimeout(function() {
          $('#messageCreateEvent').html("");
        }, 8000);
    },
    //Si la requête échoue, on envoit un msg.
    error: function(data) {
      console.log(data);
        $('#messageCreateEvent').html("<div class='alert alert-danger'>");
        $('#messageCreateEvent > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
        $('#messageCreateEvent > .alert-danger').append("<strong>" + "Désolé, votre message n'a pas pu être envoyé !" + "</strong>" );
        $('#messageCreateEvent > .alert-danger').append('</div>');
        //On efface les champs/
        $('#createEventForm').val("");
        //Délai avant la fin du message.
        setTimeout(function() {
          $('#messageCreateEvent').html("");
        }, 3000);
      },

      complete: function() {
        //On réactive le bouton "valider" lorsque l'appel AJAX est terminé
        setTimeout(function() {
          $this.prop("disabled", false);
        }, 1000);
      }
    });
  });
