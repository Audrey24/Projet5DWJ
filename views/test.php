  <!-- Style for my page and loader -->
    <style type="text/css">
        body{
            margin: 0;
            padding: 0;
        }
        #text {
          position: absolute;
          top: 30%;
          margin-left: 45%;
        }

        #loader{
            height: 100vh;
            width:100%;
            background-color:white;
            z-index: 50;
            position: absolute;
            top: 0;
            left: 0;
        }

        .loader{
            width: 50px;
            height: 50px;
            display: inline-block;
            vertical-align: middle;
            position: absolute;
            margin-top: 50vh;
            margin-left: 50%;
        }
        .loader-quart{
            border-radius: 50px;
            border: 6px solid transparent;
        }
        .loader-quart:after{
            content: '';
            position: absolute;
            top: -6px; left: -6px;
            bottom: -6px; right: -6px;
            width: 50px;
            height: 50px;
            border-radius: 50px;
            border-bottom: 3px solid black;
            border-top: 3px solid red;
            animation:spin 1s linear infinite;
        }
        @keyframes spin{
            0%{ transform: rotate(0deg);}
            100%{ transform: rotate(360deg);}
        }
    </style>

    <!-- Le loader de ma page-->
    <div id="loader">
        <span class="loader loader-quart"></span>
        <span id="text">Chargement en cours ...</span>
    </div>

    <!-- Contenu de la page-->
    <div>
        <h1>Le contenu de ma page</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean nec augue sodales, tempus arcu at, pretium ligula. Aliquam a nibh eget sem volutpat facilisis eu vitae leo. In in dictum nulla, a sodales sem. Donec lorem arcu, facilisis in enim eget, gravida faucibus ipsum. Quisque quis ipsum nibh. Donec luctus laoreet felis non volutpat. Pellentesque ultricies nunc tellus. Donec consequat, nulla sit amet convallis volutpat, leo metus scelerisque neque, quis mollis risus felis eget ex. Vestibulum sapien magna, lacinia vitae iaculis et, feugiat ut urna. Suspendisse odio turpis, laoreet et mauris ullamcorper, maximus tincidunt magna. Sed at lorem nibh. In vestibulum quam eu erat scelerisque vehicula ac sit amet quam. Nam nec purus lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>

    </div>

    <script
        src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script>
    <!-- Mon script-->
    <script type="text/javascript" defer>
        $(document).ready(function(){
           $("#loader").fadeOut(5000);
         });
    </script>
