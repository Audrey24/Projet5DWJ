$(function() {
  var update = 0;
  $('#newColor').on('change', function() {
      update = 1;
    });
  $('#bntUpdate').on('click', function() {
    event.preventDefault();
    $this = $("#bntUpdate");
    $this.prop("disabled", true);
    /*console.log(  $('#newColor').val());
    if(!update) {
      $('#newColor').val(null);
      console.log('on q chqng! q null');
    }
    console.log(  $('#newColor').val());*/
    $.ajax({
        async: true,
        url: "Admin/updateEvent",
        type: "POST",
        data: {
          form: $("#updateForm").serialize(),
          update: update
        },
        cache: false,
        success: function(data) {
          console.log(data);
          //data = JSON.parse(data);
          $('#updateMessage').html("<div class='alert alert-success'>");
          $('#updateMessage > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
          $('#updateMessage > .alert-success').append("<strong>Vos modifications ont bien été enegistrées. </strong>");
          $('#updateMessage > .alert-success').append('</div>');
          //Après un délais, on redirige vers Home.
          setTimeout(function() {
            $('#updateMessage').html("");
          }, 3000);
        },
        //Si la requêt n'a pas abouti, on envoit un message d'erreur.
        error: function(data) {
          console.log(data);
          //console.log("je suis dans error de Formjs");
          $('#updateMessage').html("<div class='alert alert-danger'>");
          $('#updateMessage > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
          $('#updateMessage > .alert-danger').append("<strong>Désolé, il semble y avoir un problème, veuillez réessayer.");
          $('#updateMessage > .alert-danger').append('</div>');
          //Après 3s, on efface le msg.
          setTimeout(function() {
            $('#updateMessage').html("");
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

//Fonction pour supprimer un évènement.
$(function() {
//Evenement au clique de la classe "delete".
$(document).on('click','.delete',function() {
  //On récupère l'id mis dans le bouton "valider" et on le range dans une var.
  var id = $(this).data('id');
  var line = $('#'+id);
  //Requête Ajax : on appelle la fonction qui prend en paramètre d'url l'id sélectionné.
  $.ajax({
    async: true,
    url : url+"MyEvent/delete/",
    type :"POST",
    data : {
      id : id,
    },
    success: function(data){
    //console.log(data);
    //Si succès on ferme la modale et on supprime la ligne du tableau.
      $('#modalDelete').modal("hide");
      line.remove();
    //On envoit un msg pour confirmer la suppression.
      $('#messageEvent').html("<div class='alert alert-success'>");
      $('#messageEvent > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
      $('#messageEvent > .alert-success').append("<strong>" + "L'évènement a bien été supprimé" + "</strong>");
      $('#messageEvent> .alert-success').append('</div>');
      //Délai avant la fin du message.
      setTimeout(function() {
        $('#messageEvent').html("");
      }, 3000);
    }
});
});
});

//Fonction pour supprimer des participants
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
  var line = $('#pseudo'+id);
$.get(
  url+ "Admin/deleteUsers/" + id,
  function(data) {
    $('#modalDelete').modal("hide");
    line.remove();
    $('#deletePseudo').html("<div class='alert alert-success'>");
    $('#deletePseudo > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;").append("</button>");
    $('#deletePseudo > .alert-success').append("<strong>" + "Le participant a bien été supprimé de votre évènement" + "</strong>");
    $('#deletePseudo > .alert-success').append('</div>');
    setTimeout(function() {
      $('#deletePseudo').html("");
    }, 3000);
  });
});
