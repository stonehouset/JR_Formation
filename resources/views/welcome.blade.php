<!doctype html>
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

        </style>
    </head>
    <body style="background-color:#2D3F58;text-align: center;">
        <center>
            <img src="/img/0001.jpg" alt="alt text" style="max-width: 60%;height: auto;margin-top:10%;border: 2px #E0002D solid;box-shadow: 1px 1px 5px black;">
        </center> 
        <div class="row" style="margin-top: 8%;">
            @if (Route::has('login'))
                <div class="links" style="text-align: center;">
                    @auth
                        <a href="{{ url('/home') }}" style="color: white;font-size: 25px;text-shadow: 2px 2px 4px black;padding: 0.5%;">ACCUEIL EXTRANET</a>
                    @else
                        <a href="{{ route('login') }}" style="color: white;font-size: 25px;text-shadow: 2px 2px 4px black;padding: 0.5%;">ACCES EXTRANET</a>
                        <!-- <a href="{{ route('register') }}">S'enregistrer</a> -->
                    @endauth
                </div>
            @endif  
        </div>
    </body>
</html>
