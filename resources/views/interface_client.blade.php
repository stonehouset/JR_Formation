@extends('layouts.menu')

@section('content')
<div class="panel-body" id="body_interface_client">
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
    <div class="row">
        <div class="col-lg-12">
            <h5 class="mb-0" id="titre_interface_client">

                Interface Client
                
            </h5>  
            <div id="card_tab_apprenant_client">
                <div class="card-header" id="header_tableau_apprenants">                  
                    Apprenants à mon compte
                </div>
                <div id="tab_infos_inteface_client">
                    <table class="table table-striped table">
                        <thead id="head_tab_apprenant_client">                                    
                            <tr>
                                <th scope="col">Formation</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Nom</th>   
                                <th scope="col">Email</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col">Embauché</th>
                                <th scope="col">Après 2 mois</th> 
                                <th scope="col">Après 6 mois</th>        
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formations as $formation)
                                @foreach($formation->apprenants as $apprenant)
                                    @foreach($apprenant->users as $user)
                                    <tr>
                                        <td>{{$apprenant->groupe_formation}}</td>                         
                                        <td>{{$user->prenom}}</td>
                                        <td>{{$user->nom}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>0{{$user->numero_telephone}}</td> 
                                        <td>{{$apprenant->embauche}}</td>
                                        <td>{{$apprenant->embauche_2_mois}}</td>
                                        <td>{{$apprenant->embauche_6_mois}}</td>                                   
                                    </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- <a  href="{{route('apprenants_csv')}}" id="lien_download_tab_client">Extraire les données des apprenants en fichier Excel</a> -->
            </div>
            <button type="button" class="btn btn-outline-primary" id="btn_form_client" onclick="functionShowHideFormClient();">Placements en entreprise</button> 
            <form class="form-horizontal" method="POST" action="{{route('suivi_apprenant')}}" id="form_suivi_app_client">
                {{csrf_field()}}
                <div class="form-group" id="form_suivi_client">
                    <h5 id="titre_form_impact_formation1">SUIVI DES APPRENANTS EN ENTREPRISE</h5>  
                    <h5>Merci de bien vouloir consacrer quelques instants à remplir ce formulaire pour mettre le statut des apprenants à jour. Vous pouvez le compléter au fur et à mesure du temps, si vous avez déja indiqué une date d'embauche pour un apprenant, vous pouvez laisser le champs associé vide.</h5>
                    <div class="row" style="margin-top: 2%;">
                        <div class="offset-lg-4 col-lg-4">
                            <label for="exampleFormControlSelect1" id="label_select_stagiaire">Sélectionnez un apprenant</label>
                            <select class="form-control" id="select_stagiaire_form_client" required name="id_apprenant">
                                <option selected disabled>Aucun sélectionné</option>
                                @foreach($formations as $formation)
                                    @foreach($formation->apprenants as $apprenant)
                                        @foreach($apprenant->users as $user)
                                            <option value="{{$user->id}}">{{$user->prenom}} {{$user->nom}}</option>  
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" id="contenu_form_client">
                        <div class="offset-lg-3 col-lg-6">
                            <div id="div_checkbox_embauche">
                                <input class="form-check-input" type="checkbox" id="embauche_ou_non" name="embauche_ou_non" value="1" onchange="doalert(this)">                               
                                <label class="form-check-label" for="autoSizingCheck" id="label_embauche_stagiaire">
                                Embauché (Oui si coché)
                                </label>
                                <br>
                                <label for="input_date_embauche" id="label_date_embauche"> En date du : </label>
                                <input type="date" class="form-control" placeholder="en date du :" aria-label="date_embauche" aria-describedby="basic-addon2" id="input_date_embauche" name="date_embauche">
                                <br>
                                <label for="motif_non_embauche" id="label_motif_non_embauche">Motif</label>
                                <textarea class="form-control" name="motif_non_embauche" id="motif_non_embauche" rows="1" placeholder="Entrez un motif si l'apprenant n'a pas été embauché (100 caractères maximum)." maxlength="100"></textarea>
                            </div>                        
                            <div id="presence_2_mois">
                                <input class="form-check-input" type="checkbox" id="autoSizingCheck" name="embauche_2_mois" value="1" onchange="doalert2(this)">                                
                                <label class="form-check-label" for="autoSizingCheck" id="label_presence_2m">
                                Présence à 2 mois (Oui si coché)
                                </label>
                                <br>
                                <label for="motif_predefini_2_mois" id="label_select_motif_2_mois">Sélectionnez un motif</label>
                                <select class="custom-select" id="motif_predefini_2_mois" name="motif_predefini">
                                    <option disabled selected>Motif</option>
                                    <option value="Fin période d'essai à l'initiative de l'employeur">Fin période d'essai à l'initiative de l'employeur</option>
                                    <option value="Fin période d'essai à l'initiative de l'employé">Fin période d'essai à l'initiative de l'employé</option>
                                    <option value="Autres">Autres</option>
                                </select>
                                <label for="motif_detaille_2_mois" id="label_motif_detaille_2_mois">Motif détaillé</label>
                                <textarea class="form-control" name="motif_non_embauche_2_mois" id="motif_detaille_2_mois" rows="1" placeholder="Vous pouvez développer (100 caractères maximum)." maxlength="100"></textarea>
                            </div>
                                <div id="presence_6_mois">
                                <input class="form-check-input" type="checkbox" id="autoSizingCheck" name="embauche_6_mois" value="1" onchange="doalert3(this)">
                                <label class="form-check-label" for="autoSizingCheck" id="label_presence_6m">
                                Présence à 6 mois (Oui si coché)
                                </label>
                                <br>
                                <label for="input_embauche_6_mois" id="label_embauche_6_mois">Motif</label>
                                <textarea class="form-control" name="motif_non_embauche_6_mois" id="input_embauche_6_mois" rows="1" placeholder="Entrer un motif si l'apprenant n'est plus présent après 6 mois (100 caractères maximum)." maxlength="100"></textarea>
                            </div>
                        </div>                         
                        <div class="offset-lg-3 col-lg-6">                     
                            <button type="submit" class="btn btn-outline-primary" id="btn_valider_suivi_client">
                                <div id="label_btn_valid_suivi">
                                    VALIDER LE SUIVI
                                </div>
                                <div class="loader"></div> 
                            </button>
                        </div>                                               
                    </div>
                </div>
            </form>
            <button type="button" class="btn btn-outline-primary" id="btn_impact_form_client" onclick="functionShowHideFormImpact();">Impact de la formation</button> 
            <div class="form-group" id="form_impact_client"> 
                <h5 id="titre_form_impact_formation1">EVALUATION DES IMPACTS « A FROID » PAR L’ENTREPRISE</h5>
                <p><h5>Il y a environs 3 mois de cela, un ou plusieurs de vos salariés ont suivi une formation dispensée par notre organisme de formation.<br> 
                Aujourd’hui nous souhaiterions connaître l’impact que celle-ci a eu sur la ou les personnes formées ainsi que pour votre entreprise.</h5><br>                
                Un de nos conseillers pédagogiques se chargera de prendre contact avec vous afin de faire le point ensemble de votre évaluation. Au préalable, merci de bien vouloir consacrer quelques instants à remplir ce questionnaire en prévision de cet entretien. </p>
                <div class="row">
                    <div class="offset-lg-1 col-lg-10" id="contenu_form_impact">
                        <form class="form-horizontal" method="POST" action="{{route('impact_formation')}}" id="form_eval_impact_client">
                            {{csrf_field()}}
                            <h5 id="titre_form_impact_formation1">INDENTIFICATION</h5>
                            <div class="form-group row">
                                <label for="input_nom_entreprise" class="offset-sm-2 col-sm-4 col-form-label">¤ ENTREPRISE</label>
                                <div class="col-sm-4">
                                    <input type="textarea" maxlength="50" name="nom_entreprise" class="form-control" id="input_nom_entreprise" placeholder="Identification :">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input_hierarchie_entreprise_id" class="offset-sm-2 col-sm-4 col-form-label">¤ HIERARCHIE</label>
                                <div class="col-sm-4">
                                    <input type="textarea" maxlength="50" name="hierarchie_entreprise_id" class="form-control" id="input_hierarchie_entreprise_id" placeholder="Nom/prénom :">
                                    <input type="textarea" maxlength="50" name="hierarchie_entreprise_fonction" class="form-control" id="input_hierarchie_entreprise_fonction" placeholder="Fonction :">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="input_formation_suivie" class="offset-sm-2 col-sm-4 col-form-label">¤ FORMATION SUIVIE</label>
                                <div class="col-sm-4">
                                    <select class="custom-select" id="inputGroupSelect011" name="nom_formation">
                                        <option selected disabled="true">Aucun sélectionné</option>

                                            @foreach($formations_terminees as $formation)

                                                <option selected value="{{$formation->id}}">{{$formation->nom}}</option>

                                            @endforeach    

                                    </select>
                                </div>       
                            </div>
                            <h5 id="titre_form_impact_formation">EVALUATION DES OBJECTIFS DE PROGRES FIXES LORS DU DIAGNOSTIC INITIAL</h5>
                            <div id="deuxieme_partie_form">                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="textarea" maxlength="100" name="objectif1" class="form-control" id="input_formation_suivie_duree" placeholder="Objectif 1">
                                    </div> 
                                    <div class="col-sm-3" id="btn_radio">
                                        <label for="input_nom_entreprise" class="col-form-label">Atteint</label>
                                        <input type="radio" name="radio1" value="atteint">
                                    </div>
                                    <div class="col-sm-3" id="btn_radio">
                                        <label for="input_nom_entreprise" class="col-form-label">Non atteint</label>
                                        <input type="radio" name="radio1" value="non atteint"> 
                                    </div>              
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="textarea" maxlength="100" name="objectif2" class="form-control" id="input_formation_suivie_duree" placeholder="Objectif 2">
                                    </div>
                                    <div class="col-sm-3" id="btn_radio">
                                    <label for="input_nom_entreprise" class="col-form-label">Atteint</label>
                                        <input type="radio" name="radio2" value="atteint">
                                    </div>
                                    <div class="col-sm-3" id="btn_radio">
                                        <label for="input_nom_entreprise" class="col-form-label">Non atteint</label>
                                        <input type="radio" name="radio2" value="non atteint"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="textarea" maxlength="100" name="objectif3" class="form-control" id="input_formation_suivie_duree" placeholder="Objectif 3">
                                    </div>
                                    <div class="col-sm-3" id="btn_radio">
                                        <label for="input_nom_entreprise" class="col-form-label">Atteint</label>
                                        <input type="radio" name="radio3" value="atteint">
                                    </div>
                                    <div class="col-sm-3" id="btn_radio">
                                        <label for="input_nom_entreprise" class="col-form-label">Non atteint</label>
                                        <input type="radio" name="radio3" value="non atteint"> 
                                    </div>                               
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <input type="textarea" maxlength="100" name="objectif4" class="form-control" id="input_formation_suivie_duree" placeholder="Objectif 4">
                                    </div> 
                                    <div class="col-sm-3" id="btn_radio">
                                        <label for="input_nom_entreprise" class="col-form-label">Atteint</label>
                                        <input type="radio" name="radio4" value="atteint">
                                    </div>
                                    <div class="col-sm-3" id="btn_radio">
                                        <label for="input_nom_entreprise" class="col-form-label">Non atteint</label>
                                        <input type="radio" name="radio4" value="non atteint"> 
                                    </div>                          
                                </div>
                            </div>
                            <h5 id="titre_form_impact_formation">INDICATEURS DE PROGRES QUANTITATIF</h5>
                            <h6 id="sous_titre_indicateurs">Ex : Nbre de non conformités sur une période, % de retours clients, nbre d’accidents du travail, nbre de salarié ayant suivi une formation …</h6>
                            <div id="troisieme_partie_form">
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <input type="textarea" rows="3" maxlength="50" name="indic1" class="form-control" id="input_formation_suivie_duree" placeholder="Indicateur 1...">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="textarea" rows="3" maxlength="50" name="constat1" class="form-control" id="input_formation_suivie_duree" placeholder="Constat initial...">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="textarea" rows="3" maxlength="50" name="result1" class="form-control" id="input_formation_suivie_duree" placeholder="Resultat attendu...">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="textarea" rows="3" maxlength="50" name="constat_final1" class="form-control" id="input_formation_suivie_duree" placeholder="Constat final...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <input type="textarea" rows="3" maxlength="50" name="indic2" class="form-control" id="input_formation_suivie_duree" placeholder="Indicateur 2...">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="textarea" rows="3" maxlength="50" name="constat2" class="form-control" id="input_formation_suivie_duree" placeholder="...">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="textarea" rows="3" maxlength="50" name="result2" class="form-control" id="input_formation_suivie_duree" placeholder="...">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="textarea" rows="3" maxlength="50" name="constat_final2" class="form-control" id="input_formation_suivie_duree" placeholder="...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <input type="textarea" rows="3" maxlength="50" name="indic3" class="form-control" id="input_formation_suivie_duree" placeholder="Indicateur 3...">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="textarea" rows="3" maxlength="50" name="constat3" class="form-control" id="input_formation_suivie_duree" placeholder="...">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="textarea" rows="3" maxlength="50" name="result3" class="form-control" id="input_formation_suivie_duree" placeholder="...">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="textarea" rows="3" maxlength="50" name="constat_final3" class="form-control" id="input_formation_suivie_duree" placeholder="...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <input type="textarea" rows="3" maxlength="50" name="indic4" class="form-control" id="input_formation_suivie_duree" placeholder="Indicateur 4...">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="textarea" rows="3" maxlength="50" name="constat4" class="form-control" id="input_formation_suivie_duree" placeholder="...">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="textarea" rows="3" maxlength="50" name="result4" class="form-control" id="input_formation_suivie_duree" placeholder="...">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="textarea" rows="3" maxlength="50" name="constat_final4" class="form-control" id="input_formation_suivie_duree" placeholder="...">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-5">
                                        <input type="textarea" rows="3" maxlength="50" name="indic5" class="form-control" id="input_formation_suivie_duree" placeholder="Indicateur 5...">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="textarea" rows="3" maxlength="50" name="constat5" class="form-control" id="input_formation_suivie_duree" placeholder="...">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="textarea" rows="3" maxlength="50" name="result5" class="form-control" id="input_formation_suivie_duree" placeholder="...">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="textarea" rows="3" maxlength="50" name="constat_final5" class="form-control" id="input_formation_suivie_duree" placeholder="...">
                                    </div>
                                </div>
                                <h5 id="titre_form_impact_formation">INDICATEURS DE PROGRES QUALITATIFS </h5> 
                                <h6 id="sous_titre_indicateurs">cochez « sans objet », par exemple, si les salariés ne sont pas concernés, s’ils n’ont pas l’occasion de mettre en œuvre cette compétence ou si vous n’êtes pas en mesure d’observer des évolutions...</h6>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <h5 id="indic_quali">Organisation du travail et cohésion d’équipe</h5>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Peu ou pas d’évolution</label>
                                        <input type="radio" name="evol1" value="peu ou pas evolution">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">En progression</label>
                                        <input type="radio" name="evol1" value="en progression">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">Nette évolution</label>
                                        <input type="radio" name="evol1" value="nette evolution">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">Sans objet</label>
                                        <input type="radio" name="evol1" value="sans objet">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <h5 id="indic_quali">Sécurité au travail (respect de règles, accidents du travail…)</h5>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Peu ou pas d’évolution</label>
                                        <input type="radio" name="evol2" value="peu ou pas d'évolution">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">En progression</label>
                                        <input type="radio" name="evol2" value="en progression">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">Nette évolution</label>
                                        <input type="radio" name="evol2" value="nette évolution">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">Sans objet</label>
                                        <input type="radio" name="evol2" value="sans objet">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <h5 id="indic_quali">Utilisation des supports écrits professionnels</h5>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Peu ou pas d’évolution</label>
                                        <input type="radio" name="evol3" value="peu ou pas d'évolution">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">En progression</label>
                                        <input type="radio" name="evol3" value="en progression">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">Nette évolution</label>
                                        <input type="radio" name="evol3" value="nette évolution">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">Sans objet</label>
                                        <input type="radio" name="evol3" value="sans objet">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <h5 id="indic_quali">Respect des normes qualité et environnemental</h5>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Peu ou pas d’évolution</label>
                                        <input type="radio" name="evol4" value="peu ou pas d'évolution">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">En progression</label>
                                        <input type="radio" name="evol4" value="en progression">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">Nette évolution</label>
                                        <input type="radio" name="evol4" value="nette évolution">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">Sans objet</label>
                                        <input type="radio" name="evol4" value="sans objet">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <h5 id="indic_quali">Qualité de la relation client / usager</h5>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Peu ou pas d’évolution</label>
                                        <input type="radio" name="evol5" value="peu ou pas d'évolution">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">En progression</label>
                                        <input type="radio" name="evol5" value="en progression">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">Nette évolution</label>
                                        <input type="radio" name="evol5" value="nette évolution">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">Sans objet</label>
                                        <input type="radio" name="evol5" value="sans objet">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <h5 id="indic_quali">Fidélisation et/ou maintien dans l’emploi</h5>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="col-form-label">Peu ou pas d’évolution</label>
                                        <input type="radio" name="evol6" value="peu ou pas d'évolution">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">En progression</label>
                                        <input type="radio" name="evol6" value="en progression">
                                    </div>
                                    <div class="col-sm-2">
                                    <label class="col-form-label">Nette évolution</label>
                                        <input type="radio" name="evol6" value="nette évolution">
                                    </div>
                                    <div class="col-sm-2">
                                        <label class="col-form-label">Sans objet</label>
                                        <input type="radio" name="evol6" value="sans objet">
                                    </div>
                                </div>                             
                            </div>
                            <button type="submit" id="btn_valider_impact_formation" class="btn btn-outline-primary"> 
                                <div id="label_btn_valid_eval">
                                    VALIDER L'EVALUATION
                                </div>
                                <div class="loader"></div> 
                            </button>
                        </form>
                    </div>
                </div> 
            </div>                                              
        </div>
    </div>
</div>
@endsection