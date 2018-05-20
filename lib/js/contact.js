$(function() {
  $('#contactSend').on('click', function() {
  var name = $("input#contactName").val();
  var email = $("input#contactMail").val();
  var message = $("textarea#contactMessage").val();

  $this = $("#contactSend");
  $this.prop("disabled", true);

  $.ajax({
    url: "lib/mail/contact.php",
    type: "POST",
    data: {
      name: name,
      email: email,
      message: message,
      recipient: 'guilloux.audrey24@gmail.com'
    },
    cache: false,
    success: function(data) {
      alerte('#contactSendMessage', "Votre message a bien été envoyé.", "success");
      $('#contactForm').trigger("reset");
    },
    error: function() {
      alerte('#contactSendMessage', "Désolé, il semble que le serveur ne réponde pas ! Veuillez réésayer plus tard, merci !", "danger");
      $('#contactForm').trigger("reset");
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
    $('#contactSendMessage').html('');
  });
 });
});
