$(function() {
  $('#btnChoiceEvent').on('click', function(event) {
    event.preventDefault();
    $this = $("#btnChoiceEvent");
    $this.prop("disabled", true);
    $.ajax({
        async: true,
        url: "MyEvent/register",
        type: "POST",
        data: $("#getEventForm").serialize(),
        cache: false,
        success: function(data) {
          var call = function() {
            window.location.replace("Home");
          };
          alerte('#messageEvent', "Merci, vous allez être redirigé vers votre interface.", "success", call);
        },
        error: function(data) {
          alerte('#messageEvent',"Désolé, il semble y avoir un problème, veuillez réessayer.", "danger");
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
  $(document).on('click','.delete',function() {
    var id = $(this).data('id');
    var line = $('#'+id);
    $.ajax({
      async: true,
      url : url+"MyEvent/delete/",
      type :"POST",
      data : {
        id : id,
      },
      success: function(data){
        $('#modalDelete').modal("hide");
        line.remove();
        alerte('#messageEvent',"L'évènement a bien été supprimé", "success");
      }
    });
  });
});
