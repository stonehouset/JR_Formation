@extends('layouts.menu')

@section('content')
<div class="card text-center">
    <div class="card-body">
        <div class="card-title">
            <button type="button" class="btn btn-outline-dark" id="btn_donnees">Données Utilisateurs</button>
            <button type="button" class="btn btn-outline-dark" id="btn_gestion_formation">Gestion Formations</button>
            <button type="button" class="btn btn-outline-dark" id="btn_gestion_utilisateur">Gestion Utilisateurs</button>                    
        </div>
        <div class="card-text" id="gestion_utilisateurs">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <table class="table table-striped table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prénom</th>
                                        <th scope="col">Rôle</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Téléphone</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>

                                        <th scope="row">{{$user->id}}</th>
                                        <td>{{$user->nom}}</td>
                                        <td>{{$user->prenom}}</td>
                                        <td>{{$user->role}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->numero_telephone}}</td>                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Ajouter un Utilisateur
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="input-group mb-3" id="selection_role">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Rôle</label>
                                            </div>
                                            <select class="custom-select" id="inputGroupSelect01" name="role[]">
                                                <option selected>Aucun sélectionné</option>
                                                <option value="0">Apprenant</option>
                                                <option value="1">Formateur</option>
                                                <option value="2">Client</option>
                                                <option value="3">Admin</option>
                                            </select>
                                        </div>                                                                               
                                        <form id="form_register_users" method="POST" action="{{ route('register') }}">
                                            {{ csrf_field() }}
                                            <div class="row">                                               
                                                <div class="col-lg-6">
                                                    <div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Nom</span>
                                                        </div>
                                                        <div>
                                                            <input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" required autofocus>

                                                            @if ($errors->has('nom'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('nom') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Prénom</span>
                                                        </div>
                                                        <div>
                                                            <input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="prenom">Rôle</label>
                                                        <div>
                                                            <input id="role" type="number" class="form-control" name="role" value="" min="0" required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="prenom" control-label">N° Téléphone</label>
                                                        <div>
                                                            <input id="numero_telephone" type="tel" class="form-control" name="numero_telephone" value="" required autofocus>
                                                        </div>
                                                    </div>
                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <label for="email" control-label">eMail</label>
                                                        <div>
                                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                            @if ($errors->has('email'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('email') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                        <label for="password">Mot de passe</label>

                                                        <div>
                                                            <input id="password" type="password" class="form-control" name="password" required>

                                                            @if ($errors->has('password'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('password') }}</strong>
                                                                </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password-confirm" class="col-md-4 control-label">Confirmer le mot de passe</label>

                                                        <div>
                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div>
                                                            <button type="submit" class="btn btn-primary">
                                                                Register
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>                                         
                                                <div class="col-lg-6" id="form_apprenant">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend" id="marg_check_sexe">
                                                            <span class="input-group-text" id="basic-addon1">Sexe</span>
                                                        </div>
                                                        <label class="btn btn-secondary">
                                                            <input type="radio" name="options[]" id="option1" autocomplete="off"> Homme
                                                        </label>
                                                        <label class="btn btn-secondary">
                                                            <input type="radio" name="options[]" id="option2" autocomplete="off"> Femme
                                                        </label>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Date de naissance</span>
                                                        </div>
                                                        <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_naissance" aria-describedby="basic-addon2" name="date_naissance_apprenant">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Adresse</span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="2 rue Voltaire" aria-label="adresse" aria-describedby="basic-addon2" name="adresse_apprenant">
                                                    </div> 
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">Date début tutorat</span>
                                                        </div>
                                                        <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_debut_tutorat" aria-describedby="basic-addon2" name="date_debut_tutorat">
                                                    </div> 
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">Date CDI</span>
                                                        </div>
                                                        <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_cdi" aria-describedby="basic-addon2" name="date_cdi">
                                                    </div>                         
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon3">Id Pôle Emploi</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="pole_emploi">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" id="basic-addon1">N° Sécurité Sociale</span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" name="num_secu">
                                                    </div>  
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Nationalité</span>
                                                        </div>
                                                            <input type="text" class="form-control" placeholder="Française" aria-label="nationalite" aria-describedby="basic-addon2" name="nationalite">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Lieu de naiss</span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Paris" aria-label="lieu_naissance" aria-describedby="basic-addon2" name="lieu_naissance">
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="inputGroupSelect01">Formation</label>
                                                        </div>
                                                        <select class="custom-select" id="inputGroupSelect01" name="formations[]">
                                                            <option selected>Aucune sélectionné</option>
                                                            <option value="1">Quick</option>
                                                            <option value="2">Brutch</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <label class="input-group-text" for="inputGroupSelect01">Groupe de Formation</label>
                                                        </div>
                                                        <select class="custom-select" id="inputGroupSelect01" name="groupe_formations[]">
                                                            <option selected>Aucun sélectionné</option>
                                                            <option value="1">Quick BBM1</option>
                                                            <option value="2">Brutch AF1</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1">Date fin tutorat</span>
                                                        </div>
                                                        <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_fin_tutorat" aria-describedby="basic-addon2" name="date_fin_tutorat">
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <button type="submit" class="btn btn-primary"id="btn_ajout_confirm_apprenant">Ajouter</button> 
                                                    <button type="button" class="btn btn-danger" id="btn_annuler">Annuler</button> 
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
        <div class="card-text" id="contenu_donnees">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-group">
                            <button type="button" class="list-group-item list-group-item-action active btn btn-outline-dark">
                                Informations générales
                            </button>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Nombre d'utilisateurs
                                <span class="badge badge-primary badge-pill"><span>{{ count($users) }}</span></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Nouveaux messages
                                <span class="badge badge-primary badge-pill">2</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Formulaire complété(s)
                                <span class="badge badge-primary badge-pill">1</span>
                            </li>
                        </ul>
                    </div>
                    <br>
                    <div class="col-lg-6">
                        <div class="list-group">
                            <button type="button" class="list-group-item list-group-item-action active btn btn-outline-dark">
                                Gestion des utilisateurs
                            </button>
                            <button type="button" class="list-group-item list-group-item-action">Supprimer un utilisateur</button>
                            <button type="button" class="list-group-item list-group-item-action">Modifier données utilisateur</button>
                            <button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>
                        </div>
                    </div>
                </div>
                <br>
                <div class="list-group">
                    <button type="button" class="list-group-item list-group-item-action active btn btn-outline-dark">
                        Gestion des utilisateurs
                    </button>
                    <button type="button" class="list-group-item list-group-item-action">Supprimer un utilisateur</button>
                    <button type="button" class="list-group-item list-group-item-action">Modifier données utilisateur</button>
                    <button type="button" class="list-group-item list-group-item-action">Porta ac consectetur ac</button>
                    <button type="button" class="list-group-item list-group-item-action" disabled>Vestibulum at eros</button>
                </div>
            </div>
        </div>
        <div class="card-text" id="gestion_formation">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-body">
                            <table class="table table-striped table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Client</th>
                                        <th scope="col">Nombre d'apprenant</th>
                                        <th scope="col">Taux de satisfaction</th>
                                        <th scope="col">Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Formation Butch</td>
                                        <td>Brut Butcher</td>
                                        <td>17</td>
                                        <td>100%</td>
                                        <td>En cours</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Formation CU38</td>
                                        <td>Les cuisiniers du 38</td>
                                        <td>31</td>
                                        <td>100%</td>
                                        <td>Terminée</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Formation Quick</td>
                                        <td>Quick</td>
                                        <td>31</td>
                                        <td>99.9%</td>
                                        <td>Terminée</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                                  
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingFive">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                        Ajouter une Formation
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
                                                            <span class="input-group-text" id="basic-addon1">Nom</span>
                                                        </div>
                                                        <input type="tel" class="form-control" placeholder="Nom" aria-label=nom" aria-describedby="basic-addon2" name="nom_formation">
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
                                                        <input type="tel" class="form-control" placeholder="Nom Client" aria-label=nom_client" aria-describedby="basic-addon2" name="nom_client">
                                                    </div> 
                                                    <div class="input-group mb-3">
                                                        <button type="submit" class="btn btn-primary"id="btn_ajout_confirm_apprenant">Ajouter</button> 
                                                        <button type="button" class="btn btn-danger" id="btn_annuler">Annuler</button> 
                                                    </div>                                                 
                                                </div>
                                            </div>                             
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingSix">  
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                        Ajouter un groupe de Formation
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">Client</span>
                                            </div>
                                            <input type="tel" class="form-control" placeholder="Téléphone" aria-label=telephone" aria-describedby="basic-addon2">
                                        </div> 
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Formation</label>
                                            </div>
                                            <select class="custom-select" id="inputGroupSelect01">
                                                <option selected>Aucune sélectionnée</option>
                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <button type="button" class="btn btn-primary"id="btn_ajout_confirm_apprenant">Ajouter</button> 
                                            <button type="button" class="btn btn-danger" id="btn_annuler">Annuler</button> 
                                        </div> 
                                    </div>
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
