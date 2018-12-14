@extends('layouts.menu')

@section('content') 
<div class="panel-body" id="body_interface_apprenant">
    <button type="button" id="btn_apprenant_programme" class="btn btn-outline-primary">PROGRAMME</button>
    <button type="button" id="btn_questionnaires" class="btn btn-outline-primary">QUESTIONNAIRES</button>
    <button type="button" id="btn_apprenant_com_fin_sem" class="btn btn-outline-primary">COMMENTAIRES</button>
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
            <button type="button" id="btn_apprenant_quest_formation" class="btn btn-outline-primary">EVALUATION FORMATION</button>
            <button type="button" id="btn_apprenant_quest_formateur" class="btn btn-outline-primary">EVALUATION FORMATEUR</button>
        </div>
    </div>
    <div id="form_satisfaction_formateur">  
    @if ($dateNow < $dateFinForm)
        <h4 style="color: white;text-align: center;">Les questionnaires seront disponibles le {{\Carbon\Carbon::parse($dateFinForm)->format('d/m/Y')}}</h4>
    @endif
    @if ($dateNow >= $dateFinForm)
        <h3 style="color: white;">Evaluation du formateur</h3>
        <h5 style="color: white;">Pour chaque question, le système de notation est le suivant : </h5>  
        <label style="color: white;"><input type="radio" disabled="true">Médiocre</label>
        <label style="color: white;"><input type="radio" disabled="true">Faible</label>
        <label style="color: white;"><input type="radio" disabled="true">Satisfaisant</label>
        <label style="color: white;"><input type="radio" disabled="true">Excellent</label>       
        <form class="form-horizontal" method="POST" action="{{ route('send_form_formateur_apprenant') }}" id="form_quest_formateur_app">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-group">
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            <h6>Le formateur sait transmettre ses connaissances (maitrise son sujet, donne des exemples pratiques)</h6>
                            <input type="radio" name="radio1" value="mediocre">
                            <input type="radio" name="radio1" value="faible">
                            <input type="radio" name="radio1" value="satisfaisant">
                            <input type="radio" name="radio1" value="excellent">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            <h6>Le formateur sait mobiliser les participants (donne envie d'apprendre, fait participer)</h6>
                            <input type="radio" name="radio2" value="mediocre">
                            <input type="radio" name="radio2" value="faible">
                            <input type="radio" name="radio2" value="satisfaisant">
                            <input type="radio" name="radio2" value="excellent">
                              
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            <h6>Le formateur sait s'adapter à chaque participant (personnalise son message, s'adapte au contexte de chacun)</h6>
                            <input type="radio" name="radio3" value="mediocre">
                            <input type="radio" name="radio3" value="faible">
                            <input type="radio" name="radio3" value="satisfaisant">
                            <input type="radio" name="radio3" value="excellent">       
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            <h6>Le formateur a des points forts</h6> 
                            <input type="radio" name="radio4" value="mediocre">
                            <input type="radio" name="radio4" value="faible">
                            <input type="radio" name="radio4" value="satisfaisant">
                            <input type="radio" name="radio4" value="excellent"> 
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            <h6>Les supports utilisés en formation étaient utiles pour apprendre (documents, vidéos)</h6>
                            <input type="radio" name="radio5" value="mediocre">
                            <input type="radio" name="radio5" value="faible">
                            <input type="radio" name="radio5" value="satisfaisant">
                            <input type="radio" name="radio5" value="excellent">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            <h6>La progression pédagogique est adaptée (rythme, difficulté progressive, équilibre théorie/pratique...)</h6> 
                            <input type="radio" name="radio6" value="mediocre">
                            <input type="radio" name="radio6" value="faible">
                            <input type="radio" name="radio6" value="satisfaisant">
                            <input type="radio" name="radio6" value="excellent">      
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            <h6>L’alternance de moments de « théorie » avec des travaux pratiques vous a-t-elle semblé équilibrée</h6>
                            <input type="radio" name="radio7" value="mediocre">
                            <input type="radio" name="radio7" value="faible">
                            <input type="radio" name="radio7" value="satisfaisant">
                            <input type="radio" name="radio7" value="excellent">      
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            <h6>Le niveau du formateur vous a semblé correct</h6>
                            <input type="radio" name="radio8" value="mediocre">
                            <input type="radio" name="radio8" value="faible">
                            <input type="radio" name="radio8" value="satisfaisant">
                            <input type="radio" name="radio8" value="excellent">       
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Le formateur a tenu un langage clair
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
                            Le formateur a respecté le contenu du programme, 
                            il vous a aidé à atteindre les objectifs 
                            <br>
                            <input type="radio" name="radio10" value="mediocre">
                            <input type="radio" name="radio10" value="faible">
                            <input type="radio" name="radio10" value="satisfaisant">
                            <input type="radio" name="radio10" value="excellent">                           
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Il y a eu une adaptation au rythme, au contenu
                            <br>
                            <input type="radio" name="radio11" value="mediocre">
                            <input type="radio" name="radio11" value="faible">
                            <input type="radio" name="radio11" value="satisfaisant">
                            <input type="radio" name="radio11" value="excellent">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            La qualité des exemples cités
                            <br>
                            <input type="radio" name="radio12" value="mediocre">
                            <input type="radio" name="radio12" value="faible">
                            <input type="radio" name="radio12" value="satisfaisant">
                            <input type="radio" name="radio12" value="excellent">                           
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Le niveau des aptitudes (élocution, postures, tenue)
                            <br>
                            <input type="radio" name="radio13" value="mediocre">
                            <input type="radio" name="radio13" value="faible">
                            <input type="radio" name="radio13" value="satisfaisant">
                            <input type="radio" name="radio13" value="excellent">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Le niveau de compétences et de disponibilité
                            <br>
                            <input type="radio" name="radio14" value="mediocre">
                            <input type="radio" name="radio14" value="faible">
                            <input type="radio" name="radio14" value="satisfaisant">
                            <input type="radio" name="radio14" value="excellent">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Globalement, j'ai été très satisfait(e) du formateur
                            <br>
                            <input type="radio" name="radio15" value="mediocre">
                            <input type="radio" name="radio15" value="faible">
                            <input type="radio" name="radio15" value="satisfaisant">
                            <input type="radio" name="radio15" value="excellent">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Si vous deviez suivre à nouveau une formation, le feriez-vous volontiers avec ce formateur ?
                            <br>
                            <input type="radio" name="radio16" value="mediocre">
                            <input type="radio" name="radio16" value="faible">
                            <input type="radio" name="radio16" value="satisfaisant">
                            <input type="radio" name="radio16" value="excellent">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Recommanderiez-vous ce formateur à un centre de formation ou à une entreprise ?
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
        <h4 style="color: white;text-align: center;">Les questionnaires seront disponibles le {{\Carbon\Carbon::parse($dateFinForm)->format('d/m/Y')}}</h4>
    @endif
    @if ($dateNow >= $dateFinForm)  
        <h3 style="color: white;">Evaluation de la formation</h3>
        <h5 style="color: white;">Pour chaque question, le système de notation est le suivant : </h5>  
        <label style="color: white;"><input type="radio" disabled="true">Médiocre</label>
        <label style="color: white;"><input type="radio" disabled="true">Faible</label>
        <label style="color: white;"><input type="radio" disabled="true">Satisfaisant</label>
        <label style="color: white;"><input type="radio" disabled="true">Excellent</label> 
        <form class="form-horizontal" method="POST" action="{{ route('send_form_formation_apprenant') }}" id="form_quest_formation_app">
        {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-group">
                    <strong id="titre_form_info_contenu_obj" style="border-top-right-radius: 5px;border-top-left-radius: 5px;padding-top: 1%;padding-bottom: 1%;"><h4>Contenu et objectifs</h4></strong>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Adéquation de la formation avec vos objectifs d'emploi
                            <br>
                            <input type="radio" name="radio9" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio9" value="faible" id="checkbox_2">
                            <input type="radio" name="radio9" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio9" value="excellent" id="checkbox_4"> 
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Parcours de formation adapté à votre niveau
                            <br>
                            <input type="radio" name="radio10" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio10" value="faible" id="checkbox_2">
                            <input type="radio" name="radio10" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio10" value="excellent" id="checkbox_4">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Durée de la formation
                            <br>
                            <input type="radio" name="radio11" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio11" value="faible" id="checkbox_2">
                            <input type="radio" name="radio11" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio11" value="excellent" id="checkbox_4">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Efficacité du parcours proposé
                            <br>
                            <input type="radio" name="radio12" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio12" value="faible" id="checkbox_2">
                            <input type="radio" name="radio12" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio12" value="excellent" id="checkbox_4">
                        </li>
                    </ul>
                    <ul class="list-group">
                    <strong id="titre_form_info_peda" style="border-top-right-radius: 5px;border-top-left-radius: 5px;padding-top: 1%;padding-bottom: 1%;"><h4>Pédagogie</h4></strong>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Disponibilité du formateur
                            <br>
                            <input type="radio" name="radio13" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio13" value="faible" id="checkbox_2">
                            <input type="radio" name="radio13" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio13" value="excellent" id="checkbox_4">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Qualité d'animation du formateur
                            <br>
                            <input type="radio" name="radio14" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio14" value="faible" id="checkbox_2">
                            <input type="radio" name="radio14" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio14" value="excellent" id="checkbox_4">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Maîtrise du sujet et connaissance du secteur/métier par le formateur
                            <br>
                            <input type="radio" name="radio15" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio15" value="faible" id="checkbox_2">
                            <input type="radio" name="radio15" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio15" value="excellent" id="checkbox_4">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Qualité des supports pédagogiques de la formation
                            <br>
                            <input type="radio" name="radio16" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio16" value="faible" id="checkbox_2">
                            <input type="radio" name="radio16" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio16" value="excellent" id="checkbox_4">
                        </li>
                    </ul>
                    <ul class="list-group">
                    <strong id="titre_form_info_peda" style="border-top-right-radius: 5px;border-top-left-radius: 5px;padding-top: 1%;padding-bottom: 1%;"><h4>Dynamique de groupe</h4></strong>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Homogénéité du groupe
                            <br>
                            <input type="radio" name="radio17" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio17" value="faible" id="checkbox_2">
                            <input type="radio" name="radio17" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio17" value="excellent" id="checkbox_4">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Participation du groupe
                            <br>
                            <input type="radio" name="radio18" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio18" value="faible" id="checkbox_2">
                            <input type="radio" name="radio18" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio18" value="excellent" id="checkbox_4">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Ambiance générale de la formation
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
                        <strong id="titre_form_info_recrut" style="border-top-right-radius: 5px;border-top-left-radius: 5px;padding-top: 1%;padding-bottom: 1%;"><h4>Informations recrutement</h4></strong>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Qualités des informations communiquées
                            <br>
                            <input type="radio" name="radio1" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio1" value="faible" id="checkbox_2">
                            <input type="radio" name="radio1" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio1" value="excellent" id="checkbox_4">      
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Clarté des critères de sélection
                            <br>
                            <input type="radio" name="radio2" value="mediocre" id="checkbox_5">
                            <input type="radio" name="radio2" value="faible" id="checkbox_6">
                            <input type="radio" name="radio2" value="satisfaisant" id="checkbox_7">
                            <input type="radio" name="radio2" value="excellent" id="checkbox_8">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Qualité des entretiens et des tests de recrutement
                            <br>
                            <input type="radio" name="radio3" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio3" value="faible" id="checkbox_2">
                            <input type="radio" name="radio3" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio3" value="excellent" id="checkbox_4">                          
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Accompagnement pour la constitution du dossier de rémunération
                            <br>
                            <input type="radio" name="radio4" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio4" value="faible" id="checkbox_2">
                            <input type="radio" name="radio4" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio4" value="excellent" id="checkbox_4">                          
                        </li>
                    </ul>
                    <ul class="list-group">
                    <strong id="titre_form_info_enviro_form" style="border-top-right-radius: 5px;border-top-left-radius: 5px;padding-top: 1%;padding-bottom: 1%;"><h4>Environnement de l'Organisme de Formation</h4></strong>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Accueil et service
                            <br>
                            <input type="radio" name="radio5" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio5" value="faible" id="checkbox_2">
                            <input type="radio" name="radio5" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio5" value="excellent" id="checkbox_4">                          
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Qualité des salles de formation
                            <br>
                            <input type="radio" name="radio6" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio6" value="faible" id="checkbox_2">
                            <input type="radio" name="radio6" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio6" value="excellent" id="checkbox_4">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Qualité du matériel utilisé
                            <br>
                            <input type="radio" name="radio7" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio7" value="faible" id="checkbox_2">
                            <input type="radio" name="radio7" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio7" value="excellent" id="checkbox_4">
                        </li>
                        <li class="list-group-item" style="border-color: white;background-color: transparent;color: white">
                            Accessibilité des locaux
                            <br>
                            <input type="radio" name="radio8" value="mediocre" id="checkbox_1">
                            <input type="radio" name="radio8" value="faible" id="checkbox_2">
                            <input type="radio" name="radio8" value="satisfaisant" id="checkbox_3">
                            <input type="radio" name="radio8" value="excellent" id="checkbox_4"> 
                        </li>
                    </ul>
                    <textarea class="form-control" id="input_text_com_1" maxlength="200" required name="commentaires_eval" rows="2" style="margin-top: 1%;" placeholder="Vos commentaires sur cette formation (200 caractères maximum)."></textarea>
                    <textarea class="form-control" id="input_text_com_1" maxlength="200" required name="apprecie_eval" rows="2" style="margin-top: 1%;" placeholder="Vous avez particulierement apprécié : (200 caractères maximum)."></textarea>
                    <textarea class="form-control" id="input_text_com_1" maxlength="200" required name="sugg_amelio" rows="2" style="margin-top: 1%;" placeholder="Vos suggestions d'amélioration : (200 caractères maximum)."></textarea>
                    <ul class="list-group">
                        <h5 style="color: white;text-align: center;width: 100%;margin-top: 2%;">Attribuer une note à la formation</h5>;
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
                        <div id="btn_disabled_validation_com2_formation">COMMENTAIRE PREMIERE SEMAINE</div>
                        <textarea class="form-control" id="input_text_com_1" maxlength="500" required name="com_apprenant_sem1" rows="6" style="margin-top: 2%;" placeholder="Ecrivez votre ressenti sur votre première semaine de formation (500 caractères maximum)."></textarea>
                    </div>  
                    <button type="submit" id="btn_validation_com1_formation" class="btn btn-outline-primary">
                        <div id="label_btn_valid_com1">
                            VALIDER
                        </div>
                        <div class="loader"></div>
                    </button>
                </form>
            @endif
            @if ($apprenant->commentaire_semaine1 != null and $dateNow < $datePlusOnzeJours)

                <h4 style="color: white;text-align: center;">Revenez le {{\Carbon\Carbon::parse($datePlusOnzeJours)->format('d/m/Y')}} pour remplir votre deuxième commentaire!</h4>

            @endif
            @if ($apprenant->commentaire_semaine1 != null and $dateNow >= $datePlusOnzeJours and $apprenant->commentaire_semaine2 == null)  
                <form class="form-horizontal" method="POST" action="{{ route('comFormSem2') }}" id="com_sem2">
                {{ csrf_field() }} 
                    <div class="form-group">
                        <div id="btn_disabled_validation_com2_formation">COMMENTAIRE DEUXIEME SEMAINE</div>
                        <textarea class="form-control" id="input_text_com_2" rows="6" maxlength="500" required name="com_apprenant_sem2" style="margin-top: 2%;" placeholder="Ecrivez votre ressenti sur votre deuxième semaine de formation (500 caractères maximum)."></textarea>
                    </div>  
                    <button type="submit" id="btn_validation_com2_formation" class="btn btn-outline-primary">
                        <div id="label_btn_valid_com2">
                            VALIDER
                        </div>
                        <div class="loader"></div>
                    </button>
                </form>
            @endif
            @if ($apprenant->commentaire_semaine1 != null and $apprenant->commentaire_semaine2 != null)

                <h4 style="color: white;text-align: center;">Merci pour votre participation!</h4>

            @endif
        </div>
    </div>
    <div class="row" id="programme_form_pdf" style="margin-top: 2%;">
        <div class="col-lg-12">
            <form class="form-horizontal" method="GET" action="{{ route('downloadPdf') }}">
            {{ csrf_field() }}
                <br>
                <button class="btn btn-outline-primary" id="btn_download_programme" type="submit" style="margin-top: 2%;">Téléchargez votre programme de formation</button>
            </form>  
        </div>
    </div>
</div>
@endsection