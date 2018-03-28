//Ajout de la classe JS à HTML
document.querySelector("html").classList.add('js');

//Initialisation des variables
var fileInput  = document.querySelector( ".input-file" ),
    button     = document.querySelector( ".input-file-trigger" ),
    returnFile = document.querySelector(".file-return");

//Action lorsque la "barre d'espace" ou "Entrée" est pressée
button.addEventListener( "keydown", function( event ) {
    if ( event.keyCode == 13 || event.keyCode == 32 ) {
        fileInput.focus();
    }
});

//Action lorsque le label est cliqué
button.addEventListener( "click", function( event ) {
   fileInput.focus();
   return false;
});

//Affiche un retour visuel dès que input:file change
fileInput.addEventListener( "change", function( event ) {
    returnFile.innerHTML = this.value;
});
