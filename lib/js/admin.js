$(function() {
  var update = 0;
  var updateImg = 0;
  $('#newColor').on('change', function() {
      update = 1;
    });
    $('#newImg').on('change', function() {
      updateImg = 1;
    });

  $('#bntUpdate').on('click', function(event) {
    event.preventDefault();
    $this = $("#bntUpdate");
    $this.prop("disabled", true);

    var typeSend;
    if($('#newImg')[0].files[0] != undefined) {
      typeSend = $('#newImg')[0].files[0].type.split('/')[0];
    }
    var newTitle = $('#newTitle').val();

    var formNew = new FormData($('#updateForm')[0]);
    formNew.append('update', update);
    formNew.append('updateImg', updateImg);

    if((typeSend == 'image' && updateImg )||(update && !updateImg)||(newTitle != "" && !updateImg)) {
      $.ajax({
        async: true,
        url: "Admin/updateEvent",
        type: "POST",
        data: formNew,
        processData : false,
        contentType: false,
        cache: false,
        success: function(data) {
          alerte('#updateMessage', "Vos modifications ont bien été enegistrées. Actualisez la page pour les visualiser.", "success");
          $('#updateForm').trigger("reset");
        },
        error: function(data) {
          var call = function() {
            $this.prop("disabled", false);
          };
          alerte('#updateMessage', "Désolé, il semble y avoir un problème, veuillez réessayer.", "danger", call);
          $('#updateForm').trigger("reset");
        },
        complete: function() {
          setTimeout(function() {
            $this.prop("disabled", false);
          }, 1000);
        }
    });
  } else {
      var call = function() {
        $("#imgName").html("");
        $this.prop("disabled", false);
      };
      alerte('#updateMessage', "Désolé, vous ne pouvez pas utiliser ce type de fichier.", "danger", call);
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

//Fonction pour supprimer un évènement.
$(function() {
//Evenement au clique de la classe "delete".
$(document).on('click','.delete',function() {
  //On récupère l'id mis dans le bouton "valider" et on le range dans une var.
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
      alerte('#messageEvent', "L'évènement a bien été supprimé", "success");
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
    alerte('#deletePseudo', "Le participant a bien été supprimé de votre évènement", "success");
  });
});

$('#newImg').on('change', function() {
  $('.img-return').html($(this)[0].files[0].name);
});
