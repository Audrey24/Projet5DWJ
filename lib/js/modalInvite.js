$(function() {
  $('#inviteMailSend').on('click', function() {
    console.log("test");
  var mail = $("#inviteMail").val();

  $this = $("#inviteMailSend");
  $this.prop("disabled", true);
  console.log(mail);

  $.ajax({
    url: url+"Admin/sendInv",
    type: "POST",
    data: {
      mail: mail,
      recipient: 'guilloux.audrey24@gmail.com'
    },
    success: function(data) {
      alerte('#inviteMessage', "Votre message a bien été envoyé.", "success");
      $('#inviteForm').trigger("reset");
      $('#modalInvite').modal("hide");
    },
    error: function(data) {
      alerte('#inviteMessage', "Désolé, il semble que le serveur ne réponde pas ! Veuillez réésayer plus tard, merci !", "danger");
      $('#inviteForm').trigger("reset");
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

  $('#name').focus(function() {
    $('#inviteMessage').html('');
  });
 });
});
