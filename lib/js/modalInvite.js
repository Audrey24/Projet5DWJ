$(function() {
  $('#inviteMailSend').on('click', function() {
    console.log("test");
  var mail = $("#inviteMail").val();

  $this = $("#inviteMailSend");
  $this.prop("disabled", true);
  console.log(mail);

  $.ajax({
    url: "lib/mail/modalInvitation.php",
    type: "POST",
    data: {
      mail: mail,
      recipient: 'guilloux.audrey24@gmail.com'
    },
    cache: false,
    success: function(data) {
      console.log(data);
      $('#inviteMessage').html("<div class='alert alert-success'>");
      $('#inviteMessage > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
      $('#inviteMessage > .alert-success').append("<strong>Votre message a bien été envoyé. </strong>");
      $('#inviteMessage > .alert-success').append('</div>');
      $('#inviteForm').trigger("reset");
      setTimeout(function() {
        $('#inviteMessage').html("");
      }, 3000);
    },
    error: function(data) {
      console.log(data);
      $('#inviteMessage').html("<div class='alert alert-danger'>");
      $('#inviteMessage > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
      $('#inviteMessage > .alert-danger').append($("<strong>").text("Désolé, il semble que le serveur ne réponde pas ! Veuillez réésayer plus tard, merci ! "));
      $('#inviteMessage > .alert-danger').append('</div>');
      $('#inviteForm').trigger("reset");
      setTimeout(function() {
        $('#inviteMessage').html("");
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
    $('#inviteMessage').html('');
  });
 });
});
