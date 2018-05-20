//Formulaire de connexion
$(function() {
  $('#btnCreateAccount').on('click', function() {
    $('#signinForm').removeAttr("style").hide();
    $('#signupForm').removeAttr("style").show();
  });

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
          //Les données recues du serveur sont un string donc on les "parse" pour les transformer en objet JS et on les insère dans "data".
          if(data.hasOwnProperty('message11')) {
            var call = function() {
              window.location.replace("myEvent");
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
            alerte('#successSignin', msg, "danger");
            $('#signinForm').trigger("reset");
          }
        },
        error: function(data) {
          alerte('#successSignin', "Désolé, il semble y avoir un problème : " + data, "danger");
          $('#signinForm').trigger("reset");
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


//Formulaire d'inscription
$(function() {
  $('#btnSignup').on('click', function(event) {
    event.preventDefault();
    var captcha = grecaptcha.getResponse();
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
              var call = function() {
                window.location.replace("home");
              };
            alerte('#successSignup', data.message1, "success", call);

            $('#signupForm').trigger("reset");
            } else {
              msg = "";
              for(i = 1; i<9; i++) {
                if(data.hasOwnProperty('message'+i)) {
                  msg += data['message' + i];
                  msg += ' ' ;
                }
              }
            alerte('#successSignup',  msg + "" + "Votre inscription n'a pas été validée.", "danger");
            $('#signupForm').trigger("reset");
          }
        },
        error: function(data) {
          alerte('#successSignup', "Désolé " + firstName + ", il semble y avoir un problème. Votre inscription n'a pas été validée." + data, "danger");
          $('#signupForm').trigger("reset");
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

//Ouverture de la modale "Mdp oublié"
$(document).on('click','#forgetLogin', function(event){
  event.preventDefault();
  $('#modalForgetLogin').modal('show');
});

//Formulaire pour récupérer son mot de passe
$(function() {
$(document).on('click','#btnGetLogin', function(event) {
    event.preventDefault();
    var mail = $("#mailGetLogin").val();
    $this = $("#btnGetLogin");
    $this.prop("disabled", true);
      //Requête Ajax : on appelle la fonction.
      $.ajax({
        async: true,
        url: url+ "Login/generateLog",
        type: "POST",
        data: {
          mail: mail
        },
        cache: false,
        success: function(data) {
          $this.prop("disabled", false);
          var call = function() {
            $('#modalForgetLogin').modal("hide");
          };
        alerte('#sendMail', "Un mail vous a été envoyé pour réinitialiser votre mot de passe", "success", call);
        }
      });
  });
});

//Formulaire pour réinitialiser son mot de passe
$(function() {
  $("#btnReset").on('click', function(event) {
    event.preventDefault();
    var pass = $("#resetPass").val();
    console.log(pass);

    var id = window.location.href;
    id = id.split("/")[6];
    console.log(id);
    $("#btnReset").prop("disabled", true);
      $.ajax({
        async: true,
        url: url+ "Login/updateLog",
        type: "POST",
        data: {
          pass: pass,
          id : id
        },
        success: function(data) {
          $("#btnReset").prop("disabled", false);
          var call = function() {
            window.location.replace("home");
          };
          alerte('#resetSuccess',"Votre mot de passe a bien été réinitialisé", "success", call);
          $('#resetLog').trigger("reset");
          },
        error: function() {
          alerte('#resetSuccess',"Désolé, il semble y avoir un problème avec le serveur. Votre mot de passe n'a pas pu être modifié ! Veuillez recommencer s'il vous plait", "danger");
          $('#resetLog').trigger("reset");
        },
      });
  });
});
