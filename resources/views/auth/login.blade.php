@extends('layouts.menu_accueil')

@section('content')
<body>
    <div class="container">
        <div class="row">
            <div class="offset-lg-3 col-lg-6 col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body" id="formulaire_page_connexion">
                        <h3 id="titre_page_connexion">Identification</h3>      
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}" id="form_login">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="control-label" id="label_email_form_connexion">Email</label>
                                <div class="offset-lg-1 col-lg-10">
                                    <input id="email" type="email" class="form-control" name="email" placeholder="jrtformation@formation.com" value="{{ old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong id="erreur_login">Email ou Mot de passe incorrect.</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="control-label" id="label_mdp_form_connexion">Mot de passe <button disabled id="info_mdp_login" onclick="infos();">? </button></label>
                                <div class="offset-lg-1 col-lg-10">
                                    <input id="password" type="password" class="form-control" placeholder="Mot de passe" name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>Mot de passe Incorrect</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="offset-lg-1 col-lg-10">
                                    <div class="checkbox">
                                        <label id="input_checkbox_form_connexion">
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>  Se souvenir de moi
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="form_validation_form_connexion">
                                <div class="offset-lg-1 col-lg-10">  
                                    <button type="submit" class="btn btn-outline-primary" id="btn_submit_login">
                                        <div id="label_btn_login">
                                            Connexion
                                        </div>
                                        <div class="loader"></div>
                                    </button> 
                                </div> 
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection