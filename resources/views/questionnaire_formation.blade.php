@extends('layouts.menu')

@section('content')
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
    <div class="offset-lg-3 col-lg-6 col-md-10 col-sm-12">
        <h3 id="titre_questionnaire_formateur">
            COMPTE RENDU DE FORMATION
        </h3>
    </div>
</div>
<div class="container" id="container_questionnaire_auto_evaluation">
    <form class="form-horizontal" method="POST" action="{{ route('send_compte_rendu_formarteur')}}">
    {{ csrf_field() }}
        <div class="row">
            <div class="offset-lg-3 col-lg-6" id="input_formation_quest_formateur">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Groupe de formation à évaluer</span>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01" name="nom_formation">
                        <option selected>Aucun sélectionné</option>

                            @foreach($formations as $formation)

                                <option selected value="{{$formation->id}}">{{$formation->nom}}</option>

                            @endforeach    

                    </select>
                </div>
            </div>
        </div>
        <div class="row" id="contenu_form_questionnaire_autoeval">
            <div class="col-lg-12">
                <div class="row">
                    <div class="offset-lg-1 col-lg-10" id="section_auto_eval">              
                        <h4 id="titre_auto_eval">1/ Auto évaluation</h4>
                        <div class="form-group">
                            <h5 id="label_eval_perf" class="">¤ Evaluez votre performance durant cette session</h5>
                            <div class="offset-lg-1 col-lg-10">
                                <li class="list-group-item" id="question_perf_form">
                                    <input type="radio" id="radioperf" name="radioPerf" value="1">1
                                    <input type="radio" id="radioperf" name="radioPerf" value="2">2
                                    <input type="radio" id="radioperf" name="radioPerf" value="3">3
                                    <input type="radio" id="radioperf" name="radioPerf" value="4">4
                                    <input type="radio" id="radioperf" name="radioPerf" value="5">5
                                </li>                 
                            </div>
                        </div>
                        <div class="form-group">
                            <h5 id="label_eval_perf" class="">¤ Avez vous atteint les objectifs du séminaire ?</h5>
                            <h6 id="sous_label_objectif_sem" class="">(Si oui, quels sont les éléments qui vous permette de l'affirmer ?</h6>
                            <h6 id="sous_label_objectif_sem1" class="">Si non, pour quelles raisons ? Qu’auriez-vous dû faire ?)</h6>
                            <div class="offset-lg-2 col-lg-8">
                                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="200 caractères max" rows="5" name="contenu_objectif_atteint_ou_non" maxlength="200"></textarea>                
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="row">
                    <div class="offset-lg-1 col-lg-10" id="section_auto_eval">              
                        <h4 id="titre_auto_eval">2/ Contenu et Pédagogie</h4>
                        <div class="form-group">
                            <h5 id="label_eval_perf" class="">¤ Avez-vous apporté des modifications significatives (déroulé, contenu, timing, supports, outils) ?</h5>
                            <h6 id="sous_label_objectif_sem" class="">(Si oui lesquelles ? Si non, saisissez "non")</h6>
                            <div class="offset-lg-2 col-lg-8">
                                <textarea class="form-control" id="exampleFormControlTextarea2" placeholder="200 caractères max" rows="5" name="contenu_modifs"
                                maxlength="200"></textarea>                
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="row">
                    <div class="offset-lg-1 col-lg-10" id="section_materiel_logistique">              
                        <h4 id="titre_auto_eval">3/ Matériel et logistique</h4>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <h5 id="label_quest_matos" class="">¤ Matériel d'animation</h5>
                                    <div class="offset-lg-1 col-lg-10">
                                        <li class="list-group-item" id="questions_matos">
                                            <input type="radio" id="radioperf" name="matos_anim" value="bon">Bon
                                            <input type="radio" id="radioperf" name="matos_anim" value="pas bon">Pas bon   
                                        </li>                 
                                    </div>
                                    <h5 id="label_quest_matos" class="">¤ Supports Animateurs</h5>
                                    <div class="offset-lg-1 col-lg-10">
                                        <li class="list-group-item" id="questions_matos">
                                            <input type="radio" id="radioperf" name="supports" value="bon">Bon
                                            <input type="radio" id="radioperf" name="supports" value="pas bon">Pas bon   
                                        </li>                 
                                    </div>
                                    <h5 id="label_quest_matos" class="">¤ Documents Participants</h5>
                                    <div class="offset-lg-1 col-lg-10">
                                        <li class="list-group-item" id="questions_matos">
                                            <input type="radio" id="radioperf" name="doc_partici" value="bon">Bon
                                            <input type="radio" id="radioperf" name="doc_partici" value="pas bon">Pas bon   
                                        </li>                 
                                    </div>
                                    <h5 id="label_quest_matos" class="">¤ Accès au lieu de formation</h5>
                                    <div class="offset-lg-1 col-lg-10">
                                        <li class="list-group-item" id="questions_matos">
                                            <input type="radio" id="radioperf" name="acces" value="bon">Bon
                                            <input type="radio" id="radioperf" name="acces" value="pas bon">Pas bon   
                                        </li>                 
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h5 id="label_quest_matos" class="">¤ Salles</h5>
                                <div class="offset-lg-1 col-lg-10">
                                    <li class="list-group-item" id="questions_matos">
                                        <input type="radio" id="radioperf" name="salles" value="bon">Bon
                                        <input type="radio" id="radioperf" name="salles" value="pas bon">Pas bon   
                                    </li>                 
                                </div>
                                <h5 id="label_quest_matos" class="">¤ Mobilier</h5>
                                <div class="offset-lg-1 col-lg-10">
                                    <li class="list-group-item" id="questions_matos">
                                        <input type="radio" id="radioperf" name="mobilier" value="bon">Bon
                                        <input type="radio" id="radioperf" name="mobilier" value="pas bon">Pas bon   
                                    </li>                 
                                </div>
                                <h5 id="label_quest_matos" class="">¤ Accueil</h5>
                                <div class="offset-lg-1 col-lg-10">
                                    <li class="list-group-item" id="questions_matos">
                                        <input type="radio" id="radioperf" name="accueil" value="bon">Bon
                                        <input type="radio" id="radioperf" name="accueil" value="pas bon">Pas bon   
                                    </li>                 
                                </div>
                                <h5 id="label_quest_matos" class="">¤ Pauses</h5>
                                <div class="offset-lg-1 col-lg-10">
                                    <li class="list-group-item" id="questions_matos">
                                        <input type="radio" id="radioperf" name="pauses" value="bon">Bon
                                        <input type="radio" id="radioperf" name="pauses" value="pas bon">Pas bon   
                                    </li>                 
                                </div>
                            </div>
                        </div> 
                        <div class="row">  
                            <div class="offset-lg-3 col-lg-6">
                                <h5 id="label_quest_matos" class="">¤ Repas</h5>
                                <div class="offset-lg-3 col-lg-6">
                                    <li class="list-group-item" id="questions_matos">
                                        <input type="radio" id="radioperf" name="repas" value="bon">Bon
                                        <input type="radio" id="radioperf" name="repas" value="pas bon">Pas bon   
                                    </li>                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="offset-lg-1 col-lg-10" id="section_et_demain">              
                        <h4 id="titre_auto_eval">4/ Contenu et Pédagogie</h4>
                        <div class="form-group">
                            <h5 id="label_eval_perf" class="">¤  D’une manière générale, quelles sont vos idées, vos suggestions pour améliorer et développer ensemble notre efficacité ?</h5>
                            <div class="offset-lg-2 col-lg-8">
                                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="200 caractères max" rows="5" name="contenu_suggestions" maxlength="200"></textarea>                
                            </div>
                        </div>    
                    </div>                  
                </div>
                <div class="row">
                    <div class="col-lg-12" id="section_validation">              
                        <button type="submit" id="btn_validation_form_formateur" class="btn btn-outline-primary">Valider le questionnaire</button>  
                    </div>  
                </div>    
            </div>
        </div>
    </form>
</div>
@endsection