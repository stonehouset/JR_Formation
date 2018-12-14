
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Accueil Extranet</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {

                background-image: url("/img/image.png");
                background-repeat: no-repeat;
                background-size: cover
                color: #636b6f;
                font-family: 'GothamLight';
                src: url('/fonts/Gotham-Light.eot');
                src: url('/fonts/Gotham-Light.otf') format('opentype'),
                     url('/fonts/Gotham-Light.eot?iefix') format('embedded-opentype'),
                     url('/fonts/Gotham-Light.woff') format('woff'),
                     url('/fonts/Gotham-Light.ttf') format('truetype'),
                     url('/fonts/Gotham-Light.svg#gothamlight') format('svg');  
                width: 100%;
                margin: 0;

            }

            #espace{

                min-height: 150px;
            }

            #espace2{

                min-height: 120px;
            }

            .links > a {

                color: #636b6f;
                padding: 0 25px;
                letter-spacing: .1rem;
                text-decoration: none;
            } 

            #img_logo{

                max-width: 90%;
                border: 2px #E0002D solid;
                box-shadow: 1px 1px 5px black;
                border-radius: 2px;

            }

            #btns{

                max-width: 90%;
                margin-left: auto;
                margin-right: auto;

            }

            #btns_acces_extranet{
               
                text-align: center;
                
            }

            #link_retour{

                margin-top: 90px;
                text-align: center;
            }

            #btn_retour{

                color: white;
                font-size: 22px;
                text-shadow: 2px 2px 4px black;
                padding: 0.5%;
                border: 1px #E0002D solid;
                box-shadow: 1px 1px 5px black;
                border-radius: 2px;
                background-color: #2D3F58;
                text-align: center;
            }

            #btn_acces_accueil,#btn_acces_extranet{

                color: white;
                font-size: 25px;
                text-shadow: 2px 2px 4px black;
                padding: 0.5%;
                border: 1px #E0002D solid;
                box-shadow: 1px 1px 5px black;
                border-radius: 2px;
                background-color: #2D3F58;
                text-align: center;

            }

            #btn_acces_accueil:hover{

                background-color: #4a607f;
            }

            #btn_acces_extranet:hover{

                background-color: #4a607f;
            }

            #btn_retour:hover{

                background-color: #4a607f;
            }

            #footer {

                width: 100%;
                height: 8%;
                position: absolute;
                bottom: 0;
                background-color: #2D3F58;
                border-top: 2px #E0002D solid;
                color: white;
                font-size: 15px;
                text-shadow: 2px 2px 4px black;

            }

            #infos_jrt_formation{

                text-align: center;
            }

            #mail_dev{

                color: #344e72;
                margin-left: 2%;
            }

        </style>
    </head>
    <body>
        <div id="espace">

        </div>
        <center>
            <img src="/img/0001.png" alt="logo_jrt_formation" id="img_logo">
        </center>
        <div id="espace2">

        </div>
        <div id="btns">
            <div id="btns_acces_extranet">     
                @if (Route::has('login'))
                    <div class="links">
                        @auth
                            <a href="{{ url('/home') }}" id="btn_acces_accueil">Accueil Extranet</a>
                        @else
                            <a href="{{ route('login') }}" id="btn_acces_extranet">Accéder à l'Extranet</a>
                            <!-- <a href="{{ route('register') }}">S'enregistrer</a> -->
                        @endauth
                    </div>
                @endif
                 
            </div>
            <div class="links" id="link_retour">
            
                    <a href="http://www.jr-formation.fr" id="btn_retour">Retour site vitrine</a>
             
            </div> 
        </div>
        <div id="footer">
            <h4 id="infos_jrt_formation">
                Usage interne uniquement | JRT Formation Julien RIVET | Tel : 06.62.82.07.68 | Reproduction interdite 

                <a href="mailto:houselstein.thibaud.dev@gmail.com" id="mail_dev">
                    Contact développement web
                </a> 
            </h4>
        </div>
    </body>
</html>
