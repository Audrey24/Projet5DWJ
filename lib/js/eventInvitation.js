$(function() {
  $('#btnacceptEvent').on('click', function() {
    var id = $(this).data('id');
    var id_user = $(this).data('user');
    event.preventDefault();
    $this = $("#btnacceptEvent");
    $this.prop("disabled", true);
        $.ajax({
          async: true,
          url: url + "Login/accept",
          type: "POST",
          data: {
            id : id,
            id_user : id_user
          },
          cache: false,
          success: function(data) {
            console.log(data);
            $('#messageAcceptInvite').html("<div class='alert alert-success'>");
            $('#messageAcceptInvite > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#messageAcceptInvite > .alert-success').append("Vous allez être rédirigé vers votre évènement");
            $('#messageAcceptInvite > .alert-success').append('</div>');
            setTimeout(function() {
              $('#messageAcceptInvite').html("");
              window.location.replace("../../myEvent");
          }, 3000);
        },
        error: function(data) {
          console.log(data);
          $('#messageAcceptInvite').html("<div class='alert alert-danger'>");
          $('#messageAcceptInvite > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#messageAcceptInvite > .alert-danger').append($("<strong>").text("Désolé, il semble y avoir un problème. Veuillez recommencer." + data ));
          $('#messageAcceptInvite > .alert-danger').append('</div>');
          setTimeout(function() {
            $('#messageAcceptInvite').html("");
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
