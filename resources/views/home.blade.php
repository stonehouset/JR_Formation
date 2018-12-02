@extends('layouts.menu')

@section('content')

<div class="card text-center" id="card_principale_home">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <button type="button" class="btn btn-outline-dark" id="btn_donnees">DONNEES GENERALES</button>      
            </div>
            <div class="col-lg-4">
                <button type="button" class="btn btn-outline-dark" id="btn_gestion_utilisateur">UTILISATEURS</button> 
            </div>
            <div class="col-lg-4">
                <button type="button" class="btn btn-outline-dark" id="btn_gestion_formation">FORMATIONS</button> 
            </div>
        </div>   
        @if (\Session::has('error'))
            <div class="alert alert-error" id="div_show_error">
                {!! \Session::get('error') !!}   
            </div>
        @endif
        @if (\Session::has('success'))
            <div class="alert alert-success" id="div_show_success">
                {!! \Session::get('success') !!}  
            </div>
        @endif        
        <div class="card-text" id="gestion_utilisateurs">  
            <div class="row">
                <div class="col-lg-8" id="tableau_gestion_admin_infos_apprenants">
                    <div class="card-header" id="header_tableau_apprenants">
                        APPRENANTS       
                        <a  href="{{route('apprenants_admin_csv')}}">extraire</a>                
                    </div>
                    <div id="tab_admin_apprenants">   
                        <table class="table table-striped table-dark" >
                            <thead>
                                <tr> 
                                    <th scope="col">Prénom + Nom</th>  
                                    <th scope="col">Groupe formation</th>                                    
                                    <th scope="col">Email</th>
                                    <th scope="col">Téléphone</th>                                       
                                    <th scope="col">Commentaire Semaine 1</th>
                                    <th scope="col">Commentaire Semaine 2</th>
                                    <th scope="col">Note formation</th>                
                                </tr>
                            </thead>
                            <tbody>
                                @if ($apprenants != null)
                                    @foreach($apprenants as $apprenant)
                                    <tr>
                                        <td>{{$apprenant->prenom}} {{$apprenant->nom}}</td>
                                        <td>{{$apprenant->groupe_formation}}</td>
                                        <td>{{$apprenant->email}}</td>
                                        <td>{{$apprenant->numero_telephone}}</td>                                   
                                        <td>{{$apprenant->commentaire_semaine1}}</td>
                                        <td>{{$apprenant->commentaire_semaine2}}</td>
                                        <td>{{$apprenant->note_formation}}</td>                                         
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table> 
                    </div>
                </div>
                <div class="col-lg-4" id="tableau_gestion_admin_infos_formateurs">                   
                    <div class="card-header" id="header_tableau_apprenants">                      
                        FORMATEURS 
                        <a  href="{{route('apprenants_formateur_csv')}}" >extraire</a>                      
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
                            @if ($formateurs != null)
                                @foreach($formateurs as $formateur)
                                <tr>
                                    <td>{{$formateur->prenom}} {{$formateur->nom}}</td>
                                    <td>{{$formateur->email}}</td>
                                    <td>{{$formateur->numero_telephone}}</td>                                        
                                </tr> 
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div> 
                </div>  
            </div>          
            <div id="accordion" class="accordion_users">
                <div class="card" id="card_ajout_user">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                + UTILISATEUR
                            </button>
                        </h5>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">                                                       
                            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                                <div class="row">
                                    <div class="offset-lg-3 col-lg-6">
                                        <div class="form-group">
                                            <label for="prenom" id="label_form_user_admin" style="" class="control-label">Rôle</label>    
                                            <select class="custom-select" id="role" class="form-control" name="role">
                                                <option disabled selected>Type d'utilisateur</option>
                                                <option value="3" >Admin</option>
                                                <option value="2" >Client</option>
                                                <option value="1" >Formateur</option>                
                                            </select>   
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="nom" id="label_form_user_admin" class="control-label">Nom</label> 
                                            <input id="nom" type="text" class="form-control" name="nom" value="" required autofocus> 
                                        </div>
                                        <div class="form-group">
                                            <label for="prenom" id="label_form_user_admin" class="control-label">N° Téléphone</label>
                                            <input id="numero_telephone" type="tel" class="form-control" name="numero_telephone" value="" required autofocus>                                            
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" id="label_form_user_admin" class="control-label">Mot de passe</label> 
                                            <input id="password" type="password" class="form-control" name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif  
                                        </div>      
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
                                            <label for="prenom" id="label_form_user_admin" class="control-label">Prénom</label>
                                            <input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" required autofocus>
                                            
                                        </div>                                       
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" id="label_form_user_admin" class="control-label">eMail</label>
                                            <input id="email" type="email"
                                             class="form-control" name="email" value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif  
                                        </div>
                                        <div class="form-group">
                                            <label for="password-confirm" id="label_form_user_admin" class="control-label">Confirmer le mot de passe</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>                                                  
                                    </div>
                                    <div class="offset-lg-3 col-lg-6">
                                        <button type="submit" id="btn_ajout_user_admin" class="btn btn-outline-primary">
                                            Enregistrer
                                        </button> 
                                    </div>
                                </div>
                            </form>
                        </div>                                    
                    </div>                   
                </div>
                <div class="card" id="card_ajout_apprenant">
                    <div class="card-header" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            + LISTE D'APPRENANTS
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">                           
                            <div class="row"> 
                                <div class="offset-lg-3 col-lg-6">
                                    <form class="form-horizontal" method="GET" action="{{ route('get_csv_apprenant') }}" id="form_get_excel_apprent">
                                        {{ csrf_field() }}
                                        <br>
                                        <button type="submit" id="btn_get_excel_apprenant" class="btn btn-outline-primary">
                                            &#8593; Récupérer le fichier d'ajout
                                        </button>
                                    </form>    
                                    <form id="form_register_apprenants" enctype="multipart/form-data" method="POST" action="{{ route('apprenant') }}">
                                        {{ csrf_field() }}
                                        <div class="custom-file">                                         
                                            <input type="file" name="fichier_csv_apprenants" class="custom-file-input" id="validatedCustomFile" required>
                                            <label class="custom-file-label" for="file"> &#8595; Importer le fichier complété</label>
                                        </div>                                                                                           
                                        <button type="submit" id="btn_ajout_liste_apprenants" class="btn btn-outline-primary">
                                            Ajouter
                                        </button>
                                    </form>
                                </div>
                            </div>                      
                        </div>
                    </div>
                </div>
                <div class="card" id="card_suppr_user">
                    <div class="card-header" id="headingSix">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" id="btn_suppr_user_haut" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            SUPPRIMER UN UTILISATEUR
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                        <div class="card-body">
                            <form id="form_register_apprenants" enctype="multipart/form-data" method="POST" action="{{ route('delete_user')}}">
                                {{ csrf_field() }} 
                                <div class="row" id="div_suppr_user">
                                    <div class="offset-lg-4 col-lg-4">
                                        <div class="form-group">           
                                            <select class="custom-select" required="" id="user_a_suppr" class="form-control" name="suppr_user">
                                                <option selected disabled="true">Sélectionner un utilisateur à supprimer</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->id}}" >{{$user->prenom}} {{$user->nom}}</option>
                                                @endforeach             
                                            </select>   
                                        </div>
                                        <button type="submit" id="btn_suppr_user_admin" class="btn btn-outline-primary">
                                            SUPPRIMER (cette action est irréversible)
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
                            <button type="button" class="list-group-item list-group-item-action active btn btn-outline-dark" id="header_item_utilisateur">
                                INFORMATIONS GENERALES
                            </button>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_details_users" style="font-weight: bold;">                  
                                Nombre d'utilisateurs total
                                <span class="badge badge-primary badge-pill">{{ count($users) }}</span> 
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_details_users">
                                Nombre d'apprenants
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
                            <button type="button" class="list-group-item list-group-item-action active btn btn-outline-dark" id="header_item_utilisateur">
                                SUIVI DES APPRENANTS
                            </button>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_suivi_embauche" style="font-weight: bold;">
                                Nombre d'embauchés total
                                <span class="badge badge-primary badge-pill">{{$nbEmbauchesTotal}} | {{$pourcentageEmbauchesTotal}} %</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_suivi_embauche">
                                Nombres d'embauchés à 2 mois
                                <span class="badge badge-primary badge-pill">{{$nbEmbauches2moisTotal}} | {{$pourcentageEmbauches2MoisTotal}} %</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_suivi_embauche">
                                Nombres d'embauchés à 6 mois
                                <span class="badge badge-primary badge-pill">{{$nbEmbauches6moisTotal}} | {{$pourcentageEmbauches6MoisTotal}} %</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center" id="item_suivi_embauche">
                                Non embauchés
                                <span class="badge badge-primary badge-pill">{{$pourcentageNonEmbauches}}</span>
                            </li>
                        </ul>
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="margin-top: 1%;background-color:#2D3F58;border:hidden;border: 1px white solid;">
                        <div class="card-header" id="header_tableau_apprenants" style="border-color: #E0002D;background-color: white;">                      
                            FORMATIONS TERMINEES
                            
                        </div>
                        <div id="tab_admin_formations">
                            <table class="table table-striped table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Fin</th>
                                        <th scope="col">Formateur</th>
                                        <th scope="col">Client(s)</th>
                                        <th scope="col">Nb apprenants</th>
                                        <th scope="col">% Satisfaction</th>
                                        <th scope="col">Nb Embauchés</th>
                                        <th scope="col">A 2 mois</th>
                                        <th scope="col">A 6 mois</th>
                                        <th scope="col">Impact Formation</th>
                                        <th scope="col">Compte Rendu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($formations_finies as $formation)
                                    <tr>
                                        <td>{{$formation->nom}}</td>
                                        <td>{{\Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y')}}</td>
                                        <td>{{$formation->formateur->prenom}} {{$formation->formateur->nom}}</td>  
                                        <td>{{$formation->client1->prenom}} {{$formation->client1->nom}}<br>

                                                @if ($formation->client2 != null)  
                                                {{$formation->client2->prenom}} {{$formation->client2->nom}}<br>
                                                @endif
                                                @if ($formation->client3 != null)  
                                                {{$formation->client3->prenom}} {{$formation->client3->nom}}<br>
                                                @endif
                                                @if ($formation->client4 != null)  
                                                {{$formation->client4->prenom}} {{$formation->client4->nom}}<br>
                                                @endif
                                                @if ($formation->client5 != null)  
                                                {{$formation->client5->prenom}} {{$formation->client5->nom}}
                                                @endif
                                            </td> 
                                            <td><span class="badge badge-primary badge-pill">{{ count($formation->apprenants) }}</span></td>
                                            <td><span class="badge badge-primary badge-pill">{{$formation->pourcentageSansDecimalSatif}} | ( {{$formation->nbVotant}} votes )</span></td>  
                                            <td><span class="badge badge-primary badge-pill">{{$formation->nbApprenantsEmbauches}} {{$formation->pourcentageSansDecimalAppEmbauches}}</span></td> 
                                            <td><span class="badge badge-primary badge-pill">{{$formation->nbApprenantsEmbauches2Mois}} {{$formation->pourcentageSansDecimalAppEmbauches2}}</span></td>  
                                            <td><span class="badge badge-primary badge-pill">{{$formation->nbApprenantsEmbauches6Mois}} {{$formation->pourcentageSansDecimalAppEmbauches6}}</span></td>   
                                            <td>{{$formation->impact_formation}}</td>
                                            <td>{{$formation->compte_rendu_formateur}}</td>        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <div class="row" id="gestion_formation">
            <div class="col-lg-12">
                <div class="card-body">
                    <div class="card" style="margin-top: 1%;background-color:#2D3F58;border:hidden;border: 1px white solid;">
                        <div class="card-header" id="header_tableau_apprenants" style="border-color: #E0002D;background-color: white;">
                           
                            FORMATIONS EN COURS 
                            
                        </div>
                        <div id="tab_admin_formations">
                            <table class="table table-striped table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Debut</th>
                                        <th scope="col">Fin</th>
                                        <th scope="col">Formateur</th>
                                        <th scope="col">Client(s)</th>
                                        <th scope="col">Nb apprenants</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($formations as $formation)
                                    <tr>
                                        <td>{{$formation->nom}}</td>
                                        <td>{{\Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y')}}</td>
                                        <td>{{\Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y')}}</td>
                                        <td>{{$formation->formateur->prenom}} {{$formation->formateur->nom}}</td>  
                                        <td>{{$formation->client1->prenom}} {{$formation->client1->nom}}<br>

                                            @if ($formation->client2 != null)  
                                            {{$formation->client2->prenom}} {{$formation->client2->nom}}<br>
                                            @endif
                                            @if ($formation->client3 != null)  
                                            {{$formation->client3->prenom}} {{$formation->client3->nom}}<br>
                                            @endif
                                            @if ($formation->client4 != null)  
                                            {{$formation->client4->prenom}} {{$formation->client4->nom}}<br>
                                            @endif
                                            @if ($formation->client5 != null)  
                                            {{$formation->client5->prenom}} {{$formation->client5->nom}}
                                            @endif
                                        </td> 
                                        <td>{{ count($formation->apprenants) }}</td>           
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                                  
                <div id="accordion" class="accordion_formateur">
                    <div class="card" style="border-color: white; color: #2D3F58;">
                        <div class="card-header" id="headingFive" style="border-color: #E0002D; color: #2D3F58;">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                AJOUTER UN GROUPE DE FORMATION 
                                </button>
                            </h5>
                        </div>
                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                            <form  method="POST" action="{{ route('formation') }}" enctype="multipart/form-data" autocomplete="off">
                                    {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Nom</span>
                                                </div>
                                                <select class="custom-select" id="inputGroupSelect01" required name="nom_formation">
                                                    <option selected disabled="true">Aucun sélectionné</option>

                                                    @foreach($groupes_formation as $groupe_formation)

                                                    <option value="{{$groupe_formation->groupe_formation}}">{{$groupe_formation->groupe_formation}}</option>

                                                    @endforeach    

                                                </select>
                                                
                                            </div> 
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Date début</span>
                                                </div>
                                                <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_debut_formation" aria-describedby="basic-addon2"  required name="debut_formation">
                                            </div>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Date fin</span>
                                                </div>
                                                <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_fin_formation" aria-describedby="basic-addon2" required name="fin_formation">
                                            </div>                                                
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Client(s)</span>
                                                </div>
                                                <select class="custom-select" required id="inputGroupSelect01" name="nom_client1">
                                                    <option selected="true" disabled="true">Aucun sélectionné</option>
                                                    @foreach($clients as $client)

                                                    <option value="{{$client->id}}"><label class="checkbox">{{$client->prenom}} {{$client->nom}}</option>

                                                    @endforeach    
                                                </select>
                                                <select class="custom-select" id="inputGroupSelect01" name="nom_client2">
                                                    <option selected disabled="true">Aucun sélectionné</option>
                                                    @foreach($clients as $client)

                                                    <option value="{{$client->id}}"><label class="checkbox">{{$client->prenom}} {{$client->nom}}</option>

                                                    @endforeach    
                                                </select>
                                                <select class="custom-select" id="inputGroupSelect01" name="nom_client3">
                                                    <option selected disabled="true">Aucun sélectionné</option>
                                                    @foreach($clients as $client)

                                                    <option value="{{$client->id}}"><label class="checkbox">{{$client->prenom}} {{$client->nom}}</option>

                                                    @endforeach    
                                                </select>
                                                <select class="custom-select" id="inputGroupSelect01" name="nom_client4">
                                                    <option selected disabled="true">Aucun sélectionné</option>
                                                    @foreach($clients as $client)

                                                    <option value="{{$client->id}}"><label class="checkbox">{{$client->prenom}} {{$client->nom}}</option>

                                                    @endforeach    
                                                </select>
                                                <select class="custom-select" id="inputGroupSelect01" name="nom_client5">
                                                    <option selected="true" disabled="true">Aucun sélectionné</option>
                                                    @foreach($clients as $client)

                                                    <option value="{{$client->id}}"><label class="checkbox">{{$client->prenom}} {{$client->nom}}</option>

                                                    @endforeach    
                                                </select>
                                            </div> 
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">Formateur</span>
                                                </div>
                                                <select class="custom-select" required id="inputGroupSelect01" name="nom_formateur">
                                                    <option selected disabled="true">Aucun sélectionné</option>
                                                    @foreach($formateurs as $formateur)

                                                    <option value="{{$formateur->id}}">{{$formateur->prenom}} {{$formateur->nom}}</option>

                                                    @endforeach    
                                                </select>
                                            </div>
                                            <div class="custom-file">                                         
                                                <input type="file" name="programme_formation" class="custom-file-input" id="programme_formation" required>
                                                <label class="custom-file-label" for="file">Programme de formation</label>
                                            </div>                                                
                                        </div>
                                        <div class="offset-lg-3 col-lg-6">
                                            <button type="submit" class="btn btn-outline-primary" id="btn_ajout_confirm_formation">AJOUTER</button> 
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
@endsection

