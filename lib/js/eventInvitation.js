window.onload = function() {
  $('#signupForm').removeAttr("style").hide();
  $('#btnCreateAccount').on('click', function() {
    $('#signinForm').removeAttr("style").hide();
    $('#signupForm').removeAttr("style").show();
  });
};

//Formulaire de connexion
$(function() {
  $('#btnCreateSignin').on('click', function(event) {
    event.preventDefault();
    $this = $("#btnCreateSignin");
    $this.prop("disabled", true);
    $.ajax({
        async: true,
        url: url+ "Login/signin",
        type: "POST",
        data: $("#signinForm").serialize(),
        cache: false,
        success: function(data) {
          data = JSON.parse(data);
          if(data.hasOwnProperty('message11')) {
            var call = function() {
              window.location.replace("../../myEvent");
            };
            alerte('#successSignin', data.message11, "success", call);
            $('#signinForm').trigger("reset");
          } else {
            msg = "";
            for(i = 10; i<11; i++) {
              if(data.hasOwnProperty('message'+i)) {
                msg += data['message' + i];
                msg += ' ' ;
              }
            }
            alerte('#successSignin',msg, "danger");
            $('#signinForm').trigger("reset");
          }
        },
        error: function(data) {
          alerte('#successSignin', "Désolé, il semble y avoir un problème : " + data, "danger");
          $('#signinForm').trigger("reset");
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
  $('#btnSignup').on('click', function(event) {
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
            data = JSON.parse(data);
            if(data.hasOwnProperty('message1')) {
              var call = function() {
                window.location.replace("../../myEvent");
              };
              alerte('#successSignup', data.message1, "success", call);
              $('#signupForm').trigger("reset");
              acceptInvite();
            } else {
              msg = "";
              for(i = 1; i<8; i++) {
                if(data.hasOwnProperty('message'+i)) {
                  msg += data['message' + i];
                  msg += ' ' ;
                }
              }
              alerte('#successSignup', msg + "" + "Votre inscription n'a pas été validée.", "danger");
              $('#signupForm').trigger("reset");
          }
        },
        error: function(data) {
          alerte('#successSignup', "Désolé " + firstName + ", il semble y avoir un problème. Votre inscription n'a pas été validée." + data, "danger");
          $('#signupForm').trigger("reset");
        },
        complete: function() {
          setTimeout(function() {
            $this.prop("disabled", false);
          }, 1000);
        }
    });
  });
});

function acceptInvite() {
    var id = $("#successSignup").data('event');
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
            var call = function() {
              window.location.replace("../../myEvent");
            };
            alerte('#successSignup', "Vous allez être rédirigé vers votre évènement", "success", call);
          },
          error: function(data) {
            alerte('#successSignup', "Désolé, il semble y avoir un problème. Veuillez recommencer." + data , "danger");
          },
          complete: function() {
            setTimeout(function() {
              $this.prop("disabled", false);
            }, 1000);
          }
      });
  }

  $('#btnacceptEvent').on('click', function(event) {
    event.preventDefault();
    acceptInvite();
  });
