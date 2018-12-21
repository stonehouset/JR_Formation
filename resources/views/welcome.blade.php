
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
                height: 100%;
                margin: 0;
                
            }

            html{

                
                position: relative;
            }

            #espace{

                min-height: 5%;
                height: 12%;
                
            }

            #espace2{

              
                min-height: 5%;
                height: 10%;
              
                
            }

            .links > a {

                color: #636b6f;
                padding: 0 25px;
                letter-spacing: .1rem;
                text-decoration: none;
            } 

            #img_logo{

                max-width: 90%;
                border: 1px #E0002D solid;
                box-shadow: 1px 1px 5px black;
                border-radius: 1px;

            }

            #infos_jrt_formation{

                width: 780px;
                max-width: 90%;
                max-height: 400px;
                padding: 0.5%;
                margin-left: auto;
                margin-right: auto;
                color: white;
                font-size: 18px;
                text-align: center;
                border: 1px #E0002D solid;
                box-shadow: 1px 1px 5px black;
                border-radius: 1px;

            }

            #lien_ici{

                color: black;
            }

            #bienvenue_1{

                font-size: 20px;
            }

            #btns{

                max-width: 100%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;

            }

            #btns_acces_extranet{
               
                text-align: center;
                
            }

            #link_retour{

                width: 100%;
                margin-top: 8%;
                margin-bottom: 8px;
                color: white;
            }

            #btn_retour{

                color: white;
                font-size: 18px;
                text-shadow: 2px 2px 4px black;
                
            }

            #lien_ousuisje{

                margin-left: auto;
                margin-right: auto;
                color: white;
                font-size: 18px;
                text-shadow: 2px 2px 4px black;
            }

            #btn_acces_accueil,#btn_acces_extranet{

                color: white;
                font-size: 26px;
                /*text-shadow: 2px 2px 4px black;*/
                padding: 0.5%;
                border: 1px #E0002D solid;
                box-shadow: 1px 1px 5px black;
                border-radius: 1px;
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

            #lien_ousuisje:hover{

                background-color: #4a607f;
            }

            #footer {

                margin-top: 1%;
                width: 100%;
                max-height: 100px;
                bottom: 0; 
                position: absolute;
                padding-top: 1px;
                background-color: #2D3F58;
                border-top: 1px #E0002D solid;
                box-shadow: 1px 1px 5px black;
                color: white;
                font-size: 15px;
                text-decoration: none;
            }

            #contact_jrt_formation{

                text-align: center;
                padding: 0.5%;
            }


        </style>
    </head>
    <body>
        <div id="espace">
        </div>
        <center id="logo_accueil">
            <img src="/img/0001.png" alt="logo_jrt_formation" id="img_logo">
        </center>
        <center>
            <div id="infos_jrt_formation">
                <div id="text_infos_jrt_formation">
                    <p id="bienvenue_1">Bienvenue sur la page d'accueil de notre extranet.</p>
                    <p>Cet espace est réservé aux apprenants, formateurs et clients participants à une de nos sessions de formation.</p>
                    <p>Pour plus de renseignements sur notre organisme, cliquez <a id="lien_ici" href="http://www.jr-formation.fr"> ici</a >.</p> 
                </div>
            </div>
        </center>
        <div id="espace2">
        </div>
        <div id="btns">
            <div id="btns_acces_extranet">     
                @if (Route::has('login'))
                    <div class="links">
                        @auth
                            <a href="{{ url('/home') }}" id="btn_acces_accueil">Retour Extranet</a>
                        @else
                            <a href="{{ route('login') }}" id="btn_acces_extranet">Accéder à l'Extranet</a>
                            <!-- <a href="{{ route('register') }}">S'enregistrer</a> -->
                        @endauth
                    </div>
                @endif   
            </div>
            <div class="links" id="link_retour"> 
                <a href="http://www.jr-formation.fr" id="btn_retour">Retour jr-formation.fr</a>      
            </div> 
            <a id="lien_ousuisje">Où suis-je ?</a> 
        </div>
        <div id="footer">
            <h4 id="contact_jrt_formation">
                Usage interne uniquement | JRT Formation Julien RIVET | Tel : 06.62.82.07.08 | Reproduction interdite 
            </h4>
        </div>
        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>
