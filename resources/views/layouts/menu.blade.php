<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->  
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
<body style="background-color: #2D3F58;">
    <nav class="navbar navbar-expand-lg navbar navbar-lg navbar-light bg-light">
        <a class="navbar-brand">
            <img src="/img/0001.jpg" class="css-class" alt="alt text" style="max-width:180px;max-height:120px;box-shadow: 1px 1px 5px #2D3F58;"> 
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
                <li class="nav-item active" >
                    <a class="nav-link" href="/profil" id="text_nav_link">Profil <span class="sr-only">(current)</span></a>
                </li>
                @if(Auth::user()->role === 1) 
                <li class="nav-item active" >
                    <a class="nav-link" href="/questionnaire_formation" id="text_nav_link">Questionnaire<span class="sr-only">(current)</span></a>
                </li>
                @endif
            </ul>    
            <span id="date_jour" style="color:#2D3F58;">{{ date('d/m/Y') }}</span>
                
                <span id="initials_user">
                {{substr(Auth::user()->prenom, 0, 1)}}{{substr(Auth::user()->nom, 0, 1)}} 
                </span>
                
                @guest
                    <li><a href="{{ route('login') }}" style="margin-left: 1%;">Connexion</a></li>
                @else
                    <a href="{{ route('logout') }}" class="btn btn-outline-primary" id="btn_deconnexion" role="button" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        DECONNEXION
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                        {{ csrf_field() }}
                    </form>
                </div>
           
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