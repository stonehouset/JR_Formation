<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>JRT_Formation Extranet</title>

        <!-- Styles -->  
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar navbar-lg navbar-light bg-light" style="box-shadow: 1px 1px 5px #E0002D;">
            <a class="navbar-brand" href="/">
                <img src="/img/0001.png" class="css-class" alt="logo_jrt-formation" id="img_menu"> 
            </a>
              
            @guest
                <li><a href="{{ route('login') }}" id="lien_connexion_deco">Connexion</a></li>
            @else
                <a href="{{ route('logout') }}" class="btn btn-outline-primary" id="btn_deconnexion" role="button" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    {{Auth::user()->prenom}} {{substr(Auth::user()->nom, 0, 1)}} | DECONNEXION
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                    {{ csrf_field() }}
                </form>     
            @endguest
            
        </nav>  
        @yield('content')
        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>