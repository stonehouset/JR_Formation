@extends('layouts.menu_accueil')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="width: 50%;display:block;text-align:center;margin:auto;color: white;margin-top: 5%;font-size: 25px;border-bottom:2px #E0002D solid;padding-bottom: 1%;">Réinitialiser le mot de passe</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <h4 for="email" style="text-align:center;color: white;margin-top: 5%;font-size: 20px;">Addresse email</h4>

                                <input id="email" type="email" class="form-control" name="email" style="margin-left:auto;margin-right:auto;width: 50%;margin-top: 2%;" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>
                        <button type="submit" class="btn btn-outline-primary" style="width: 30%;display: block;margin : auto;margin-top: 5%;">
                            Envoyer le lien de réinitialisation 
                        </button>
                    </form>                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
