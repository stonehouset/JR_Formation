@extends('layouts.menu')

@section('content') 
<body>
    <div class="panel-body" id="body_interface_apprenant">
        <div class="container" id="btns_nav_apprenants">
            <div class="row">
                <div class="offset-lg-1 col-lg-10">
                    <button type="button" id="btn_apprenant_programme" class="btn btn-outline-primary">Programme</button>
                    <button type="button" id="btn_questionnaires" class="btn btn-outline-primary">Questionnaires</button>
                    <button type="button" id="btn_apprenant_com_fin_sem" class="btn btn-outline-primary">Commentaires</button>
                </div>
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
        <div class="row" id="btns_questionnaires">
            <div class="offset-lg-3 col-lg-6">
                <button type="button" id="btn_apprenant_quest_formation" class="btn btn-outline-primary">Evaluation Formation</button>
                <button type="button" id="btn_apprenant_quest_formateur" class="btn btn-outline-primary">Evaluation Formateur</button>
            </div>
        </div>
        <div id="form_satisfaction_formateur">  
        @if ($dateNow < $dateFinForm)
            <h4 style="color: white;text-align: center;">Les questionnaires seront disponibles à partir du dernier jour de formation, le{{\Carbon\Carbon::parse($dateFinForm)->format('d/m/Y')}}</h4>
        @endif
        @if ($dateNow >= $dateFinForm)
            <h3 id="titre_form_formateur_app">Evaluation du formateur</h3>
            <h5 id="sous_titre_form_formateur_app">Pour chaque question, le système de notation est le suivant : </h5>  
            <label id="label_form_formateur1"><input type="radio" disabled="true">Médiocre</label>
            <label id="label_form_formateur2"><input type="radio" disabled="true">Faible</label>
            <label id="label_form_formateur3"><input type="radio" disabled="true">Satisfaisant</label>
            <label id="label_form_formateur4"><input type="radio" disabled="true">Excellent</label>       
            <form class="form-horizontal" method="POST" action="{{ route('send_form_formateur_apprenant') }}" id="form_quest_formateur_app">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-group">
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                <h6>{{$evalFormateur->champ1}}</h6>
                                <input type="radio" name="radio1" value="mediocre">
                                <input type="radio" name="radio1" value="faible">
                                <input type="radio" name="radio1" value="satisfaisant">
                                <input type="radio" name="radio1" value="excellent">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                <h6>{{$evalFormateur->champ2}}</h6>
                                <input type="radio" name="radio2" value="mediocre">
                                <input type="radio" name="radio2" value="faible">
                                <input type="radio" name="radio2" value="satisfaisant">
                                <input type="radio" name="radio2" value="excellent">
                                  
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                <h6>{{$evalFormateur->champ3}}</h6>
                                <input type="radio" name="radio3" value="mediocre">
                                <input type="radio" name="radio3" value="faible">
                                <input type="radio" name="radio3" value="satisfaisant">
                                <input type="radio" name="radio3" value="excellent">       
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                <h6>{{$evalFormateur->champ4}}</h6> 
                                <input type="radio" name="radio4" value="mediocre">
                                <input type="radio" name="radio4" value="faible">
                                <input type="radio" name="radio4" value="satisfaisant">
                                <input type="radio" name="radio4" value="excellent"> 
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                <h6>{{$evalFormateur->champ5}}</h6>
                                <input type="radio" name="radio5" value="mediocre">
                                <input type="radio" name="radio5" value="faible">
                                <input type="radio" name="radio5" value="satisfaisant">
                                <input type="radio" name="radio5" value="excellent">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                <h6>{{$evalFormateur->champ6}}</h6> 
                                <input type="radio" name="radio6" value="mediocre">
                                <input type="radio" name="radio6" value="faible">
                                <input type="radio" name="radio6" value="satisfaisant">
                                <input type="radio" name="radio6" value="excellent">      
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                <h6>{{$evalFormateur->champ7}}</h6>
                                <input type="radio" name="radio7" value="mediocre">
                                <input type="radio" name="radio7" value="faible">
                                <input type="radio" name="radio7" value="satisfaisant">
                                <input type="radio" name="radio7" value="excellent">      
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                <h6>{{$evalFormateur->champ8}}</h6>
                                <input type="radio" name="radio8" value="mediocre">
                                <input type="radio" name="radio8" value="faible">
                                <input type="radio" name="radio8" value="satisfaisant">
                                <input type="radio" name="radio8" value="excellent">       
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormateur->champ9}}
                                <br>
                                <input type="radio" name="radio9" value="mediocre">
                                <input type="radio" name="radio9" value="faible">
                                <input type="radio" name="radio9" value="satisfaisant">
                                <input type="radio" name="radio9" value="excellent">
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-group">
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormateur->champ10}} 
                                <br>
                                <input type="radio" name="radio10" value="mediocre">
                                <input type="radio" name="radio10" value="faible">
                                <input type="radio" name="radio10" value="satisfaisant">
                                <input type="radio" name="radio10" value="excellent">                           
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormateur->champ11}}
                                <br>
                                <input type="radio" name="radio11" value="mediocre">
                                <input type="radio" name="radio11" value="faible">
                                <input type="radio" name="radio11" value="satisfaisant">
                                <input type="radio" name="radio11" value="excellent">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormateur->champ12}}
                                <br>
                                <input type="radio" name="radio12" value="mediocre">
                                <input type="radio" name="radio12" value="faible">
                                <input type="radio" name="radio12" value="satisfaisant">
                                <input type="radio" name="radio12" value="excellent">                           
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormateur->champ13}}
                                <br>
                                <input type="radio" name="radio13" value="mediocre">
                                <input type="radio" name="radio13" value="faible">
                                <input type="radio" name="radio13" value="satisfaisant">
                                <input type="radio" name="radio13" value="excellent">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormateur->champ14}}
                                <br>
                                <input type="radio" name="radio14" value="mediocre">
                                <input type="radio" name="radio14" value="faible">
                                <input type="radio" name="radio14" value="satisfaisant">
                                <input type="radio" name="radio14" value="excellent">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormateur->champ15}}
                                <br>
                                <input type="radio" name="radio15" value="mediocre">
                                <input type="radio" name="radio15" value="faible">
                                <input type="radio" name="radio15" value="satisfaisant">
                                <input type="radio" name="radio15" value="excellent">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormateur->champ16}}
                                <br>
                                <input type="radio" name="radio16" value="mediocre">
                                <input type="radio" name="radio16" value="faible">
                                <input type="radio" name="radio16" value="satisfaisant">
                                <input type="radio" name="radio16" value="excellent">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormateur->champ17}}
                                <br>
                                <input type="radio" name="radio17" value="mediocre">
                                <input type="radio" name="radio17" value="faible">
                                <input type="radio" name="radio17" value="satisfaisant">
                                <input type="radio" name="radio17" value="excellent">        
                            </li> 
                        </ul>
                        <button type="submit" id="btn_validation_form_formateur" class="btn btn-outline-primary">
                            <div id="label_btn_valid_quest_formateur">
                                Valider le questionnaire
                            </div>
                            <div class="loader"></div>
                        </button> 
                    </div>
                </div>
            </form>
        @endif 
        </div>
        <div id="form_satisfaction_formation">  
        @if ($dateNow < $dateFinForm)
            <h4 style="color: white;text-align: center;">Les questionnaires seront disponibles à partir du dernier jour de formation, le {{\Carbon\Carbon::parse($dateFinForm)->format('d/m/Y')}}</h4>
        @endif
        @if ($dateNow >= $dateFinForm)  
            <h3 id="titre_form_formation_app">Evaluation de la formation</h3>
            <h5 id="sous_titre_form_formation_app">Pour chaque question, le système de notation est le suivant : </h5>  
            <label id="label_form_formation1"><input type="radio" disabled="true">Médiocre</label>
            <label id="label_form_formation2"><input type="radio" disabled="true">Faible</label>
            <label id="label_form_formation3"><input type="radio" disabled="true">Satisfaisant</label>
            <label id="label_form_formation4"><input type="radio" disabled="true">Excellent</label> 
            <form class="form-horizontal" method="POST" action="{{ route('send_form_formation_apprenant') }}" id="form_quest_formation_app">
            {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-group">
                        <strong id="titre_form_info_contenu_obj"><h4>Contenu et objectifs</h4></strong>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ1}}
                                <br>
                                <input type="radio" name="radio9" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio9" value="faible" id="checkbox_2">
                                <input type="radio" name="radio9" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio9" value="excellent" id="checkbox_4"> 
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ2}}
                                <br>
                                <input type="radio" name="radio10" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio10" value="faible" id="checkbox_2">
                                <input type="radio" name="radio10" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio10" value="excellent" id="checkbox_4">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ3}}
                                <br>
                                <input type="radio" name="radio11" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio11" value="faible" id="checkbox_2">
                                <input type="radio" name="radio11" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio11" value="excellent" id="checkbox_4">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ4}}
                                <br>
                                <input type="radio" name="radio12" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio12" value="faible" id="checkbox_2">
                                <input type="radio" name="radio12" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio12" value="excellent" id="checkbox_4">
                            </li>
                        </ul>
                        <ul class="list-group">
                        <strong id="titre_form_info_peda"><h4>Pédagogie</h4></strong>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ5}}
                                <br>
                                <input type="radio" name="radio13" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio13" value="faible" id="checkbox_2">
                                <input type="radio" name="radio13" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio13" value="excellent" id="checkbox_4">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ6}}
                                <br>
                                <input type="radio" name="radio14" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio14" value="faible" id="checkbox_2">
                                <input type="radio" name="radio14" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio14" value="excellent" id="checkbox_4">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ7}}
                                <br>
                                <input type="radio" name="radio15" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio15" value="faible" id="checkbox_2">
                                <input type="radio" name="radio15" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio15" value="excellent" id="checkbox_4">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ8}}
                                <br>
                                <input type="radio" name="radio16" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio16" value="faible" id="checkbox_2">
                                <input type="radio" name="radio16" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio16" value="excellent" id="checkbox_4">
                            </li>
                        </ul>
                        <ul class="list-group">
                        <strong id="titre_form_info_peda2"><h4>Dynamique de groupe</h4></strong>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ9}}
                                <br>
                                <input type="radio" name="radio17" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio17" value="faible" id="checkbox_2">
                                <input type="radio" name="radio17" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio17" value="excellent" id="checkbox_4">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ10}}
                                <br>
                                <input type="radio" name="radio18" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio18" value="faible" id="checkbox_2">
                                <input type="radio" name="radio18" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio18" value="excellent" id="checkbox_4">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ11}}
                                <br>
                                <input type="radio" name="radio19" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio19" value="faible" id="checkbox_2">
                                <input type="radio" name="radio19" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio19" value="excellent" id="checkbox_4">
                            </li>
                        </ul>
                    </div> 
                    <div class="col-lg-6">
                        <ul class="list-group">
                            <strong id="titre_form_info_recrut"><h4>Informations recrutement</h4></strong>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ12}}
                                <br>
                                <input type="radio" name="radio1" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio1" value="faible" id="checkbox_2">
                                <input type="radio" name="radio1" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio1" value="excellent" id="checkbox_4">      
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ13}}
                                <br>
                                <input type="radio" name="radio2" value="mediocre" id="checkbox_5">
                                <input type="radio" name="radio2" value="faible" id="checkbox_6">
                                <input type="radio" name="radio2" value="satisfaisant" id="checkbox_7">
                                <input type="radio" name="radio2" value="excellent" id="checkbox_8">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ14}}
                                <br>
                                <input type="radio" name="radio3" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio3" value="faible" id="checkbox_2">
                                <input type="radio" name="radio3" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio3" value="excellent" id="checkbox_4">                          
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ15}}
                                <br>
                                <input type="radio" name="radio4" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio4" value="faible" id="checkbox_2">
                                <input type="radio" name="radio4" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio4" value="excellent" id="checkbox_4">                          
                            </li>
                        </ul>
                        <ul class="list-group">
                        <strong id="titre_form_info_enviro_form"><h4>Environnement de l'Organisme de Formation</h4></strong>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ16}}
                                <br>
                                <input type="radio" name="radio5" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio5" value="faible" id="checkbox_2">
                                <input type="radio" name="radio5" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio5" value="excellent" id="checkbox_4">                          
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ17}}
                                <br>
                                <input type="radio" name="radio6" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio6" value="faible" id="checkbox_2">
                                <input type="radio" name="radio6" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio6" value="excellent" id="checkbox_4">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ18}}
                                <br>
                                <input type="radio" name="radio7" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio7" value="faible" id="checkbox_2">
                                <input type="radio" name="radio7" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio7" value="excellent" id="checkbox_4">
                            </li>
                            <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                                {{$evalFormation->champ19}}
                                <br>
                                <input type="radio" name="radio8" value="mediocre" id="checkbox_1">
                                <input type="radio" name="radio8" value="faible" id="checkbox_2">
                                <input type="radio" name="radio8" value="satisfaisant" id="checkbox_3">
                                <input type="radio" name="radio8" value="excellent" id="checkbox_4"> 
                            </li>
                        </ul>
                        <textarea class="form-control" id="input_text_com_1" maxlength="200" required name="commentaires_eval" rows="2" style="margin-top: 1%;" placeholder="{{$evalFormation->champ20}}"></textarea>
                        <textarea class="form-control" id="input_text_com_1" maxlength="200" required name="apprecie_eval" rows="2" style="margin-top: 1%;" placeholder="{{$evalFormation->champ21}}"></textarea>
                        <textarea class="form-control" id="input_text_com_1" maxlength="200" required name="sugg_amelio" rows="2" style="margin-top: 1%;" placeholder="{{$evalFormation->champ22}}"></textarea>
                        <ul class="list-group">
                            <h5 style="color: white;text-align: center;width: 100%;margin-top: 1%;">Attribuer une note à la formation</h5>;
                            <input id="note_formation" type="number" class="form-control" required name="note_formation" value="" min="0" max="20" required style="width: 50%;margin-left: auto;margin-right: auto;" placeholder="/20">
                        </ul>
                        <button type="submit" id="btn_validation_form_formation" class="btn btn-outline-primary">
                            <div id="label_btn_valid_quest_formation">
                                Valider le questionnaire
                            </div>
                            <div class="loader"></div>
                        </button>
                    </div>
                </div>
            </form> 
        @endif      
        </div> 
        <div class="row" id="form_com_semaine_apprenant" style="margin-top: 2%;">
            <div class="offset-lg-3 col-lg-6 col-md-12"> 
                @if ($dateNow < $datePlus4Jours)
                    <h4 style="color: white;text-align: center;">Revenez le {{\Carbon\Carbon::parse($datePlus4Jours)->format('d/m/Y')}} pour remplir votre premier commentaire!</h4>
                @endif
                @if ($dateNow >= $datePlus4Jours and $apprenant->commentaire_semaine1 == null)
                    <form class="form-horizontal" method="POST" action="{{ route('comFormSem1') }}" id="com_sem1">
                    {{ csrf_field() }} 
                        <div class="form-group">
                            <div id="btn_disabled_validation_com1_formation">Commentaire première semaine</div>
                            <textarea class="form-control" id="input_text_com_1" maxlength="250"  required name="com_apprenant_sem1" rows="6" style="margin-top: 2%;" placeholder="Ecrivez votre ressenti sur votre première semaine de formation (250 caractères maximum)."></textarea>
                        </div>
                        <button type="submit" id="btn_validation_com1_formation" class="btn btn-outline-primary">
                            <div id="label_btn_valid_com1">
                                Valider
                            </div>
                            <div class="loader"></div>
                        </button>
                    </form>
                @endif
                @if ($apprenant->commentaire_semaine1 != null and $dateNow < $datePlusOnzeJours and $interval >= 11)

                    <h4 style="color: white;text-align: center;">Revenez le {{\Carbon\Carbon::parse($datePlusOnzeJours)->format('d/m/Y')}} pour remplir votre deuxième commentaire!</h4>

                @endif
                @if ($apprenant->commentaire_semaine1 != null and $dateNow >= $datePlusOnzeJours and $apprenant->commentaire_semaine2 == null and $interval >= 11)  
                    <form class="form-horizontal" method="POST" action="{{ route('comFormSem2') }}" id="com_sem2">
                    {{ csrf_field() }} 
                        <div class="form-group">
                            <div id="btn_disabled_validation_com2_formation">Commentaire deuxième semaine</div>
                            <textarea class="form-control" id="input_text_com_2" rows="6" maxlength="250" required name="com_apprenant_sem2" style="margin-top: 2%;" placeholder="Ecrivez votre ressenti sur votre deuxième semaine de formation (250 caractères maximum)."></textarea>
                        </div>  
                        <button type="submit" id="btn_validation_com2_formation" class="btn btn-outline-primary">
                            <div id="label_btn_valid_com2">
                                Valider
                            </div>
                            <div class="loader"></div>
                        </button>
                    </form>
                @endif
                @if ($apprenant->commentaire_semaine2 != null and $dateNow < $datePlus18Jours and $interval >= 18)

                    <h4 style="color: white;text-align: center;">Revenez le {{\Carbon\Carbon::parse($datePlus18Jours)->format('d/m/Y')}} pour remplir votre troisième commentaire!</h4>

                @endif
                @if ($apprenant->commentaire_semaine2 != null and $dateNow >= $datePlus18Jours and $apprenant->commentaire_semaine3 == null and $interval >= 18)
                
                    <form class="form-horizontal" method="POST" action="{{ route('comFormSem3') }}" id="com_sem3">
                    {{ csrf_field() }} 
                        <div class="form-group">
                            <div id="btn_disabled_validation_com3_formation">Commentaire troisième semaine</div>
                            <textarea class="form-control" id="input_text_com_3" rows="6" maxlength="250" required name="com_apprenant_sem3" style="margin-top: 2%;" placeholder="Ecrivez votre ressenti sur votre troisième semaine de formation (250 caractères maximum)."></textarea>
                        </div>  
                        <button type="submit" id="btn_validation_com3_formation" class="btn btn-outline-primary">
                            <div id="label_btn_valid_com3">
                                Valider
                            </div>
                            <div class="loader"></div>
                        </button>
                    </form>
                @endif
                @if ($apprenant->commentaire_semaine1 != null and $apprenant->commentaire_semaine2 != null and $interval < 18)

                    <h4 id="merci1">Merci pour votre participation!</h4>

                @endif
                @if ($apprenant->commentaire_semaine1 != null and $apprenant->commentaire_semaine2 != null and $apprenant->commentaire_semaine3 != null)

                    <h4 id="merci2">Merci pour votre participation!</h4>

                @endif
            </div>
        </div>
        <div class="container">
            <div class="row" id="programme_form_pdf" style="margin-top: 2%;">
                <div class="offset-lg-2 col-lg-8">
                    <form class="form-horizontal" method="GET" action="{{ route('downloadPdf') }}">
                    {{ csrf_field() }}
                        <br>
                        <button class="btn btn-outline-primary" id="btn_download_programme" type="submit">Téléchargez le programme</button>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</body>
@endsection