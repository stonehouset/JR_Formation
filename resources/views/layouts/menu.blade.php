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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body style="background-color: #2D3F58;">
    <nav class="navbar navbar-expand-lg navbar navbar-lg navbar-light bg-light">
        <a class="navbar-brand">
            <img src="/img/0001.jpg" class="css-class" alt="alt text" style="max-width:180px;max-height:120px;"> 
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @if(Auth::user()->role === 3)
                <li class="nav-item active" >
                    <a class="nav-link" href="/home" style="color:#2D3F58;">Gestion<span class="sr-only">(current)</span></a>
                </li>
                @endif
                @if(Auth::user()->role === 0 || Auth::user()->role === 3)
                <li class="nav-item active" >
                    <a class="nav-link" href="/interface_apprenant" style="color:#2D3F58;">Apprenant <span class="sr-only">(current)</span></a>
                </li>
                @endif
                @if(Auth::user()->role === 1 || Auth::user()->role === 3)
                <li class="nav-item active" >
                    <a class="nav-link" href="/interface_formateur" style="color:#2D3F58;">Formateur <span class="sr-only">(current)</span></a>
                </li>
                @endif
                @if(Auth::user()->role === 2 || Auth::user()->role === 3) 
                <li class="nav-item active" >
                    <a class="nav-link" href="/interface_client" style="color:#2D3F58;">Client <span class="sr-only">(current)</span></a>
                </li>
                @endif
                <li class="nav-item active" >
                    <a class="nav-link" href="/profil" style="color:#2D3F58;">Profil <span class="sr-only">(current)</span></a>
                </li>
                @if(Auth::user()->role === 1 || Auth::user()->role === 3) 
                <li class="nav-item active" >
                    <a class="nav-link" href="/questionnaire_formation" style="color:#2D3F58;">Questionnaire<span class="sr-only">(current)</span></a>
                </li>
                @endif
            </ul>    
            <span id="date_jour" style="color:#2D3F58;">{{ date('d/m/Y') }}</span>
                
                <span id="initials_user" style="color:black;">
                {{substr(Auth::user()->prenom, 0, 1)}}{{substr(Auth::user()->nom, 0, 1)}} 
                </span>
                
                @guest
                    <li><a href="{{ route('login') }}" style="margin-left: 1%;">Connexion</a></li>
                @else
                    <a href="{{ route('logout') }}" style="margin-left: 1%;color:#E0002D;" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Déconnexion
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>