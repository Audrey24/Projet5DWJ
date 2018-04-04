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
      console.log(data);
      $('#contactSendMessage').html("<div class='alert alert-success'>");
      $('#contactSendMessage > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
      $('#contactSendMessage > .alert-success').append("<strong>Votre message a bien été envoyé. </strong>");
      $('#contactSendMessage > .alert-success').append('</div>');
      $('#contactForm').trigger("reset");
      setTimeout(function() {
        $('#contactSendMessage').html("");
      }, 3000);
    },
    error: function() {
      $('#contactSendMessage').html("<div class='alert alert-danger'>");
      $('#contactSendMessage > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
      $('#contactSendMessage > .alert-danger').append($("<strong>").text("Désolé, il semble que le serveur ne réponde pas ! Veuillez réésayer plus tard, merci ! "));
      $('#contactSendMessage > .alert-danger').append('</div>');
      $('#contactForm').trigger("reset");
      setTimeout(function() {
        $('#contactSendMessage').html("");
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
    $('#contactSendMessage').html('');
  });
 });
});
