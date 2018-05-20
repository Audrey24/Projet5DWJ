/**
* @param {string} place - Un string ciblant un élément du DOM en jQuery
* @param {string} message - Le message a ajouter
* @param {string} type - Le type de l'alerte : danger ou success
* @param {function} callback - Une fonction a effectuer après l'apparition du msg

*/
var alerte = function(place, message, type, callback = "") {
  $(place).html("<div class='alert alert-"+ type + "'>");
  $(place + ' > .alert-'+ type).html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
    .append("</button>");
  $(place + ' > .alert-'+ type).append($("<strong>").text(message));
  $(place + ' > .alert-'+ type).append('</div>');
  setTimeout(function() {
    $(place).html("");
    if(callback != "") {
      callback();
    }
  }, 3000);
};

/**
* @summary Initialise les variables globales en js
*/
var getGlobalVar = function() {
  $.ajax({
    url: "Login/getGlobalVar",
    type: "GET",
    success: function(data) {
      data = JSON.parse(data);
      for(var key in data) {
        window[key] = data[key];
      }
    },
    error: function(data) {
      console.log('erreur de connexion');
    },
  });
};
