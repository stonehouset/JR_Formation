@extends('layouts.menu')

@section('content')
<div class="card text-center" style="background-color: #2D3F58;">
    <div class="card-body">   
        <button type="button" class="btn btn-outline-dark" id="btn_donnees">Données Générales</button>
        <button type="button" class="btn btn-outline-dark" id="btn_gestion_utilisateur">Utilisateurs</button> 
        <button type="button" class="btn btn-outline-dark" id="btn_gestion_formation">Formations</button> 
        @if (\Session::has('error'))
            <div class="alert alert-error" style="color: red;text-align: center;background-color: #2D3F58;border-color: red;margin-top: 2%;">
                {!! \Session::get('error') !!}   
            </div>
        @endif
        @if (\Session::has('success'))
            <div class="alert alert-success" style="color: green;text-align: center;background-color: #2D3F58;border-color: green;margin-top: 2%; ">
                {!! \Session::get('success') !!}  
            </div>
        @endif        
        <div class="card-text" id="gestion_utilisateurs" style="border: hidden;">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6" id="tableau_gestion_admin_infos_formateurs"> 
                        <div class="card" style="margin-top: 2%;background-color:#2D3F58;border-color: #E0002D;">
                            <div class="card-header" id="header_tableau_apprenants" style="color: white;border-color: #E0002D;">
                                <h5 class="mb-0">
                                    Liste des formateurs
                                </h5>
                            </div>
                            <div id="tab_formateur_admin">
                                <table class="table table-striped table-dark" >
                                    <thead>
                                        <tr> 
                                            <th scope="col">Prénom + Nom</th>                                     
                                            <th scope="col">Email</th>
                                            <th scope="col">Téléphone</th>           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($formateurs as $formateur)
                                        <tr>
                                            <td>{{$formateur->prenom}} {{$formateur->nom}}</td>
                                            <td>{{$formateur->email}}</td>
                                            <td>{{$formateur->numero_telephone}}</td>                                        
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-6" id="tableau_gestion_admin_infos_apprenants">
                        <div class="card" style="margin-top: 2%;background-color:#2D3F58;border-color: #E0002D;">
                            <div class="card-header" id="header_tableau_apprenants" style="color: white;border-color: #E0002D;">
                                <h5 class="mb-0">
                                    Liste des apprenants
                                </h5>
                            </div>
                            <div id="tab_admin_apprenants">   
                                <table class="table table-striped table-dark" >
                                    <thead>
                                        <tr> 
                                            <th scope="col">Prénom + Nom</th>                                     
                                            <th scope="col">Email</th>
                                            <th scope="col">Téléphone</th>                    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($apprenants as $apprenant)
                                        <tr>
                                            <td>{{$apprenant->prenom}} {{$apprenant->nom}}</td>
                                            <td>{{$apprenant->email}}</td>
                                            <td>{{$apprenant->numero_telephone}}</td>                                        
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table> 
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="row" style="margin-top: 0%;"> 
                <div class="col-lg-6" id="btn_telecharger_tab_formateur_admin">    
                    <a  href="{{route('apprenants_formateur_csv')}}" style="color: white;">Extraire tableau formateurs format Excel</a>  
                </div>
                <div class="col-lg-6" id="btn_telecharger_tab_apprenant_admin">   
                    <a  href="{{route('apprenants_admin_csv')}}" style="color: white;">Extraire tableau apprenants format Excel</a>  
                </div>
            </div>
            <div id="accordion" style="margin-top: 2%;">
                <div class="card" style="border-color: #E0002D; color: #2D3F58;">
                    <div class="card-header" id="headingOne" style="border-color: #E0002D; color: #2D3F58;">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Ajouter un Utilisateur
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">                                                       
                            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="prenom" style="color: white;" class="control-label">Rôle</label>    
                                            <input id="role" type="number" class="form-control" name="role" value="" min="1" max="3" required autofocus>   
                                        </div>
                                        <div class="form-group">
                                            <label for="nom" style="color: white;" class="control-label">Nom</label> 
                                            <input id="nom" type="text" class="form-control" name="nom" value="" required autofocus> 
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" style="color: white;" class="control-label">Mot de passe</label> 
                                            <input id="password" type="password" class="form-control" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif  
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="prenom" style="color: white;"class="control-label">N° Téléphone</label>
                                            <input id="numero_telephone" type="tel" class="form-control" name="numero_telephone" value="" required autofocus>                                            
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" style="color: white;" class="control-label">eMail</label>
                                            <input id="email" type="email"
                                             class="form-control" name="email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif  
                                        </div>
                                        <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                                            <label for="prenom" style="color: white;" class="control-label">Prénom</label>
                                            <input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" required autofocus>
                                            
                                        </div>   
                                        <div class="form-group">
                                            <label for="password-confirm" style="color: white;"class="control-label">Confirmer le mot de passe</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>        
                                        <button type="submit" class="btn btn-outline-primary" style="width: 100%;margin-top: 5%;">
                                            Enregistrer
                                        </button> 
                                    </div>
                                </div>
                            </form>
                        </div>                                    
                    </div>                   
                </div>
                <div class="card" style="border-color: #E0002D; color: #2D3F58;">
                    <div class="card-header" id="headingTwo" style="border-color: #E0002D; color: #2D3F58;">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Ajouter une liste d'Apprenants
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <form id="form_register_apprenants" enctype="multipart/form-data" method="POST" action="{{ route('apprenant') }}">
                                {{ csrf_field() }} 
                                <div class="custom-file">                                         
                                    <input type="file" name="fichier_csv_apprenants" class="custom-file-input" id="validatedCustomFile" required>
                                    <label class="custom-file-label" for="file">Importer le fichier excel</label>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <button type="submit" class="btn btn-outline-primary" style="margin-top: 1%;border-color:#E0002D;width: 30%;margin-left: auto;margin-right: auto; ">
                                            Ajouter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>                             
            </div>
        </div>
        <div class="card-text" id="contenu_donnees">
            <div class="panel-body" >
                <div class="row" id="liste_infos_generales_admin">
                    <div class="col-lg-6" style="margin-top: 1%;">
                        <ul class="list-group" >
                            <button type="button" class="list-group-item list-group-item-action active btn btn-outline-dark" id="item_details_users" style="font-size: 18px;background-color:#2D3F58;border-color: #E0002D;">
                                Informations générales
                            </button>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_details_users" style="font-weight: bold;">                  
                                Nombre d'utilisateurs Total
                                <span class="badge badge-primary badge-pill">{{ count($users) }}</span> 
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_details_users">
                                Nombre de stagiaires
                                <span class="badge badge-primary badge-pill">{{ count($apprenants) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_details_users">
                                Nombre de clients
                                <span class="badge badge-primary badge-pill">{{ count($clients) }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_details_users">
                                Nombre de formateurs
                                <span class="badge badge-primary badge-pill">{{ count($formateurs) }}</span>
                            </li>
                        </ul>
                    </div>
                    <br>
                    <div class="col-lg-6" style="border-color: white;margin-top: 1%;">
                        <ul class="list-group">
                            <button type="button" class="list-group-item list-group-item-action active btn btn-outline-dark" id="item_suivi_embauche" style="font-size: 18px;background-color:#2D3F58;border-color: #E0002D;">
                                Suivi des apprenants en entreprise
                            </button>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_suivi_embauche" style="font-weight: bold;">
                                Nombre d'embauchés
                                <span class="badge badge-primary badge-pill">0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_suivi_embauche">
                                Nombres d'embauchés à 2 mois
                                <span class="badge badge-primary badge-pill">0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_suivi_embauche">
                                Nombres d'embauchés à 6 mois
                                <span class="badge badge-primary badge-pill">0</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_suivi_embauche">
                                Non embauchés
                                <span class="badge badge-primary badge-pill">0</span>
                            </li>
                        </ul>
                    </div>
                </div> 
            </div>
        </div>
        <div class="card-text" id="gestion_formation">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <div class="card" style="margin-top: 1%;background-color:#2D3F58;border-color: #E0002D;">
                                <div class="card-header" id="header_tableau_apprenants" style="color: white;border-color: #E0002D;">
                                    <h5 class="mb-0">
                                        Liste des formations 
                                    </h5>
                                </div>
                                <div id="tab_admin_formations">
                                    <table class="table table-striped table-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nom</th>
                                                <th scope="col">Debut</th>
                                                <th scope="col">Fin</th>
                                                <th scope="col">Formateur</th>
                                                <th scope="col">Client</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($formations as $formation)
                                            <tr>
                                                <td>{{$formation->nom}}</td>
                                                <td>{{\Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y')}}</td>
                                                <td>{{\Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y')}}</td>
                                                <td>{{$formation->formateur->prenom}} {{$formation->formateur->nom}}</td>  
                                                <td>{{$formation->client->prenom}} {{$formation->client->nom}}</td>           
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                                  
                        <div id="accordion">
                            <div class="card" style="border-color: #E0002D; color: #2D3F58;">
                                <div class="card-header" id="headingFive" style="border-color: #E0002D; color: #2D3F58;">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Ajouter un groupe de Formation
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                    <form  method="POST" action="{{ route('formation') }}">
                                            {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Nom Formation</span>
                                                        </div>
                                                        <select class="custom-select" id="inputGroupSelect01" name="nom_formation">
                                                            <option selected>Aucun sélectionné</option>

                                                            @foreach($groupes_formation as $groupe_formation)

                                                            <option selected value="{{$groupe_formation->groupe_formation}}">{{$groupe_formation->groupe_formation}}</option>

                                                            @endforeach    

                                                        </select>
                                                    </div> 
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Date début formation</span>
                                                        </div>
                                                        <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_debut_formation" aria-describedby="basic-addon2" name="debut_formation">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Date fin formation</span>
                                                        </div>
                                                        <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_fin_formation" aria-describedby="basic-addon2" name="fin_formation">
                                                    </div>                                                
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Client</span>
                                                        </div>
                                                        <select class="custom-select" id="inputGroupSelect01" name="nom_client">
                                                            <option selected>Aucun sélectionné</option>
                                                            @foreach($clients as $client)

                                                            <option selected value="{{$client->id}}">{{$client->prenom}} {{$client->nom}}</option>

                                                            @endforeach    
                                                        </select>
                                                    </div> 
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Formateur</span>
                                                        </div>
                                                        <select class="custom-select" id="inputGroupSelect01" name="nom_formateur">
                                                            <option selected>Aucun sélectionné</option>
                                                            @foreach($formateurs as $formateur)

                                                            <option selected value="{{$formateur->id}}">{{$formateur->prenom}} {{$formateur->nom}}</option>

                                                            @endforeach    
                                                        </select>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <button type="submit" class="btn btn-outline-primary" id="btn_ajout_confirm_apprenant">Ajouter</button>   
                                                    </div>                                                 
                                                </div>
                                            </div>                             
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                               
            </div>
        </div>
    </div>
</div>
@endsection
