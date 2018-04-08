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


$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, place) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    var container = $('<div class="containImg"></div>');
                    $($.parseHTML('<img class="preview">')).attr('src', event.target.result).appendTo(container);
                    $( "<p class='closeImg'>&times;</p>" ).appendTo(container);
                    $("<input type='text' class='form-control col-lg-8 offset-lg-2' placeholder='Légende (facultatif)' name='legend' id='legend'/><br/>").appendTo(container);
                    container.appendTo(place);
                    $(".closeImg").on('click', function(e) {
                      $(this).parent().remove();

                    });
                };

                reader.readAsDataURL(input.files[i]);
            }
        }
    };

    $('#my-file').on('change', function() {
        imagesPreview(this, 'div.gallery');
    });
});
