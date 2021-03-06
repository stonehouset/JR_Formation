@extends('layouts.menu')

@section('content')
<body>
    <div class="card text-center" id="card_principale_home">
        <div class="card-body">
            <div class="row" id="btns_gestion_admin">
                <div class="col-lg-4">
                    <button type="button" class="btn btn-outline-dark" id="btn_donnees">Données générales</button>      
                </div>
                <div class="col-lg-4">
                    <button type="button" class="btn btn-outline-dark" id="btn_gestion_utilisateur">Gestion utilisateurs</button> 
                </div>
                <div class="col-lg-4">
                    <button type="button" class="btn btn-outline-dark" id="btn_gestion_formation">Gestion formations</button> 
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
            @if ($errors->has('password'))
                <div class="alert alert-error" id="div_show_error">
                    <strong>Les mots de passe ne correspondent pas</strong>
                </div>
            @endif  
            @if ($errors->has('email'))
                <div class="alert alert-error" id="div_show_error">
                    <strong>Cet email est déja utilisé</strong>
                </div>
            @endif 
            <div class="card-text" id="contenu_donnees">
                <div class="panel-body" >
                    <div class="row" id="liste_infos_generales_admin">
                        <div class="col-lg-6" style="margin-top: 1%;">
                            <ul class="list-group" >
                                <button type="button" class="list-group-item list-group-item-action active btn btn-outline-dark" id="header_item_utilisateur">
                                    Informations utilisateurs
                                </button>
                                <li class="list-group-item d-flex justify-content-between align-items-center" id="item_details_users" style="font-weight: bold;">                  
                                    Nombre d'utilisateurs total
                                    <h5><span class="badge badge-primary badge-pill">{{ count($users) }}</span></h5>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" id="item_details_users">
                                    Nombre d'apprenants
                                    <h5><span class="badge badge-primary badge-pill">{{ count($apprenants) }}</span></h5>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" id="item_details_users">
                                    Nombre de clients
                                    <h5><span class="badge badge-primary badge-pill">{{ count($clients) }}</span></h5>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" id="item_details_users">
                                    Nombre de formateurs
                                    <h5><span class="badge badge-primary badge-pill">{{ count($formateurs) }}</span></h5>
                                </li>
                            </ul>
                        </div>
                        <br>
                        <div class="col-lg-6" style="border-color: white;margin-top: 1%;">
                            <ul class="list-group">
                                <button type="button" class="list-group-item list-group-item-action active btn btn-outline-dark" id="header_item_utilisateur">
                                    Suivi des apprenants
                                </button>
                                <li class="list-group-item d-flex justify-content-between align-items-center" id="item_suivi_embauche" style="font-weight: bold;">
                                    Nombre d'embauchés total
                                    <h5><span class="badge badge-primary badge-pill">{{$nbEmbauchesTotal}} ({{$pourcentageEmbauchesTotal}} %)</span></h5>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" id="item_suivi_embauche">
                                    Nombres d'embauchés à 2 mois
                                    <h5><span class="badge badge-primary badge-pill">{{$nbEmbauches2moisTotal}} ({{$pourcentageEmbauches2MoisTotal}} %)</span></h5>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" id="item_suivi_embauche">
                                    Nombres d'embauchés à 6 mois
                                    <h5><span class="badge badge-primary badge-pill">{{$nbEmbauches6moisTotal}} ({{$pourcentageEmbauches6MoisTotal}} %)</span></h5>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center" id="item_suivi_embauche">
                                    Non embauchés
                                    <h5><span class="badge badge-primary badge-pill">{{$nbNonEmbauches}}</span></h5>
                                </li>
                            </ul>
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card" style="margin-top: 1%;border: 1px white solid;">
                            <div class="card-header" id="header_tableau_apprenants">                      
                                Formations terminées        
                            </div>
                            <div id="tab_admin_formations">
                                <table class="table table-striped table-dark table-hover">
                                    <thead id="head_tab_form_term_admin">
                                        <tr>
                                            <th scope="col">Nom</th>
                                            <th scope="col">Fin</th>
                                            <th scope="col">Formateur</th>
                                            <th scope="col">Client(s)</th>
                                            <th scope="col">Nb apprenants</th>
                                            <th scope="col">% Satisfaction</th>
                                            <th scope="col">Non embauchés</th>
                                            <th scope="col">Embauchés</th>
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
                                            <td>
                                                <h5>
                                                    <span class="badge badge-primary badge-pill">{{ count($formation->apprenants) }}</span>
                                                </h5>
                                            </td>
                                            <td>
                                                <h5>
                                                    <span class="badge badge-primary badge-pill">{{$formation->pourcentageSansDecimalSatif}} | ({{$formation->nbVotant}} votes)</span>
                                                </h5>
                                            </td>  
                                            <td>
                                                <h5>
                                                    <span class="badge badge-primary badge-pill">{{$formation->nbApprenantsNonEmbauches}} {{$formation->pourcentageSansDecimalAppNonEmbauches}}</span>
                                                </h5>
                                            </td>
                                            <td>
                                                <h5>
                                                    <span class="badge badge-primary badge-pill">{{$formation->nbApprenantsEmbauches}} {{$formation->pourcentageSansDecimalAppEmbauches}}</span>
                                                </h5>
                                            </td> 
                                            <td>
                                                <h5>
                                                    <span class="badge badge-primary badge-pill">{{$formation->nbApprenantsEmbauches2Mois}} {{$formation->pourcentageSansDecimalAppEmbauches2}}</span>
                                                </h5>
                                            </td>  
                                            <td>
                                                <h5>
                                                    <span class="badge badge-primary badge-pill">{{$formation->nbApprenantsEmbauches6Mois}} {{$formation->pourcentageSansDecimalAppEmbauches6}}</span>
                                                </h5>
                                            </td>   
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
            <div class="card-text" id="gestion_utilisateurs">  
                <div class="row">
                    <div class="col-lg-12" id="tableau_gestion_admin_infos_apprenants">
                        <div class="card-header" id="header_tableau_apprenants">
                            Apprenants       
                            <a  href="{{route('apprenants_admin_csv')}}">&#8659;</a> 
                            <input type="text" id="myInput" onkeyup="search()" placeholder="nom ou prénom" title="cherche apprenant">
                            <button id="btn_switch_to_client_form">+</button>
                        </div>
                        <div id="tab_admin_apprenants">   
                            <table class="table table-striped table" id="myTable" style="table-layout: fixed;">
                                <thead id="head_tab_apprenants_admin">
                                    <tr id="myUL"> 
                                        <th scope="col">Prénom Nom <br>Groupe formation</th>                                   
                                                                           
                                        <th scope="col">Commentaires</th>
                                        <th scope="col">Embauché/ 2 mois/ 6 mois</th> 
                                        <th scope="col">Eval Formation<br>Eval Formateur</th> 
                                    </tr>
                                </thead>
                                <tbody id="body_tab_apprenants_admin">
                                    @if ($apprenants != null)
                                        @foreach($apprenants as $apprenant)
                                        <tr id="td">
                                            <td class="td">{{$apprenant->prenom}} {{$apprenant->nom}}<br>{{$apprenant->groupe_formation}}</td>
                                                                             
                                            <td class="td" style="height:70px;min-width: 150px;">
                                                <div style="word-wrap: break-word;overflow:auto;height:70px;width: auto;">{{$apprenant->commentaire_semaine1}}<br><br>{{$apprenant->commentaire_semaine2}}<br><br>{{$apprenant->commentaire_semaine3}}</div>
                                            </td>
                                            <td class="td" style="height: 70px;min-width: 150px;">
                                                <div style="word-wrap: break-word;overflow:auto;height:70px;width: auto;">
                                                  {{$apprenant->embauche}}<br><br>
                                                 -{{$apprenant->a2mois}}<br><br>
                                                 -{{$apprenant->a6mois}}
                                                </div>
                                            </td> 
                                            <td class="td">{{$apprenant->evalFormation}}<br>{{$apprenant->evalFormateur}}</td>   
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
                <div class="row" id="tab_formateurs_et_clients">
                    <div class="col-lg-6" id="tableau_gestion_admin_infos_formateurs">                   
                        <div class="card-header" id="header_tableau_apprenants">                      
                            Formateurs                   
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
                    <div class="col-lg-6" id="tableau_gestion_admin_infos_formateurs2">                   
                        <div class="card-header" id="header_tableau_apprenants">                      
                            Clients
                            <button id="btn_switch_to_form">+</button>                       
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
                                @if ($clients != null)
                                    @foreach($clients as $client)
                                    <tr>
                                        <td>{{$client->prenom}} {{$client->nom}}</td>
                                        <td>{{$client->email}}</td>
                                        <td>{{$client->numero_telephone}}</td>                                        
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
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" id="header_add_user">
                                    + Utilisateur
                                </button>
                            </h5>
                        </div>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body"> 
                                <h5 id="entete_add_user">Veuillez compléter tous les champs pour ajouter un utilisateur. Veillez à ne pas ajouter une adresse mail déja existante et à rentrer 2 mots de passe identiques.</h5>
                                <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="register_user">
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="offset-lg-3 col-lg-6">
                                            <div class="form-group">
                                                <label for="prenom" id="label_form_user_admin" style="" class="control-label">Rôle</label>    
                                                <select class="custom-select" required id="role" class="form-control" name="role">
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
                                                 
                                            </div>
                                            <div class="form-group">
                                                <label for="password-confirm" id="label_form_user_admin" class="control-label">Confirmer le mot de passe</label>
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                            </div>                                                  
                                        </div>
                                        <div class="offset-lg-4 col-lg-4">
                                            <button type="submit" id="btn_ajout_user_admin" class="btn btn-outline-primary">
                                                <div id="label_btn_register">
                                                    Enregistrer
                                                </div>
                                                <div class="loader"></div> 
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
                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" id="header_liste_apprenants">
                                + Liste d'apprenants
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body">                           
                                <div class="row"> 
                                    <div class="offset-lg-4 col-lg-4">
                                    <h6 id="msg_warning_suppr">ATTENTION! Le fichier est sensible à la casse ! veuillez utiliser le fichier : fichier_type.csv, et remplir tous les champs d'une ligne, sans AUCUN ACCENT!</h6>
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
                                                <div id="label_btn_submit_add_appr">
                                                    Ajouter
                                                </div>
                                                <div class="loader"></div> 
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
                                Supprimer un utilisateur
                                </button>
                            </h5>
                        </div>
                        <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">                      
                            <form id="form_suppr_users" enctype="multipart/form-data" method="POST" action="{{ route('delete_user')}}">
                                {{ csrf_field() }} 
                                <div class="row" id="div_suppr_user">
                                    <div class="offset-lg-4 col-lg-4">
                                        <div class="form-group"> 
                                            <h6 id="msg_warning_suppr">ATTENTION! Si l'utilisateur est formateur ou client vérifiez que toutes les formations associées a cet utilisateur soit supprimées, sinon une erreur sera générée par le serveur!</h6>          
                                            <select class="custom-select" required="" id="user_a_suppr" class="form-control" name="suppr_user">
                                                <option selected disabled="true">Sélectionner un utilisateur à supprimer</option>
                                                @foreach($usersNonApprenant as $user)
                                                    <option value="{{$user->id}}" >{{$user->prenom}} {{$user->nom}} </option>
                                                @endforeach             
                                            </select>   
                                        </div>

                                    </div>
                                    <div class="offset-lg-4 col-lg-4">
                                        <button type="submit" id="btn_suppr_user_admin" class="btn btn-outline-primary">             
                                            <div id="label_btn_submit_suppr_user">
                                                SUPPRIMER (irréversible)
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
            <div class="row" id="gestion_formation">
                <div class="col-lg-12">               
                    <div class="card" id="card_forma_en_cours">
                        <div class="card-header" id="header_tableau_apprenants">
                            Formations 
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
                                        <th scope="col">Statut</th>
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
                                        <td>{{ $formation->statut }}</td>         
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>              
                    </div>                                  
                    <div id="accordion" class="accordion_formateur">
                        <div class="card" style="border-color: white; color: #2D3F58;background-color: transparent;">
                            <div class="card-header" id="headingFive" style="border-color: #E0002D; color: #2D3F58;">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" id="header_ajout_formation" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    + Groupe de formation
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                                <h6 id="entete_add_gr">Veuillez compléter tous les champs pour ajouter un groupe de formation. Vous pouvez sélectionner jusqu'a 5 clients maximum. Le programme doit être unique, sans accent ni espace.</h6>
                                <form method="POST" action="{{ route('formation') }}" enctype="multipart/form-data" autocomplete="off" id="form_add_formation">
                                    {{ csrf_field() }}
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Nom</span>
                                                    </div>
                                                    <select class="custom-select" required id="inputGroupSelect01"  name="nom_formation">
                                                        <option selected disabled="true">Aucun sélectionné</option>

                                                        @foreach($groupes_formation as $groupe_formation)

                                                        <option value="{{$groupe_formation->groupe_formation}}">{{$groupe_formation->groupe_formation}}</option>

                                                        @endforeach    

                                                    </select>
                                                    
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Début</span>
                                                    </div>
                                                    <input type="date" class="form-control" required placeholder="01/01/2018" aria-label="date_debut_formation" aria-describedby="basic-addon2" id="choix_dat_form"  name="debut_formation">
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Fin</span>
                                                    </div>
                                                    <input type="date" class="form-control" required placeholder="01/01/2018" aria-label="date_fin_formation" aria-describedby="basic-addon2" id="choix_dat_form"  name="fin_formation">
                                                </div>                                                  
                                            </div>
                                            <div class="col-lg-6">
                                                
                                                <h6 id="h6_plusieurs_clients">Maintenir touche Ctrl et clique gauche pour sélectionner plusieurs clients</h6>
                                                <div class="input-group-prepend" id="input_select_clients">
                                                    <span class="input-group-text" id="basic-addon1">Client(s)</span>
                                                        <select class="custom-select" required name="client[]" multiple style="height: 60px;">
                                                        @foreach($clients as $client)
                                                            <option value="{{$client->id}}" >{{$client->prenom}} {{$client->nom}}</option>
                                                        @endforeach  
                                                        
                                                    </select>

                                                </div>
                                               
                                                <div class="input-group mb-3" id="input_select_formateur">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Formateur</span>
                                                    </div>
                                                    <select class="custom-select" required id="inputGroupSelect01" name="nom_formateur">
                                                        <option selected disabled="true">Aucun sélectionné</option>
                                                        @foreach($formateurs as $formateur)

                                                        <option value="{{$formateur->id}}">{{$formateur->prenom}} {{$formateur->nom}}</option>

                                                        @endforeach  

                                                    </select>

                                                </div>                                                                                         
                                            </div>
                                              
                                            <div class="offset-lg-3 col-lg-6">
                                                <div class="custom-file">                                         
                                                    <input type="file" name="programme_formation" class="custom-file-input" id="programme_formation" required>
                                                    <label class="custom-file-label" for="file">Programme</label>
                                                </div> 
                                                <button type="submit" class="btn btn-outline-primary" id="btn_ajout_confirm_formation">   
                                                    <div id="label_btn_submit_add_form">
                                                        Ajouter
                                                    </div>
                                                    <div class="loader"></div>
                                                </button> 
                                            </div>  
                                        </div>                             
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="border-color: red; color: #2D3F58;box-shadow: 1px 1px 5px black;background-color: transparent;">
                        <div class="card-header" id="headingNine" style="color: red;">
                            <h5 class="mb-0" style="text-align: center;">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine" id="color_heading9">
                                Supprimer un groupe 
                                </button>
                            </h5>
                        </div>
                        <div id="collapseNine" class="collapse" aria-labelledby="headingNine" data-parent="#accordion">
                            <form method="POST" action="{{ route('suppr_formation') }}" enctype="multipart/form-data" autocomplete="off" id="form_suppr_form">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="offset-lg-4 col-lg-4">
                                        <h6 id="msg_warning_suppr">ATTENTION! Cette action supprimera toutes les données liées au groupe de formation choisi (apprenants, commentaires, statistiques, clients) de façon DEFINITIVE!</h6>
                                        <div class="input-group mb-3" id="input_suppr_form">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Groupe de formation</span>
                                            </div>
                                            <select class="custom-select" id="inputGroupSelect01" name="nom_formation">
                                                <option selected disabled="true">Aucun sélectionné</option>

                                                @foreach($formations as $formation)

                                                    <option value="{{$formation->nom}}">{{$formation->nom}}</option>

                                                @endforeach    

                                            </select> 
                                        </div> 
                                        <button type="submit" id="btn_suppr_user_admin" class="btn btn-outline-primary">                 
                                            <div id="label_btn_submit_suppr_form">
                                                SUPPRIMER (irréversible)
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
    </div>
</body>
@endsection

