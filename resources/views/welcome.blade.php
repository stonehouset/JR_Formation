<!doctype html>
<html lang="{{ app()->getLocale() }}" style="background-color:#f8f9fa;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>JR Formation</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #2D3F58;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
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
                border: 1px #E0002D solid;
            } 
        </style>
    </head>
    <body style="background-color:#f8f9fa;">
        <center>
            <img src="/img/logo_formation_accueil.png" alt="alt text" style="width:80%;margin-top: 5%;border-bottom: 2px #E0002D solid;padding-bottom: 1%; ">
        </center> 
        <h3 style="color: #2D3F58;text-align: center;font-size: 40px;">Extranet</h3>
        <div class="row">
            @if (Route::has('login'))
                <div class="links" style="text-align: center;">
                    @auth
                        <a href="{{ url('/home') }}">Accueil</a>
                    @else
                        <a href="{{ route('login') }}" style="color: #E0002D;font-size: 22px;">Connexion</a>
                        <!-- <a href="{{ route('register') }}">S'enregistrer</a> -->
                    @endauth
                </div>
            @endif  
        </div>
    </body>
</html>
