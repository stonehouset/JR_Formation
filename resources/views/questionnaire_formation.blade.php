@extends('layouts.menu')

@section('content')
<body>
    <div class="container">
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
        <div class="row" id="row_titre_compte_rendu">
            <div class="offset-lg-3 col-lg-6">
                <h3 id="titre_questionnaire_formateur">
                    Compte Rendu de Formation
                </h3>
            </div>
        </div>
        <div class="row">
            <form method="POST" action="{{ route('send_compte_rendu_formarteur')}}" id="form_compte_rendu">
            {{ csrf_field() }}
                @if ($formations == null)
                    <h5>Le compte rendu est disponible à partir du dernier jour de formation</h5>
                @endif
                @if ($formations != null)
                    <div class="offset-lg-3 col-lg-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic_gr">Pour le groupe :</span>
                            </div>
                            <select class="custom-select" required id="select_groupe_eval" name="nom_formation">
                                <option selected disabled="">Aucun sélectionné</option>
                                    @foreach($formations as $formation)

                                        <option value="{{$formation->id}}">{{$formation->nom}}</option>

                                    @endforeach    
                            </select>
                        </div>
                    </div>
                @endif
                <div class="col-lg-12" id="contenu_form_questionnaire_autoeval">
                    <div class="row">
                        <div class="offset-lg-1 col-lg-10" id="section_auto_eval">              
                            <h4 id="titre_auto_eval">{{$autoEval->champ1}}</h4>
                            <div class="form-group">
                                <h5 id="label_eval_perf" class="">{{$autoEval->champ2}}</h5>
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
                                <h5 id="label_eval_perf" class="">{{$autoEval->champ3}}</h5>
                                <h6 id="sous_label_objectif_sem" class="">{{$autoEval->champ4}}</h6>
                                <div class="offset-lg-2 col-lg-8">
                                    <textarea class="form-control" required id="exampleFormControlTextarea1" placeholder="200 caractères max" rows="5" name="contenu_objectif_atteint_ou_non" maxlength="200"></textarea>                
                                </div>
                            </div>   
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-lg-1 col-lg-10" id="section_auto_eval">              
                            <h4 id="titre_auto_eval">{{$autoEval->champ5}}</h4>
                            <div class="form-group">
                                <h5 id="label_eval_perf" class="">{{$autoEval->champ6}}</h5>
                                <h6 id="sous_label_objectif_sem" class="">{{$autoEval->champ7}}</h6>
                                <div class="offset-lg-2 col-lg-8">
                                    <textarea class="form-control" required id="exampleFormControlTextarea2" placeholder="200 caractères max" rows="5" name="contenu_modifs" maxlength="200"></textarea>                
                                </div>
                            </div>   
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-lg-1 col-lg-10" id="section_materiel_logistique">              
                            <h4 id="titre_auto_eval">{{$autoEval->champ8}}</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <h5 id="label_quest_matos" class="">{{$autoEval->champ9}}</h5>
                                        <div class="offset-lg-1 col-lg-10">
                                            <li class="list-group-item" id="questions_matos">
                                                <input type="radio" id="radioperf" name="matos_anim" value="bon">Bon
                                                <input type="radio" id="radioperf" name="matos_anim" value="pas bon">Pas bon   
                                            </li>                 
                                        </div>
                                        <h5 id="label_quest_matos" class="">{{$autoEval->champ10}}</h5>
                                        <div class="offset-lg-1 col-lg-10">
                                            <li class="list-group-item" id="questions_matos">
                                                <input type="radio" id="radioperf" name="supports" value="bon">Bon
                                                <input type="radio" id="radioperf" name="supports" value="pas bon">Pas bon   
                                            </li>                 
                                        </div>
                                        <h5 id="label_quest_matos" class="">{{$autoEval->champ11}}</h5>
                                        <div class="offset-lg-1 col-lg-10">
                                            <li class="list-group-item" id="questions_matos">
                                                <input type="radio" id="radioperf" name="doc_partici" value="bon">Bon
                                                <input type="radio" id="radioperf" name="doc_partici" value="pas bon">Pas bon   
                                            </li>                 
                                        </div>
                                        <h5 id="label_quest_matos" class="">{{$autoEval->champ12}}</h5>
                                        <div class="offset-lg-1 col-lg-10">
                                            <li class="list-group-item" id="questions_matos">
                                                <input type="radio" id="radioperf" name="acces" value="bon">Bon
                                                <input type="radio" id="radioperf" name="acces" value="pas bon">Pas bon   
                                            </li>                 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h5 id="label_quest_matos" class="">{{$autoEval->champ13}}</h5>
                                    <div class="offset-lg-1 col-lg-10">
                                        <li class="list-group-item" id="questions_matos">
                                            <input type="radio" id="radioperf" name="salles" value="bon">Bon
                                            <input type="radio" id="radioperf" name="salles" value="pas bon">Pas bon   
                                        </li>                 
                                    </div>
                                    <h5 id="label_quest_matos" class="">{{$autoEval->champ14}}</h5>
                                    <div class="offset-lg-1 col-lg-10">
                                        <li class="list-group-item" id="questions_matos">
                                            <input type="radio" id="radioperf" name="mobilier" value="bon">Bon
                                            <input type="radio" id="radioperf" name="mobilier" value="pas bon">Pas bon   
                                        </li>                 
                                    </div>
                                    <h5 id="label_quest_matos" class="">{{$autoEval->champ15}}</h5>
                                    <div class="offset-lg-1 col-lg-10">
                                        <li class="list-group-item" id="questions_matos">
                                            <input type="radio" id="radioperf" name="accueil" value="bon">Bon
                                            <input type="radio" id="radioperf" name="accueil" value="pas bon">Pas bon   
                                        </li>                 
                                    </div>
                                    <h5 id="label_quest_matos" class="">{{$autoEval->champ16}}</h5>
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
                                    <h5 id="label_quest_matos" class="">{{$autoEval->champ17}}</h5>
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
                            <h4 id="titre_auto_eval">{{$autoEval->champ18}}</h4>
                            <div class="form-group">
                                <h5 id="label_eval_perf" class="">{{$autoEval->champ19}}</h5>
                                <div class="offset-lg-2 col-lg-8">
                                    <textarea class="form-control" required id="exampleFormControlTextarea1" placeholder="200 caractères max" rows="5" name="contenu_suggestions" maxlength="200"></textarea>                
                                </div>
                            </div>    
                        </div>                  
                    </div>
                    <div class="row">
                        <div class="col-lg-12" id="section_validation">              
                            <button type="submit" id="btn_validation_form_formateur" class="btn btn-outline-primary">
                                <div id="label_btn_add_eval_form">
                                    Valider
                                </div>
                                <div class="loader"></div>
                            </button>  
                        </div>  
                    </div>    
                </div>
            </form>
        </div>
    </div>
</body>
@endsection