@extends('layouts.menu_accueil')

@section('content')
<div class="container" style="background-color: #2D3F58;">
    <div class="row">
        <div class="offset-lg-3 col-lg-6 col-md-12">
            <div class="panel panel-default" style="margin-top: 3%;">
                <div class="panel-heading" style="color: white;font-size: 25px;text-align: center;">Connexion</div>

                <div class="panel-body" style="width: 80%;margin-left: auto;margin-right: auto;">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}" style="margin-top: 5%;">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label" style="color: white;">Adresse eMail</label>
                            <div class="">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus style="border-color: #E0002D;">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label" style="color: white;">Mot de passe</label>
                            <div class="">
                                <input id="password" type="password" class="form-control" name="password" required style="border-color: #E0002D;">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                                <div class="checkbox">
                                    <label style="color: white;">
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} > Se souvenir de moi
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" style="text-align: center;">
                            <div class="">
                                <button type="submit" class="btn btn-outline-primary" style="border-color: #E0002D;">
                                    Se connecter
                                </button>
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="color: white;">
                                    Mot de passe oublié?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
