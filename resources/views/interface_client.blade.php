@extends('layouts.menu')

@section('content')
<div class="panel-body" id="body_interface_client">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="mb-0" id="titre_interface_client">
                @foreach($formations as $formation)

                    Formation : {{$formation->nom}} Du {{\Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y')}} au {{\Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y')}}

                 @endforeach
            </h5>  
            <div class="card" style="margin-top: 2%;background-color:#2D3F58;border-color: #E0002D;">
                <div class="card-header" id="header_tableau_apprenants" style="color: white;border-color: #E0002D;">
                    <h5 class="mb-0">
                        Liste de vos Stagiaires 
                    </h5>
                </div>
                <div id="tab_infos_inteface_client">
                    <table class="table table-striped table-dark">
                        <thead>                                    
                            <tr>
                                <th scope="col">Prénom</th>
                                <th scope="col">Nom</th>
                                <th scope="col">eMail</th>
                                <th scope="col">Téléphone</th>       
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formations as $formation)
                                @foreach($formation->apprenants as $apprenant)
                                    @foreach($apprenant->users as $user)
                                    <tr>                         
                                        <td>{{$user->prenom}}</td>
                                        <td>{{$user->nom}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->numero_telephone}}</td>                                    
                                    </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a  href="{{route('apprenants_csv')}}">Extraire toutes les données des stagiaires en fichier Excel</a>
                <button type="button" class="btn btn-outline-primary" id="btn_form_client" style="color: white;" onclick="functionShowHideFormClient();">Suivi des placements en entreprise</button> 
                <div class="form-group" id="form_suivi_client">
                    <label for="exampleFormControlSelect1" id="label_select_stagiaire" style="color: white;">Sélectionner un stagiaire</label>
                    <select class="form-control" id="select_stagiaire_form_client" style="width: 50%;margin-right: auto;margin-left: auto;">
                        @foreach($formations as $formation)
                            @foreach($formation->apprenants as $apprenant)
                                @foreach($apprenant->users as $user)
                                    <option>{{$user->prenom}} {{$user->nom}}</option>  
                                @endforeach
                            @endforeach
                        @endforeach
                    </select>
                    <div class="row" id="contenu_form_client"  style="color: white;">
                        <div class="col-lg-6">
                            <div style="margin-top: 5%;">
                                <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                                <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                                <label class="form-check-label" for="autoSizingCheck" id="label_embauche_stagiaire">
                                Embauché (Oui si coché)
                                </label>
                                <br>
                                <label for="exampleFormControlTextarea1">Motif</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Entrer un motif si le stagiaire n'a pas été embauché."></textarea>
                            </div>                        
                            <div id="presence_2_mois">
                                <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                                <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                                <label class="form-check-label" for="autoSizingCheck" id="label_presence_2m">
                                Présence à 2 mois (Oui si coché)
                                </label>
                                <br>
                                <label for="exampleFormControlSelect1">Sélectionner un motif</label>
                                <select class="custom-select" id="inlineFormCustomSelect">
                                    <option selected>Motif</option>
                                    <option value="1">Fin période d'essai à l'initiative de l'employeur</option>
                                    <option value="2">Fin période d'essai à l'initiative de l'employé</option>
                                    <option value="3">Autres</option>
                                </select>
                                <label for="exampleFormControlTextarea1">Motif détaillé</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Entrer un motif si le stagiaire n'a pas gardé après 2 mois."></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div id="presence_6_mois">
                                <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                                <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                                <label class="form-check-label" for="autoSizingCheck" id="label_presence_6m">
                                Présence à 6 mois (Oui si coché)
                                </label>
                                <br>
                                <label for="exampleFormControlTextarea1">Motif</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="Entrer un motif si le stagiaire n'est plus présent après 6 mois."></textarea>
                            </div>
                            <button type="button" class="btn btn-outline-primary" style="margin-top: 14%;width: 100%">Valider</button>
                        </div>
                    </div>
                </div>
                <br> 
                <button type="button" class="btn btn-outline-primary" id="btn_impact_form_client" style="color: white;">Impact de l'action de formation sur l'entreprise</button>
                <form class="form-horizontal" method="GET" action="{{ route('downloadPdfClient') }}">
                {{ csrf_field() }}
                   <button type="submit" class="btn btn-outline-primary" style="color: white;">Télécharger le fichier d'évaluation</button>
                </form>                  
            </div>                               
        </div>
    </div>
</div>
@endsection