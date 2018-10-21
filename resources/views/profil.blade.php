@extends('layouts.menu')

@section('content')
<div class="container">
    <h3 id="titre_profil" style="color: white;width: 100%;">
        Mon Profil 
    </h3>
	<div class="row" id="row_profil">
        <div class="col-lg-6">  
            <ul class="list-group">
            	<li class="list-group-item" style="height: 10%;border-color: #E0002D;"><strong id="role">Statut</strong> : {{$statut}}</li>
            	<li class="list-group-item" style="height: 10%;border-color: #E0002D;"><strong id="prenom">Prénom</strong> : {{Auth::user()->prenom}}</li>
            	<li class="list-group-item" style="height: 10%;border-color: #E0002D;"><strong id="nom">Nom</strong> : {{Auth::user()->nom}}</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-group">
            	<li class="list-group-item" style="height: 10%;border-color: #E0002D;"><strong>Adresse eMail</strong> : {{Auth::user()->email}}</li>
            	<li class="list-group-item" style="height: 10%;border-color: #E0002D;"><strong>Numéro de téléphone</strong> : {{Auth::user()->numero_telephone}}</li>
            	<li class="list-group-item" style="height: 10%;border-color: #E0002D;"><strong>Créé le</strong> : {{\Carbon\Carbon::parse(Auth::user()->created_at)->format('d/m/Y')}}</li>
            </ul>
        </div>
    </div>
    @if(Auth::user()->role == 0)
        <div class="row" id="row_profil">
            <div class="col-lg-6">  
                <ul class="list-group">
                    <li class="list-group-item" style="height: 10%;border-color: #E0002D;"><strong>ID Pôle Emploi</strong> : {{$apprenant->id_pole_emploi}}</li>
                    <li class="list-group-item" style="height: 10%;border-color: #E0002D;"><strong>Date de naissance</strong> : {{\Carbon\Carbon::parse($apprenant->date_naissance)->format('d/m/Y')}}</li>
                    <li class="list-group-item" style="height: 10%;border-color: #E0002D;"><strong>Lieu de naissance</strong> : {{$apprenant->lieu_naissance}}</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <ul class="list-group">
                    <li class="list-group-item" style="height: 10%;border-color: #E0002D;"><strong>Formation</strong> : {{$apprenant->groupe_formation}}</li>
                    <li class="list-group-item" style="height: 10%;border-color: #E0002D;"><strong>Date début de formation</strong> : {{\Carbon\Carbon::parse($apprenant->debut_tutorat)->format('d/m/Y')}}</li>
                    <li class="list-group-item" style="height: 10%;border-color: #E0002D;"><strong>Date fin de formation</strong> : {{\Carbon\Carbon::parse($apprenant->fin_tutorat)->format('d/m/Y')}}</li>
                </ul>
            </div>
        </div>
    @endif
</div>

@endsection


