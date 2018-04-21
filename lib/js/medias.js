baguetteBox.run('.tz-gallery', {
  async: true
});

$(document).on('click','.close', function(event){
      console.log("click");
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
          console.log('Erreur');
          //TODO: message suppression ratee
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
