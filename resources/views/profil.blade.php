@extends('layouts.menu')

@section('content')
<div class="container">
    <h3 id="titre_profil">
        Profil
    </h3>
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
	<div class="row" id="row_profil">
        <div class="col-lg-6">  
            <ul class="list-group">
            	<li class="list-group-item" id="item_list_profil"><strong id="role_data">Statut</strong> : {{$statut}}</li>
            	<li class="list-group-item" id="item_list_profil"><strong id="prenom_data">Prénom</strong> : {{Auth::user()->prenom}}</li>
            	<li class="list-group-item" id="item_list_profil"><strong id="nom_data">Nom</strong> : {{Auth::user()->nom}}</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-group">
            	<li class="list-group-item" id="item_list_profil"><strong>@</strong> : {{Auth::user()->email}}</li>
                @if(Auth::user()->role == 0)
            	<li class="list-group-item" id="item_list_profil"><strong>Téléphone</strong> : {{Auth::user()->numero_telephone}}</li>
                @else
                <li class="list-group-item" id="item_list_profil"><strong>Téléphone</strong> : {{Auth::user()->numero_telephone}}</li>
                @endif
            	<li class="list-group-item" id="item_list_profil"><strong>Créé le</strong> : {{\Carbon\Carbon::parse(Auth::user()->created_at)->format('d/m/Y')}}</li>
            </ul>
        </div>
    </div>
    @if(Auth::user()->role == 0)
        <div class="row" id="row_profilApp">
            <div class="col-lg-6">  
                <ul class="list-group">
                    <li class="list-group-item" id="item_list_profil"><strong>ID Pôle Emploi</strong> : {{$apprenant->id_pole_emploi}}</li>
                    <li class="list-group-item" id="item_list_profil"><strong>Date de naissance</strong> : {{\Carbon\Carbon::parse($apprenant->date_naissance)->format('d/m/Y')}}</li>
                    <li class="list-group-item" id="item_list_profil"><strong>Lieu de naissance</strong> : {{$apprenant->lieu_naissance}}</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="list-group">
                    <li class="list-group-item" id="item_list_profil"><strong>Formation</strong> : {{$apprenant->groupe_formation}}</li>
                    <li class="list-group-item" id="item_list_profil"><strong>Début Formation</strong> : {{\Carbon\Carbon::parse($apprenant->date_debut)->format('d/m/Y')}}</li>
                    <li class="list-group-item" id="item_list_profil"><strong>Fin Formation</strong> : {{\Carbon\Carbon::parse($apprenant->date_fin)->format('d/m/Y')}}</li>
                </ul>
            </div>
        </div>
    @endif
    <div class="row" id="row_profil_mdp">
        <div class="offset-lg-4 col-lg-4">
            <div id="div_modif_password">
                <h4 id="titre_modif_mdp">Modifier votre mot de passe</h4>
                <h5 id="sous_titre_modif_mdp">(6 caractères minimum)</h5>
                <form class="form-horizontal" method="POST" action="{{ route('change_user_password') }}" id="form_change_mdp">
                {{ csrf_field() }}
                    <input type="password" class="form-control" name="motdepasse" placeholder="Nouveau mot de passe" id="input_profil_mdp">
                    <input type="password" class="form-control" name="confirmPassword" placeholder="Confirmer le nouveau mot de passe" id="input_profil_confirm_mdp">
                    <button type="submit" class="btn btn-outline-primary" id="btn_submit_change_mdp">
                        <div id="label_btn_submit_change_mdp">
                            Valider
                        </div>
                        <div class="loader"></div>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


