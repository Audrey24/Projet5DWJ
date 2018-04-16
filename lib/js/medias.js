baguetteBox.run('.tz-gallery');

$(function() {
  $('.close').on('click', function(event){
    var obj = $(event.currentTarget);
    $.ajax({
      url: url+'Medias/delete',
      type: 'POST',
      data: {
        idImg: obj.data('idimg')
      },
      success: function(data) {
        console.log(data);
        obj.parent().remove();
      },
      error: function(data) {

      }
    });
  });
});
