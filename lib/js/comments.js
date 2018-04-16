//Evenement sur le clique du bouton "commenter" de la page "Lecture en cours".
$('#sendComment').on('click', function() {
  var content = $("#comments").val();
  $this = $("#sendComment");
  // On désactive le bouton "valider" jusqu'à ce que l'appel Ajax soit terminé pour éviter les messages en vide
  $this.prop("disabled", true);
  //Requête pour envoyer au serveur les données contenu, id de l'user et id du texte.
  $.ajax({
    url: url + "Comments/comment",
    type: "POST",
    data : {
      content : content,
    },
    //Si la requête a aboutit, on insère les données dans le tableau et on affiche un msg pour confirmer l'envoi.
    success: function(data) {
      if (content == "") {
        $('#commentMessage').html("<div class='alert alert-danger'>");
        $('#commentMessage > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
        $('#commentMessage > .alert-danger').append("<strong>" + "Votre commentaire est vide !" + "</strong>" );
        $('#commentMessage > .alert-danger').append('</div>');
        //On efface les champs/
        $('#comments').val("");
        //Délai avant la fin du message.
        setTimeout(function() {
          $('#commentMessage').html("");
        }, 3000);
      } else {

        var date = new Date();

        var text = '<tr><td class="pseudo">' + pseudo + '</td>';
             text += '<td class="content" scope="row">' + content + '</td>';
             text += '<td class="date">' + date.toLocaleDateString("fr-FR") + '</td></tr>';
        $("#containComments").append(text);

        $('#commentMessage').html("<div class='alert alert-success'>");
        $('#commentMessage > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
        $('#commentMessage > .alert-success').append("<strong>" + "Message envoyé" + "</strong>");
        $('#commentMessage > .alert-success').append('</div>');
        //On efface les champs/
        $('#comments').val("");
        //Délai avant la fin du message.
        setTimeout(function() {
          $('#commentMessage').html("");
        }, 2000);
       }
      },
    //Si la requête échoue, on envoit un msg.
    error: function() {
        $('#commentMessage').html("<div class='alert alert-danger'>");
        $('#commentMessage > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
        $('#commentMessage > .alert-danger').append("<strong>" + "Désolé, votre message n'a pas pu être envoyé !" + "</strong>" );
        $('#commentMessage > .alert-danger').append('</div>');
        //On efface les champs/
        $('#comments').val("");
        //Délai avant la fin du message.
        setTimeout(function() {
          $('#commentMessage').html("");
        }, 3000);
      },

      complete: function() {
        //On réactive le bouton "valider" lorsque l'appel AJAX est terminé
        setTimeout(function() {
          $this.prop("disabled", false);
        }, 1000);
      }
    });
});



  //Fonction pour assigner l'id du bouton cliqué dans la modale.
  $('#modalDelete').on('show.bs.modal', function (event) {
  //Bouton qui déclenche la modale (icône croix).
  var button = $(event.relatedTarget);
  //Extrait la valeur de data et on le range dans une var.
  var id = button.data('id');
  var modal = $(this);
  //On assigne au bouton "valider" qui a la classe "delete", la valeur de l'id sur lequel on a cliqué via "data-id".
  modal.find('.delete').data( "id", id);
  });

  $('.closedModal').on('click',function() {
   $('#modalDelete').modal('hide');
  });

  //Evenement au clique de la classe "delete".
  $(document).on('click','.delete',function() {
    var id = $(this).data('id');
    console.log(id);
    var line = $('#'+id);
  $.get(
    url+ "Comments/deleteComments/" + id,
    function(data) {
      $('#modalDelete').modal("hide");
      line.remove();
      $('#tableMessage').html("<div class='alert alert-success'>");
      $('#tableMessage > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
      $('#tableMessage > .alert-success').append("<strong>" + "Le commentaire a bien été supprimé" + "</strong>");
      $('#tableMessage > .alert-success').append('</div>');
      setTimeout(function() {
        $('#tableMessage').html("");
      }, 3000);
    });
  });
