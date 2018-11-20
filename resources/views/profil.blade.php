@extends('layouts.menu')

@section('content')
@if (\Session::has('error'))
            <div class="alert alert-error" id="div_show_error">
                
                {!! \Session::get('error') !!}</li>
                
            </div>
        @endif
        @if (\Session::has('success'))
        <div class="alert alert-success" id="div_show_success">
            
            {!! \Session::get('success') !!}</li>
            
        </div>
        @endif
<div class="container">
    <h3 id="titre_profil" style="color: white;width: 100%;border-bottom:2px #E0002D solid;padding-bottom: 2%;">
        MES DONNEES
    </h3>
	<div class="row" id="row_profil">
        <div class="col-lg-6">  
            <ul class="list-group">
            	<li class="list-group-item"><strong id="role">Statut</strong> : {{$statut}}</li>
            	<li class="list-group-item"><strong id="prenom">Prénom</strong> : {{Auth::user()->prenom}}</li>
            	<li class="list-group-item"><strong id="nom">Nom</strong> : {{Auth::user()->nom}}</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-group">
            	<li class="list-group-item"><strong>Adresse eMail</strong> : {{Auth::user()->email}}</li>
            	<li class="list-group-item"><strong>Numéro de téléphone</strong> : {{Auth::user()->numero_telephone}}</li>
            	<li class="list-group-item"><strong>Créé le</strong> : {{\Carbon\Carbon::parse(Auth::user()->created_at)->format('d/m/Y')}}</li>
            </ul>
        </div>
    </div>
    @if(Auth::user()->role == 0)
        <div class="row" id="row_profil">
            <div class="col-lg-6">  
                <ul class="list-group">
                    <li class="list-group-item"><strong>ID Pôle Emploi</strong> : {{$apprenant->id_pole_emploi}}</li>
                    <li class="list-group-item"><strong>Date de naissance</strong> : {{\Carbon\Carbon::parse($apprenant->date_naissance)->format('d/m/Y')}}</li>
                    <li class="list-group-item"><strong>Lieu de naissance</strong> : {{$apprenant->lieu_naissance}}</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Formation</strong> : {{$apprenant->groupe_formation}}</li>
                    <li class="list-group-item"><strong>Date début de formation</strong> : {{\Carbon\Carbon::parse($apprenant->debut_tutorat)->format('d/m/Y')}}</li>
                    <li class="list-group-item"><strong>Date fin de formation</strong> : {{\Carbon\Carbon::parse($apprenant->fin_tutorat)->format('d/m/Y')}}</li>
                </ul>
            </div>
        </div>
    @endif
    <div id="div_modif_password" style="width: 40%;margin-right: auto;margin-left: auto;margin-top: 5%;">
        <h4 style="text-align: center;color: white;border-bottom:2px #E0002D solid;padding-bottom: 3%;">Modifier votre mot de passe</h4>
        <form class="form-horizontal" method="POST" action="{{ route('change_user_password') }}">
        {{ csrf_field() }}
            <input type="password" class="form-control" name="motdepasse" placeholder="Nouveau mot de passe" style="height: 45px;margin-top: 5%;">
            <input type="password" class="form-control" name="confirmPassword" placeholder="Confirmer le nouveau mot de passe" style="margin-top: 5%;height: 45px;">
            <button type="submit" class="btn btn-outline-primary" style="margin-top: 5%;width: 50%;display: block;margin-right:auto;margin-left: auto;">Valider</button>
        </form>
    </div>
</div>

@endsection


