$(document).on('click','.deleteMod', function(event){
  $('#modalDelete').modal('show');
  var id = $(this).data('idimg');
  $('#validBtn').data("idimg", id);
});

$(document).on('click', '.closedModal', function(event) {
  $('#modalDelete').modal('hide');
});

$(document).on('click','.delete', function(event){
  var id = $(this).data("idimg");
      $.ajax({
        url: url+'Medias/delete',
        type: 'POST',
        data: {
          idImg: id,
        },
        success: function(data) {
          $("#"+id).remove();
          $('#modalDelete').modal('hide');
        },
        error: function(data) {
          alerte('#msgDeleteMedias', "La suppression n'est pas pu être effectuée ! Veuillez réessayer !", "danger");
        }
      });
  });

$(function(){
  $('.grid').infiniteScroll({
    // options
    path: function() {
      var pageNumber = this.loadCount;
      return url+'Medias/getPage/' + pageNumber;
    },
    append: '.grid-item',
    history: false,
  });
});


$(document).on('click','.openMod', function(event){
    $('#modalImage').modal({backdrop: 'static',
    keyboard: false });
    var video = $($.parseHTML('<video class="getImgModal center" controls></video>'));
    var img = $($.parseHTML('<img class="getImgModal center">'));

    var id = $(this).parent().data('idimg');
    var ext = $(this).parent().data('extension');
    if(ext == "mp4" || ext == 'mov') {
      //video.style.display = 'block';
      video.show();
      video.attr('src', 'eventsData/'+ idevent + '/' + id + "." + ext);
      //img.style.display = 'none';
      img.hide();
    } else {
      img.show();
      img.attr('src', 'eventsData/'+ idevent + '/' + id + "." + ext);
      video.hide();
    }

    var next = $("#arrowsright");
    var prev = $("#arrowsleft");

    next.on('click', function(e) {
        var newid = id + 1;
        ext = $('#'+newid).data('extension');
        if(ext != null) {
          id = newid;
        if(ext == "mp4") {
          video.show();
          video.attr('src', 'eventsData/'+ idevent + '/' + id + "." + ext);
          img.hide();
        } else {
          img.show();
          img.attr('src', 'eventsData/'+ idevent + '/' + id + "." + ext);
          video.hide();
        }
      }
    });

    prev.on('click', function(e) {
      var newid = id - 1;
       ext = $('#'+newid).data('extension');
       if (ext != null) {
         id = newid;
       if(ext == "mp4") {
         video.show();
         video.attr('src', 'eventsData/'+ idevent + '/' + id + "." + ext);
         img.hide();
       } else {
         img.show();
         img.attr('src', 'eventsData/'+ idevent + '/' + id + "." + ext);
         video.hide();
       }
     }
    });

    $(document).on( "keydown", function( e ) {
      var code = e.keyCode;
      if( code == 39 ) {
        next.trigger( "click" );
      }
      if( code == 37 ) {
        prev.trigger( "click" );
      }

    });

      $('#modalImage').append(video);
      $('#modalImage').append(img);
  });

$(document).on('click','.closeMod', function(event){
    $('#modalImage').modal('hide');
    console.log('closing image modal');
    $('.getImgModal').remove();
    });
