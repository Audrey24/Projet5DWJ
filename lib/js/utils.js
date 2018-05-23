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
    url: url + "Login/getGlobalVar",
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

/**
* @summary Reduit le poids d'une image en conservant un niveau de qualité acceptable
* @param {img} med - Une image encodée en base 64
* @param {function} callback - Ce qu'il faut faire avec l'image redimensionnée
*/
var downsize = function(med, callback) {
  img = new Image();
  img.onload = function(){
    var width = img.naturalWidth;
    var height = img.naturalHeight;

    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext('2d');

    if(height > 2880) {
      canvas.height = 2880;
      canvas.width = (2880 * width)/ height;
    } else {
      canvas.height = height;
      canvas.width = width;
    }

    /*
   Note : 21-05-2018 iOS adopte un comportement normal pour du canvas image
    var agent = navigator.userAgent;
    var regExp = /iPhone/i;
    if(regExp.test(agent)){
      ctx.rotate((Math.PI / 180) * 90);
      ctx.translate(0, -canvas.height);
    }*/

    ctx.drawImage(img, 0, 0, width, height, 0, 0, canvas.width, canvas.height);
    callback(canvas.toDataURL('image/jpeg', 0.5));
  };
  img.src = med;
};
