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
          console.log("ajax réussi connexion");
        //Si la requête a abouti, on envoit un message de confirmation.
          console.log(data);
          data = JSON.parse(data);
          //Les données recues du serveur sont un string donc on les "parse" pour les transformer en objet JS et on les insère dans "data".
          if(data.hasOwnProperty('message11')) {
            //Si les données retournées ont cette propriété "message 12", on affiche un msg de réussite
            $('#successSignin').html("<div class='alert alert-success'>");
            $('#successSignin > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#successSignin > .alert-success').append("<strong>" + data.message11 + "</strong>");
            $('successSignin > .alert-success').append('</div>');
            //On efface les champs.
            $('#signinForm').trigger("reset");
            //Après un délais, on redirige vers Home.
            setTimeout(function() {
              $('#successSignin').html("");
                window.location.replace("myEvent");
            }, 2000);
          } else {
            console.log("pas de conexion");
            //Si les données retournées n'ont pas cette propriété "message 12".
            //on fait une boucle pour chercher quel msg est retourné et on l'affiche dans le msg d'erreur.
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
            //On nettoie les champs
            $('#signinForm').trigger("reset");
            //On efface le msg après un délais de 3s.
            setTimeout(function() {
              $('#successSignin').html("");
            }, 3000);
          }
        },
        //Si la requêt n'a pas abouti, on envoit un message d'erreur.
        error: function(data) {
          console.log(data);
          console.log("erreur conexion");
          //console.log("je suis dans error de Formjs");
          $('#successSignin').html("<div class='alert alert-danger'>");
          $('#successSignin > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
          $('#successSignin > .alert-danger').append($("<strong>").text("Désolé, il semble y avoir un problème : " + data ));
          $('#successSignin > .alert-danger').append('</div>');
          //On nettoie les champs
          $('#signinForm').trigger("reset");
          //Après 3s, on efface le msg.
          setTimeout(function() {
            $('#successSignin').html("");
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
          //Les données recues du serveur sont un string donc on les "parse" pour les transformer en objet JS et on les insère dans "data".
          if(data.hasOwnProperty('message1')) {
            console.log("reussi ajax");
            $('#successSignup').html("<div class='alert alert-success'>");
            $('#successSignup > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
            $('#successSignup > .alert-success').append("<strong>" + data.message1 + "</strong>");
            $('#successSignup > .alert-success').append('</div>');

            $('#signupForm').trigger("reset");
            //Après délai, on redirige vers Home.
            setTimeout(function() {
              $('#successSignup').html("");
              window.location.replace("home");
          }, 3000);
          } else {
              msg = "";
              for(i = 1; i<9; i++) {
                if(data.hasOwnProperty('message'+i)) {
                  msg += data['message' + i];
                  msg += ' ' ;
                }
              }
              console.log("non connexion");
            $('#successSignup').html("<div class='alert alert-danger'>");
            $('#successSignup > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
              .append("</button>");
            $('#successSignup > .alert-danger').append($("<strong>").text("" + msg + "" + "Votre inscription n'a pas été validée." ));
            $('#successSignup > .alert-danger').append('</div>');
            $('#signupForm').trigger("reset");
            setTimeout(function() {
              $('#successSignup').html("");
            }, 3000);
            //TODO : redirect
          }
        },
        error: function(data) {
          console.log("echec ajax");
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
          //On réactive le bouton "créer" lorsque l'appel AJAX est terminé
          setTimeout(function() {
            $this.prop("disabled", false);
          }, 1000);
        }
      });
  });
});

$(document).on('click','#forgetLogin', function(event){
    $('#modalForgetLogin').modal({backdrop: 'static',
    keyboard: false });
});

//Formulaire pour récupérer son mot de passe
$(function() {
  $("#btnGetLogin").on('click', function() {
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
          console.log(data);
          $this.prop("disabled", false);
        //Si la requête a abouti, on envoit un message de confirmation.
        $('#sendMail').html("<div class='alert alert-success'>");
        $('#sendMail > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
        $('#sendMail > .alert-success').append("<strong>" + "Un mail vous a été envoyé pour réinitialiser votre mot de passe" + "</strong>");
        $('#sendMail > .alert-success').append('</div>');
        setTimeout(function() {
          $('#sendMail').html("");
          $('#modalForgetLogin').modal("hide");
        }, 3000);


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
          console.log(data);
          $("#btnReset").prop("disabled", false);
        //Si la requête a abouti, on envoit un message de confirmation.
          $('#resetSuccess').html("<div class='alert alert-success'>");
          $('#resetSuccess > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $('#resetSuccess > .alert-success').append("<strong>" + "Votre mot de passe a bien été réinitialisé" + "</strong>");
          $('#resetSuccess > .alert-success').append('</div>');
          //On nettoie les champs
          $('#resetLog').trigger("reset");
          //On efface le msg après un délais de 3s.
          setTimeout(function() {
            $('#resetSuccess').html("");
            //window.location.replace("home");
          }, 3000);
          },
        error: function() {
          $('#resetSuccess').html("<div class='alert alert-danger'>");
          $('#resetSuccess > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
          $('#resetSuccess > .alert-danger').append("<strong>" + "Désolé, il semble y avoir un problème avec le serveur. Votre mot de passe n'a pas pu être modifié ! Veuillez recommencer s'il vous plait" + "</strong>" );
          $('#resetSuccess > .alert-danger').append('</div>');
          //On efface les champs/
          $('#resetLog').trigger("reset");
          //Délai avant la fin du message.
          setTimeout(function() {
          $('#resetSuccess').html("");
        }, 3000);
        },
      });
  });
});
