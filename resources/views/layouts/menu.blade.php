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
                <img src="/img/0001.png" class="css-class" alt="alt text" id="img_menu"> 
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    @if(Auth::user()->role === 3)
                    <li class="nav-item active" >
                        <a class="nav-link" href="/home" id="text_nav_link">Gestion<span class="sr-only">(current)</span></a>
                    </li>
                    @endif
                    @if(Auth::user()->role === 3)
                    <li class="nav-item active" >
                        <a class="nav-link" href="/commentaires" id="text_nav_link">Commentaires<span class="sr-only">(current)</span></a>
                    </li>
                    @endif
                    @if(Auth::user()->role === 0)
                    <li class="nav-item active" >
                        <a class="nav-link" href="/interface_apprenant" id="text_nav_link">Apprenant <span class="sr-only">(current)</span></a>
                    </li>
                    @endif
                    @if(Auth::user()->role === 1)
                    <li class="nav-item active" >
                        <a class="nav-link" href="/interface_formateur" id="text_nav_link">Formateur <span class="sr-only">(current)</span></a>
                    </li>
                    @endif
                    @if(Auth::user()->role === 2) 
                    <li class="nav-item active" >
                        <a class="nav-link" href="/interface_client" id="text_nav_link">Client <span class="sr-only">(current)</span></a>
                    </li>
                    @endif
                    @if(Auth::user()->role === 1) 
                    <li class="nav-item active" >
                        <a class="nav-link" href="/questionnaire_formation" id="text_nav_link">Compte Rendu<span class="sr-only">(current)</span></a>
                    </li>
                    @endif
                    <li class="nav-item active" >
                        <a class="nav-link" href="/profil" id="text_nav_link">Profil <span class="sr-only">(current)</span></a>
                    </li>
                </ul>        
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
            </div>
        </nav>  
        @yield('content')
        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>