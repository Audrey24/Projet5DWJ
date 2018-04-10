$(".updateCol2").on("click", function() {
  var name = $(this).data('file');

  //Requête Ajax : on récupère le fichier dans function(data) et on l'affiche dans le div en fonction du type précisé.
  $.ajax ({
    url : "views/"+ name +".php",
    type :"GET",
    async:true,
    success:  function(data) {
      $("#colonne2").html(data);
    }
  });
});
