//Ajout de la classe JS à HTML
document.querySelector("html").classList.add('js');

//Initialisation des variables
var imgInput  = document.querySelector( ".input-img" ),
    button     = document.querySelector( ".input-img-trigger" ),
    returnImg = document.querySelector(".img-return");

//Action lorsque la "barre d'espace" ou "Entrée" est pressée
button.addEventListener( "keydown", function( event ) {
    if ( event.keyCode == 13 || event.keyCode == 32 ) {
        imgInput.focus();
    }
});

//Action lorsque le label est cliqué
button.addEventListener( "click", function( event ) {
   imgInput.focus();
   return false;
});

//Affiche un retour visuel dès que input:file change
imgInput.addEventListener( "change", function( event ) {
    returnImg.innerHTML = this.value;
});
