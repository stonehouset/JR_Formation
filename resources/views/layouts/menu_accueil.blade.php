<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>JRT_Formation Extranet</title>
        <!-- Styles -->  
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body style="background-color: #2D3F58;">
        <nav class="navbar navbar-expand-lg navbar navbar-lg navbar-light bg-light" style="box-shadow: 1px 1px 5px #E0002D;">
            <a class="navbar-brand" href="/">
                <img src="/img/0001.png" class="css-class" alt="alt text" style="max-width:210px;max-height:150px;box-shadow: 1px 1px 5px #2D3F58;">
            </a>
            <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <!-- <li class="nav-item active" >
                <a class="nav-link" href="/register" style="color:#2D3F58;">S'enregistrer<span class="sr-only"></span></a>
            </li> -->
        </nav>  
        @yield('content')
        <!-- Scripts -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>