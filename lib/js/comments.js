//Evenement sur le clique du bouton "commenter" de la page "Lecture en cours".
$('#sendComment').on('click', function() {
  var content = $("#comments").val();
  $this = $("#sendComment");
  $this.prop("disabled", true);
  $.ajax({
    url: url + "Comments/comment",
    type: "POST",
    data : {
      content : content,
    },
    success: function(data) {
      if (content == "") {
        alerte('#commentMessage', "Votre commentaire est vide", "danger");
        $('#comments').val("");
      } else {
        var date = new Date();
        var text = '<p>' + pseudo + " " + date.toLocaleDateString("fr-FR") + '</p>';
            text +=  '<p>' + content + '</p>' ;
        $("#containComments").append(text);
        alerte('#commentMessage', "Message envoyé", "success");
        $('#comments').val("");
       }
      },
    error: function() {
      alerte('#commentMessage', "Désolé, votre message n'a pas pu être envoyé !", "danger");
      $('#comments').val("");
      },
    complete: function() {
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
  var line = $('#com'+id);
  $.get(
    url+ "Comments/deleteComments/" + id,
    function(data) {
      $('#modalDelete').modal("hide");
      line.remove();
      alerte('#tableMessage', "Le commentaire a bien été supprimé !", "success");
    });
  });
