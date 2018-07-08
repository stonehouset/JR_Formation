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
                                        <th scope="col">#</th>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Prénom</th>
                                        <th scope="col">Formation suivie</th>
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
                                <div class="card-header" id="headingOne">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                        Ajouter un Apprenant
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend" id="marg_check_sexe">
                                                        <span class="input-group-text" id="basic-addon1">Sexe</span>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                        <label class="form-check-label" for="inlineRadio1">Homme</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                        <label class="form-check-label" for="inlineRadio2">Femme</label>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Nom</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="input_nom" placeholder="Martin" aria-label="Nom" aria-describedby="basic-addon2">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Prénom</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Pierre" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">eMail</span>
                                                    </div>
                                                    <input type="email" class="form-control" placeholder="pierre.martin@fra.fr" aria-label="eMail" aria-describedby="basic-addon2">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Date de naissance</span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_naissance" aria-describedby="basic-addon2">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Adresse</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="2 rue Voltaire" aria-label="date_naissance" aria-describedby="basic-addon2">
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Date début tutorat</span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_debut_tutorat" aria-describedby="basic-addon2">
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Date CDI</span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_cdi" aria-describedby="basic-addon2">
                                                </div>                         
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon3">Id Pôle Emploi</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">N° Sécurité Sociale</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">N° Téléphone</span>
                                                    </div>
                                                    <input type="tel" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                </div>  
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Nationalité</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Française" aria-label="nationalite" aria-describedby="basic-addon2">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Lieu de naissance</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Paris" aria-label="lieu_naissance" aria-describedby="basic-addon2">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="inputGroupSelect01">Formation</label>
                                                    </div>
                                                    <select class="custom-select" id="inputGroupSelect01">
                                                        <option selected>Aucune sélectionné</option>
                                                        <option value="1">Quick</option>
                                                        <option value="2">Brutch</option>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="inputGroupSelect01">Groupe de Formation</label>
                                                    </div>
                                                    <select class="custom-select" id="inputGroupSelect01">
                                                        <option selected>Aucun sélectionné</option>
                                                        <option value="1">Quick BBM1</option>
                                                        <option value="2">Brutch AF1</option>
                                                    </select>
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Date fin tutorat</span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_fin_tutorat" aria-describedby="basic-addon2">
                                                </div>
                                            </div>
                                            <div class="input-group mb-3">
                                                <button type="button" class="btn btn-primary"id="btn_ajout_confirm_apprenant">Ajouter</button> 
                                                <button type="button" class="btn btn-danger" id="btn_annuler">Annuler</button> 
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>                  
                            <div class="card">
                                <div class="card-header" id="headingTwo">  
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Ajouter un Formateur
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Nom</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="nom_entreprise" placeholder="Nom" aria-label="Nom" aria-describedby="basic-addon1">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">eMail</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="email_entreprise" placeholder="eMail" aria-label="Nom" aria-describedby="basic-addon1">
                                                </div>  
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon3">Autres</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">N° Téléphone</span>
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
                            <div class="card">
                                <div class="card-header" id="headingThree">  
                                    <h5 class="mb-0">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            Ajouter un Client
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Nom</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="nom_client" placeholder="Nom" aria-label="nom_client" aria-describedby="basic-addon1">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">eMail</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="email_client" placeholder="eMail" aria-label="email_client" aria-describedby="basic-addon1">
                                                </div>  
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">N° Téléphone</span>
                                                    </div>
                                                    <input type="tel" class="form-control" placeholder="Téléphone" aria-label=telephone" name="tel_client" aria-describedby="basic-addon2">
                                                </div> 
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon3">Autres</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3" name="autre_client">
                                                </div> 
                                            </div>
                                            <div class="input-group mb-3">
                                                <button type="button" class="btn btn-primary"id="btn_ajout_confirm_client">Ajouter</button> 
                                                <button type="button" class="btn btn-danger" id="btn_annuler_client">Annuler</button> 
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
                                <span class="badge badge-primary badge-pill">10</span>
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
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Date début formation</span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_fin_formation" aria-describedby="basic-addon2">
                                                </div>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Date fin formation</span>
                                                    </div>
                                                    <input type="date" class="form-control" placeholder="01/01/2018" aria-label="date_fin_formation" aria-describedby="basic-addon2">
                                                </div>                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Client</span>
                                                    </div>
                                                    <input type="tel" class="form-control" placeholder="Nom Client" aria-label=telephone" aria-describedby="basic-addon2">
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
