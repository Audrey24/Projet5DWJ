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
    returnImg.innerHTML = this.value;
});


//Envoi du mail de confirmation
$(function() {
  $('#createEventSend').on('click', function() {
    console.log("test");
  var mail = $("#createEventMail").val();

  $this = $("#createEventSend");
  $this.prop("disabled", true);
  console.log(mail);

  $.ajax({
    url: "lib/mail/createEvent.php",
    type: "POST",
    data: {
      mail: mail,
      recipient: 'guilloux.audrey24@gmail.com'
    },
    cache: false,
    success: function(data) {
      console.log(data);
      $('#messageCreateEvent').html("<div class='alert alert-success'>");
      $('#messageCreateEvent > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
      $('#messageCreateEvent > .alert-success').append("<strong>Votre évènement a été crée. Vous allez recevoir un mail de confirmation afin de valider votre évènement ! </strong>");
      $('#messageCreateEvent > .alert-success').append('</div>');
      $('#createEventForm').trigger("reset");
      setTimeout(function() {
        $('#messageCreateEvent').html("");
      }, 7000);
    },
    error: function(data) {
      console.log(data);
      $('#messageCreateEvent').html("<div class='alert alert-danger'>");
      $('#messageCreateEvent > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
      $('#messageCreateEvent > .alert-danger').append($("<strong>").text("Désolé, il semble que le serveur ne réponde pas ! Veuillez réésayer plus tard, merci ! "));
      $('#messageCreateEvent > .alert-danger').append('</div>');
      $('#createEventForm').trigger("reset");
      setTimeout(function() {
        $('#messageCreateEvent').html("");
      }, 3000);
    },
    complete: function() {
      setTimeout(function() {
        $this.prop("disabled", false);
      }, 1000);
    }
  });

  $("a[data-toggle=\"tab\"]").click(function(e) {
    e.preventDefault();
    $(this).tab("show");
  });

  /*When clicking on Full hide fail/success boxes */
  $('#name').focus(function() {
    $('#messageCreateEvent').html('');
  });
 });
});
