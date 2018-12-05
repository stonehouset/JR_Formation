
<html lang="{{ app()->getLocale() }}" style="background-color:#2D3F58;">
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

                background-color: #2D3F58;
                color: #636b6f;
                font-family: 'GothamLight';
                src: url('/fonts/Gotham-Light.eot');
                src: url('/fonts/Gotham-Light.otf') format('opentype'),
                     url('/fonts/Gotham-Light.eot?iefix') format('embedded-opentype'),
                     url('/fonts/Gotham-Light.woff') format('woff'),
                     url('/fonts/Gotham-Light.ttf') format('truetype'),
                     url('/fonts/Gotham-Light.svg#gothamlight') format('svg');
                font-weight: 100;
                width: 100%;
                margin: 0;

            }

            .links > a {

                color: #636b6f;
                padding: 0 25px;
                font-size: 15px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            } 

            #img_logo{

                max-width: 70%;
                margin-top:15%;
                border: 2px #E0002D solid;
                box-shadow: 1px 1px 5px black;
                border-radius: 2px;

            }

            #btn_acces_accueil,#btn_acces_extranet{

                color: white;
                font-size: 25px;
                text-shadow: 2px 2px 4px black;
                padding: 0.5%;
                border:1px white solid;
                box-shadow: 1px 1px 5px black;
            }

            #btn_acces_accueil:hover{

                background-color: blue;
            }

             #btn_acces_extranet:hover{

                background-color: #6495ED;
            }

        </style>
    </head>
    <body style="background-color:#2D3F58;">
        <div class="row">
            <div class="offset-lg-2 col-lg-10">
                <center>
                    <img src="/img/0001.png" alt="logo_jrt_formation" id="img_logo">
                </center> 
            </div>
        </div>
        <div class="row" style="margin-top: 8%;">
            @if (Route::has('login'))
                <div class="links" style="text-align: center;">
                    @auth
                        <button class="btn btn-outline"></button><a href="{{ url('/home') }}" id="btn_acces_accueil">ACCUEIL EXTRANET</a>
                    @else
                        <a href="{{ route('login') }}" id="btn_acces_extranet">ACCES EXTRANET</a>
                        <!-- <a href="{{ route('register') }}">S'enregistrer</a> -->
                    @endauth
                </div>
            @endif  
        </div>
    </body>
</html>
