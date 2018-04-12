$(function() {
  $('#btnChoiceEvent').on('click', function() {
    event.preventDefault();
    $this = $("#btnChoiceEvent");
    $this.prop("disabled", true);
    $.ajax({
        async: true,
        url: "MyEvent/register",
        type: "POST",
        data: $("#getEventForm").serialize(),
        cache: false,
        success: function(data) {
          console.log(data);
          //data = JSON.parse(data);
          $('#messageEvent').html("<div class='alert alert-success'>");
          $('#messageEvent > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
          $('#messageEvent > .alert-success').append("<strong>Merci, vous allez être redirigé vers votre interface. </strong>");
          $('#messageEvent > .alert-success').append('</div>');
          //Après un délais, on redirige vers Home.
          setTimeout(function() {
              window.location.replace("Home");
            }, 3000);
        },
        //Si la requêt n'a pas abouti, on envoit un message d'erreur.
        error: function(data) {
          console.log(data);
          //console.log("je suis dans error de Formjs");
          $('#messageEvent').html("<div class='alert alert-danger'>");
          $('#messageEvent > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
          $('#messageEvent > .alert-danger').append($("<strong>").text("Désolé, il semble y avoir un problème, veuillez réessayer." ));
          $('#messageEvent > .alert-danger').append('</div>');
          //Après 3s, on efface le msg.
          setTimeout(function() {
            $('#messageEvent').html("");
          }, 3000);
        },
        complete: function() {
          //On réactive le bouton "créer" lorsque l'appel AJAX est terminé
          setTimeout(function() {
            $this.prop("disabled", false);
          }, 1000);
        }
    });
});
});
