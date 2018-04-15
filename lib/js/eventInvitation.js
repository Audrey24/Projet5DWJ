window.onload = function() {
$('#signupForm').removeAttr("style").hide();

$('#btnCreateAccount').on('click', function() {
  $('#signinForm').removeAttr("style").hide();
  $('#signupForm').removeAttr("style").show();
});
};

//Formulaire de connexion
$(function() {
  $('#btnCreateSignin').on('click', function() {
    event.preventDefault();
    $this = $("#btnCreateSignin");
    $this.prop("disabled", true);
    console.log($("#signinForm").serialize());
    $.ajax({
        async: true,
        url: url+ "Login/signin",
        type: "POST",
        data: $("#signinForm").serialize(),
        cache: false,
        success: function(data) {
          console.log(data);
          data = JSON.parse(data);
          if(data.hasOwnProperty('message11')) {
            $('#successSignin').html("<div class='alert alert-success'>");
            $('#successSignin > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#successSignin > .alert-success').append("<strong>" + data.message11 + "</strong>");
            $('successSignin > .alert-success').append('</div>');
            $('#signinForm').trigger("reset");
            setTimeout(function() {
              $('#successSignin').html("");
                window.location.replace("../../myEvent");
            }, 3000);
          } else {
            msg = "";
            for(i = 10; i<11; i++) {
              if(data.hasOwnProperty('message'+i)) {
                msg += data['message' + i];
                msg += ' ' ;
              }
            }
            $('#successSignin').html("<div class='alert alert-danger'>");
            $('#successSignin > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#successSignin > .alert-danger').append($("<strong>").text(msg));
            $('#successSignin > .alert-danger').append('</div>');
            $('#signinForm').trigger("reset");
            setTimeout(function() {
              $('#successSignin').html("");
            }, 3000);
          }
        },
        error: function(data) {
          console.log(data);
          $('#successSignin').html("<div class='alert alert-danger'>");
          $('#successSignin > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
          $('#successSignin > .alert-danger').append($("<strong>").text("Désolé, il semble y avoir un problème : " + data ));
          $('#successSignin > .alert-danger').append('</div>');
          $('#signinForm').trigger("reset");
          setTimeout(function() {
            $('#successSignin').html("");
          }, 3000);
        },
        complete: function() {
          setTimeout(function() {
            $this.prop("disabled", false);
          }, 1000);
        }
    });
});
});


//Formulaire d'inscription
$(function() {
  $('#btnSignup').on('click', function() {
    event.preventDefault();
    $this = $("#btnSignup");
    $this.prop("disabled", true);
        $.ajax({
          async: true,
          url:url + "Login/signup",
          type: "POST",
          data: $("#signupForm").serialize(),
          cache: false,
          success: function(data) {
            console.log(data);
            data = JSON.parse(data);
          if(data.hasOwnProperty('message1')) {
            console.log("reussi ajax");
            $('#successSignup').html("<div class='alert alert-success'>");
            $('#successSignup > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#successSignup > .alert-success').append("<strong>" + data.message1 + "</strong>");
            $('#successSignup > .alert-success').append('</div>');
            $('#signupForm').trigger("reset");
            acceptInvite();
            setTimeout(function() {
              $('#successSignup').html("");
              window.location.replace("../../myEvent");
          }, 3000);
          } else {
              msg = "";
              for(i = 1; i<8; i++) {
                if(data.hasOwnProperty('message'+i)) {
                  msg += data['message' + i];
                  msg += ' ' ;
                }
              }
            $('#successSignup').html("<div class='alert alert-danger'>");
            $('#successSignup > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
              .append("</button>");
            $('#successSignup > .alert-danger').append($("<strong>").text("" + msg + "" + "Votre inscription n'a pas été validée." ));
            $('#successSignup > .alert-danger').append('</div>');
            $('#signupForm').trigger("reset");
            setTimeout(function() {
              $('#successSignup').html("");
            }, 3000);
          }
        },
        error: function(data) {
          $('#successSignup').html("<div class='alert alert-danger'>");
          $('#successSignup > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#successSignup > .alert-danger').append($("<strong>").text("Désolé " + firstName + ", il semble y avoir un problème. Votre inscription n'a pas été validée." + data ));
          $('#successSignup > .alert-danger').append('</div>');
          $('#signupForm').trigger("reset");
          setTimeout(function() {
            $('#successSignup').html("");
          }, 3000);
        },
        complete: function() {
          setTimeout(function() {
            $this.prop("disabled", false);
          }, 1000);
        }
      });
  });
});

//Fonction accepter invitation reçue
/*$(function() {
  $('#btnacceptEvent').on('click', function() {
    var id = $("#successSignup").data('event');
    console.log(id);
    event.preventDefault();
    $this = $("#btnacceptEvent");
    $this.prop("disabled", true);
        $.ajax({
          async: true,
          url: url + "Login/accept",
          type: "POST",
          data: {
            id : id,
          },
          cache: false,
          success: function(data) {
            console.log(data);
            $('#successSignup').html("<div class='alert alert-success'>");
            $('#successSignup > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#successSignup > .alert-success').append("Vous allez être rédirigé vers votre évènement");
            $('#successSignup > .alert-success').append('</div>');
            setTimeout(function() {
              $('#successSignup').html("");
              window.location.replace("../../myEvent");
          }, 3000);
        },
        error: function(data) {
          console.log(data);
          $('#successSignup').html("<div class='alert alert-danger'>");
          $('#successSignup > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#successSignup > .alert-danger').append($("<strong>").text("Désolé, il semble y avoir un problème. Veuillez recommencer." + data ));
          $('#successSignup > .alert-danger').append('</div>');
          setTimeout(function() {
            $('#successSignup').html("");
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
});*/


function acceptInvite() {
    var id = $("#successSignup").data('event');
    console.log(id);
    event.preventDefault();
    $this = $("#btnacceptEvent");
    $this.prop("disabled", true);
        $.ajax({
          async: true,
          url: url + "Login/accept",
          type: "POST",
          data: {
            id : id,
          },
          cache: false,
          success: function(data) {
            console.log(data);
            $('#successSignup').html("<div class='alert alert-success'>");
            $('#successSignup > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#successSignup > .alert-success').append("Vous allez être rédirigé vers votre évènement");
            $('#successSignup > .alert-success').append('</div>');
            setTimeout(function() {
              $('#successSignup').html("");
              window.location.replace("../../myEvent");
          }, 3000);
        },
        error: function(data) {
          console.log(data);
          $('#successSignup').html("<div class='alert alert-danger'>");
          $('#successSignup > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#successSignup > .alert-danger').append($("<strong>").text("Désolé, il semble y avoir un problème. Veuillez recommencer." + data ));
          $('#successSignup > .alert-danger').append('</div>');
          setTimeout(function() {
            $('#successSignup').html("");
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


  $('#btnacceptEvent').on('click', function() {
    acceptInvite();
  });
