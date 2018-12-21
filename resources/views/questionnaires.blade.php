@extends('layouts.menu')

@section('content')
<body>
	<div class="container">
		<div class="row" id="btns_modif_questionnaires">
	        <div class="col-lg-3">
	            <button type="button" class="btn btn-outline-dark" id="btn_quest_eval_formateur">Eval Formateur</button>      
	        </div>
	        <div class="col-lg-3">
	            <button type="button" class="btn btn-outline-dark" id="btn_quest_eval_formation">Eval Formation</button> 
	        </div>
	        <div class="col-lg-3">
	            <button type="button" class="btn btn-outline-dark" id="btn_quest_auto_eval">Compte Rendu</button> 
	        </div>
	        <div class="col-lg-3">
	            <button type="button" class="btn btn-outline-dark" id="btn_quest_impact_forma">Impact Formation</button> 
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
	</div>
	<div class="container" id="container_form_eval_formateur_admin">
		<h3 style="color: white;" id="titre_form_eval_formateur_admin">Evaluation du formateur par l'apprenant</h3>     
        <form class="form-horizontal" method="POST" action="{{ route('evalFormateur') }}" id="form_eval_formateur_modifiable">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-group">
                        <li class="list-group-item form_admin"> 
                        	<h6>Question 1</h6>
                            <textarea class="form-control" name="quest1_eval_formateur_admin" placeholder="{{$evalFormateur->champ1}}" rows="2" maxlength="200"></textarea>     
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 2</h6>
                            <textarea class="form-control" name="quest2_eval_formateur_admin" placeholder="{{$evalFormateur->champ2}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 3</h6>
                            <textarea class="form-control" name="quest3_eval_formateur_admin" placeholder="{{$evalFormateur->champ3}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 4</h6>
                            <textarea class="form-control" name="quest4_eval_formateur_admin" placeholder="{{$evalFormateur->champ4}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 5</h6>
                            <textarea class="form-control" name="quest5_eval_formateur_admin" placeholder="{{$evalFormateur->champ5}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 6</h6>
                            <textarea class="form-control" name="quest6_eval_formateur_admin" placeholder="{{$evalFormateur->champ6}}" rows="2" maxlength="200"></textarea>     
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 7</h6>
                            <textarea class="form-control" name="quest7_eval_formateur_admin" placeholder="{{$evalFormateur->champ7}}" rows="2" maxlength="200"></textarea>     
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 8</h6>
                            <textarea class="form-control" name="quest8_eval_formateur_admin" placeholder="{{$evalFormateur->champ8}}"></textarea>     
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 9</h6>
                   			<textarea class="form-control" name="quest9_eval_formateur_admin" placeholder="{{$evalFormateur->champ9}}"></textarea>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="list-group">
                        <li class="list-group-item form_admin">
                        	<h6>Question 10</h6>
                            <textarea class="form-control" name="quest10_eval_formateur_admin" placeholder="{{$evalFormateur->champ10}}" rows="2" maxlength="200"></textarea>                          
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 11</h6>
                            <textarea class="form-control" name="quest11_eval_formateur_admin" placeholder="{{$evalFormateur->champ11}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 12</h6>
                            <textarea class="form-control" name="quest12_eval_formateur_admin" placeholder="{{$evalFormateur->champ12}}" rows="2" maxlength="200"></textarea>                           
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 13</h6>
                            <textarea class="form-control" name="quest13_eval_formateur_admin" placeholder="{{$evalFormateur->champ13}}" rows="2" maxlength="200"></textarea> 
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 14</h6>
                            <textarea class="form-control" name="quest14_eval_formateur_admin" placeholder="{{$evalFormateur->champ14}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 15</h6>
                            <textarea class="form-control" name="quest15_eval_formateur_admin" placeholder="{{$evalFormateur->champ15}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 16</h6>
                            <textarea class="form-control" name="quest16_eval_formateur_admin" placeholder="{{$evalFormateur->champ16}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
                        	<h6>Question 17</h6>
                            <textarea class="form-control" name="quest17_eval_formateur_admin" placeholder="{{$evalFormateur->champ17}}" rows="2" maxlength="200"></textarea>     
                        </li> 
                    </ul>
                    
                </div>
                <button type="submit" id="btn_validation_form_formateur_admin" class="btn btn-outline-primary">
                    <div id="label_btn_valid_quest_formateur_admin">
                        Mettre à jour
                    </div>
                    <div class="loader"></div>
                </button> 
        	</div>
       </form>
    </div>
    <div class="container" id="container_form_eval_formation_admin">
        <h3 style="color: white;" id="titre_form_eval_autoeval_admin">Evaluation de la formation par l'apprenant</h3>
        <form class="form-horizontal" method="POST" action="{{ route('evalFormation') }}" id="form_eval_formation_modifiable">
        {{ csrf_field() }}
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-group">
                        <li class="list-group-item form_admin"> 
                            <h6>Question 1</h6>
                            <textarea class="form-control" name="quest1_eval_formation_admin" placeholder="{{$evalFormation->champ1}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 2</h6>
                            <textarea class="form-control" name="quest2_eval_formation_admin" placeholder="{{$evalFormation->champ2}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 3</h6>
                            <textarea class="form-control" name="quest3_eval_formation_admin" placeholder="{{$evalFormation->champ3}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 4</h6>
                            <textarea class="form-control" name="quest4_eval_formation_admin" placeholder="{{$evalFormation->champ4}}" rows="2" maxlength="200"></textarea>
                        </li>
                    </ul>
                    <ul class="list-group">
                        <li class="list-group-item form_admin">
                            <h6>Question 5</h6>
                            <textarea class="form-control" name="quest5_eval_formation_admin" placeholder="{{$evalFormation->champ5}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 6</h6>
                            <textarea class="form-control" name="quest6_eval_formation_admin" placeholder="{{$evalFormation->champ6}}" rows="2" maxlength="200"></textarea>
                        </li>
                        <li class="list-group-item form_admin">
         					<h6>Question 7</h6>
                            <textarea class="form-control" name="quest7_eval_formation_admin" placeholder="{{$evalFormation->champ7}}" rows="2" maxlength="200"></textarea>
                            
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 8</h6>
                            <textarea class="form-control" name="quest8_eval_formation_admin" placeholder="{{$evalFormation->champ8}}" rows="2" maxlength="200"></textarea>  
                        </li>
                    </ul>
                    <ul class="list-group">
                        <li class="list-group-item form_admin">
                            <h6>Question 9</h6>
                            <textarea class="form-control" name="quest9_eval_formation_admin" placeholder="{{$evalFormation->champ9}}" rows="2" maxlength="200"></textarea> 
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 10</h6>
                            <textarea class="form-control" name="quest10_eval_formation_admin" placeholder="{{$evalFormation->champ10}}" rows="2" maxlength="200"></textarea> 
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 11</h6>
                            <textarea class="form-control" name="quest11_eval_formation_admin" placeholder="{{$evalFormation->champ11}}" rows="2" maxlength="200"></textarea> 
                        </li>
                    </ul>
                </div> 
                <div class="col-lg-6">
                    <ul class="list-group">
                        <li class="list-group-item form_admin">
                            <h6>Question 12</h6>
                            <textarea class="form-control" name="quest12_eval_formation_admin" placeholder="{{$evalFormation->champ12}}" rows="2" maxlength="200"></textarea>        
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 13</h6>
                            <textarea class="form-control" name="quest13_eval_formation_admin" placeholder="{{$evalFormation->champ13}}" rows="2" maxlength="200"></textarea>                            
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 14</h6>
                            <textarea class="form-control" name="quest14_eval_formation_admin" placeholder="{{$evalFormation->champ14}}" rows="2" maxlength="200"></textarea>                     
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 15</h6>
                            <textarea class="form-control" name="quest15_eval_formation_admin" placeholder="{{$evalFormation->champ15}}" rows="2" maxlength="200"></textarea>                         
                        </li>
                    </ul>
                    <ul class="list-group">
                        <li class="list-group-item form_admin"> 
                            <h6>Question 16</h6>
                            <textarea class="form-control" name="quest16_eval_formation_admin" placeholder="{{$evalFormation->champ16}}" rows="2" maxlength="200"></textarea>                         
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 17</h6>
                            <textarea class="form-control" name="quest17_eval_formation_admin" placeholder="{{$evalFormation->champ17}}" rows="2" maxlength="200"></textarea> 
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 18</h6>
                            <textarea class="form-control" name="quest18_eval_formation_admin" placeholder="{{$evalFormation->champ18}}" rows="2" maxlength="200"></textarea> 
                        </li>
                        <li class="list-group-item form_admin">
                            <h6>Question 19</h6>
                            <textarea class="form-control" name="quest19_eval_formation_admin" placeholder="{{$evalFormation->champ19}}" rows="2" maxlength="200"></textarea> 
                        </li>
                    </ul>
                    <textarea class="form-control" id="input_text_com_1_admin" maxlength="200" name="quest20_eval_formation_admin" rows="2" placeholder="{{$evalFormation->champ20}}"></textarea>
                    <textarea class="form-control" id="input_text_com_2_admin" maxlength="200" name="quest21_eval_formation_admin" rows="2"  placeholder="{{$evalFormation->champ21}}"></textarea>
                    <textarea class="form-control" id="input_text_com_3_admin" maxlength="200" name="quest22_eval_formation_admin" rows="2" placeholder="{{$evalFormation->champ22}}"></textarea>   
                </div>
                <button type="submit" id="btn_validation_form_formation_admin" class="btn btn-outline-primary">
                    <div id="label_btn_valid_quest_formation_admin">
                        Mettre à jour
                    </div>
                    <div class="loader"></div>
                </button>
            </div>
        </form>      
    </div>
    <div class="container" id="container_form_eval_autoeval_admin">
        <h3 style="color: white;" id="titre_form_eval_formation_admin">Auto évaluation du formateur</h3>
        <div class="row">
            <form method="POST" action="{{ route('autoEval') }}" id="form_compte_rendu_admin">
            {{ csrf_field() }}
                <div class="col-lg-12"">
                    <div class="row">
                        <div class="col-lg-12" id="section_auto_eval_admin">              
                            <h6>Titre 1</h6>
                            <textarea class="form-control" name="quest1_autoeval_formateur_admin" placeholder="{{$autoEval->champ1}}" rows="1" maxlength="200"></textarea> 
                            <div class="form-group">
                                <h6>Sous titre 1</h6>
                            	<textarea class="form-control" name="quest2_autoeval_formateur_admin" placeholder="{{$autoEval->champ2}}" rows="1" maxlength="200"></textarea>
                            </div>
                            <div class="form-group">
                                <h6>Sous titre 2</h6>
                            	<textarea class="form-control" name="quest3_autoeval_formateur_admin" placeholder="{{$autoEval->champ3}}" rows="2" maxlength="200"></textarea>
                                <h6 id="sous_label_objectif_sem" class=""></h6>
                                <h6>Label sous titre 2</h6>
                            	<textarea class="form-control" name="quest4_autoeval_formateur_admin" placeholder="{{$autoEval->champ4}}" rows="3" maxlength="200"></textarea>
                            </div>   
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" id="section_auto_eval2_admin">              
                            <h6>Titre 2</h6>
                            <textarea class="form-control" name="quest5_autoeval_formateur_admin" placeholder="{{$autoEval->champ5}}" rows="1" maxlength="200"></textarea>
                            <div class="form-group">
                                <h6>Sous titre</h6>
                            	<textarea class="form-control" name="quest6_autoeval_formateur_admin" placeholder="{{$autoEval->champ6}}" rows="3" maxlength="200"></textarea>
                                <h6>Label sous titre</h6>
                            	<textarea class="form-control" name="quest7_autoeval_formateur_admin" placeholder="{{$autoEval->champ7}}" rows="2" maxlength="200"></textarea>
                            </div>   
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" id="section_materiel_logistique_admin">              
                            <h6>Titre 3</h6>
                            <textarea class="form-control" name="quest8_autoeval_formateur_admin" placeholder="{{$autoEval->champ8}}" rows="1" maxlength="200"></textarea>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <h6>Label item 1</h6>
                            			<textarea class="form-control" name="quest9_autoeval_formateur_admin" placeholder="{{$autoEval->champ9}}" rows="2" maxlength="200"></textarea>
                            
                                        <h6>Label item 2</h6>
                            			<textarea class="form-control" name="quest10_autoeval_formateur_admin" placeholder="{{$autoEval->champ10}}" rows="2" maxlength="200"></textarea>
                                       
                                        <h6>Label item 3</h6>
                            			<textarea class="form-control" name="quest11_autoeval_formateur_admin" placeholder="{{$autoEval->champ11}}" rows="2" maxlength="200"></textarea>
                                        
                                        <h6>Label item 4</h6>
                            			<textarea class="form-control" name="quest12_autoeval_formateur_admin" placeholder="{{$autoEval->champ12}}" rows="2" maxlength="200"></textarea>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                	<h6>Label item 5</h6>
                        			<textarea class="form-control" name="quest13_autoeval_formateur_admin" placeholder="{{$autoEval->champ13}}" rows="2" maxlength="200"></textarea>
                                    
                                	<h6>Label item 6</h6>
                        			<textarea class="form-control" name="quest14_autoeval_formateur_admin" placeholder="{{$autoEval->champ14}}" rows="2" maxlength="200"></textarea>
                                    
                                	<h6>Label item 7</h6>
                        			<textarea class="form-control" name="quest15_autoeval_formateur_admin" placeholder="{{$autoEval->champ15}}" rows="2" maxlength="200"></textarea>
                                    
                                	<h6>Label item 8</h6>
                        			<textarea class="form-control" name="quest16_autoeval_formateur_admin" placeholder="{{$autoEval->champ16}}" rows="2" maxlength="200"></textarea>
                                
                                </div>
                            </div> 
                            <div class="row">  
                                <div class="offset-lg-3 col-lg-6">
                                    <h6>Label item 9</h6>
                            		<textarea class="form-control" name="quest17_autoeval_formateur_admin" placeholder="{{$autoEval->champ17}}" rows="2" maxlength="200"></textarea>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12" id="section_et_demain_admin">              
                            <h6>Titre 4</h6>
                            <textarea class="form-control" name="quest18_autoeval_formateur_admin" placeholder="{{$autoEval->champ18}}" rows="1" maxlength="200"></textarea>
                            <div class="form-group">
                                <h6>Sous titre</h6>
                            	<textarea class="form-control" name="quest19_autoeval_formateur_admin" placeholder="{{$autoEval->champ19}}" rows="3" maxlength="200"></textarea>
                                
                            </div>    
                        </div>                  
                    </div>
                    <div class="row">
                        <div class="col-lg-12" id="section_validation">              
                            <button type="submit" id="btn_validation_form_formateur_admin" class="btn btn-outline-primary">
                                <div id="label_btn_add_eval_form_admin">
                                    Mettre à jour
                                </div>
                                <div class="loader"></div>
                            </button>  
                        </div>  
                    </div>    
                </div>
            </form>
        </div>
    </div>
    <div class="container" id="container_impact_forma_admin">
    	<h3 style="color: white;" id="titre_form_impact_form_admin">Impact de la formation client</h3>
    	<div class="row">
    		<form class="form-group" method="POST" action="{{ route('impactFormation') }}" id="form_impact_client_admin">
                {{csrf_field()}}
	    		<div id="partie1">
                    <h6>Titre du formulaire</h6>
                    <textarea class="form-control" name="quest1_impact_formation_admin" placeholder="{{$impactFormation->champ1}}" rows="1" maxlength="200"></textarea>

                    <h6>Sous titre 1</h6>
                    <textarea class="form-control" name="quest2_impact_formation_admin" placeholder="{{$impactFormation->champ2}}" rows="2" maxlength="200"></textarea>

                    <h6>Sous titre 2</h6>
                    <textarea class="form-control" name="quest3_impact_formation_admin" placeholder="{{$impactFormation->champ3}}" rows="2" maxlength="200"></textarea>                
                    <h6>Sous titre 3</h6>
                    <textarea class="form-control" name="quest4_impact_formation_admin" placeholder="{{$impactFormation->champ4}}" rows="3" maxlength="200"></textarea> 
                </div> 
                <div class="row">
                    <div class="col-lg-12">
                        <div id="partie2">
                            <h6>Titre 1</h6>
                    		<textarea class="form-control" name="quest5_impact_formation_admin" placeholder="{{$impactFormation->champ5}}" rows="1" maxlength="200"></textarea>
                            <div class="offset-lg-2 col-lg-5">
                                <h6>Label 1</h6>
                    			<textarea class="form-control" name="quest6_impact_formation_admin" placeholder="{{$impactFormation->champ6}}" rows="1" maxlength="200"></textarea>
                            
                                <h6>Label 2</h6>
                    			<textarea class="form-control" name="quest7_impact_formation_admin" placeholder="{{$impactFormation->champ7}}" rows="1" maxlength="200"></textarea>
                           
                                <h6>Label 3</h6>
                    			<textarea class="form-control" name="quest8_impact_formation_admin" placeholder="{{$impactFormation->champ8}}" rows="1" maxlength="200"></textarea>
                            </div>
                        </div>
                        <div id="partie3">
                            <h6>Titre 2</h6>
                    		<textarea class="form-control" name="quest9_impact_formation_admin" placeholder="{{$impactFormation->champ9}}" rows="1" maxlength="200"></textarea>
                        </div>
                        <div id="partie4">
                            <h6>Titre 3</h6>
                    		<textarea class="form-control" name="quest10_impact_formation_admin" placeholder="{{$impactFormation->champ10}}" rows="1" maxlength="200"></textarea>
                    		<h6>Sous titre</h6>
                    		<textarea class="form-control" name="quest11_impact_formation_admin" placeholder="{{$impactFormation->champ11}}" rows="2" maxlength="200"></textarea>
                        </div>
                        <div id="partie5">
                            <h6>Titre 4</h6>
                			<textarea class="form-control" name="quest12_impact_formation_admin" placeholder="{{$impactFormation->champ12}}" rows="1" maxlength="200"></textarea>
                            <h6 id="sous_titre_indicateurs"></h6>
                            <h6>Sous titre</h6>
                    		<textarea class="form-control" name="quest13_impact_formation_admin" placeholder="{{$impactFormation->champ13}}" rows="2" maxlength="200"></textarea>
                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <h6>Label 1</h6>
                    				<textarea class="form-control" name="quest14_impact_formation_admin" placeholder="{{$impactFormation->champ14}}" rows="1" maxlength="200"></textarea>
                               
                                    <h6>Label 2</h6>
                    				<textarea class="form-control" name="quest15_impact_formation_admin" placeholder="{{$impactFormation->champ15}}" rows="1" maxlength="200"></textarea>
                                
                                    <h6>Label 3</h6>
                    				<textarea class="form-control" name="quest16_impact_formation_admin" placeholder="{{$impactFormation->champ16}}" rows="1" maxlength="200"></textarea>
                                </div>    
                                <div class="col-lg-6">
                                    <h6>Label 4</h6>
                    				<textarea class="form-control" name="quest17_impact_formation_admin" placeholder="{{$impactFormation->champ17}}" rows="1" maxlength="200"></textarea>
                                
                                    <h6>Label 5</h6>
                    				<textarea class="form-control" name="quest18_impact_formation_admin" placeholder="{{$impactFormation->champ18}}" rows="1" maxlength="200"></textarea>
                                
                                    <h6>Label 6</h6>
                    				<textarea class="form-control" name="quest19_impact_formation_admin" placeholder="{{$impactFormation->champ19}}" rows="1" maxlength="200"></textarea>
                                </div>
                            </div>  
                        </div>                           
                        <button type="submit" id="btn_valider_impact_formation_admin" class="btn btn-outline-primary"> 
                            <div id="label_btn_valid_eval_admin">
                                Mettre à jour
                            </div>
                            <div class="loader"></div> 
                        </button>
                    </div>
                </div> 
            </form>		
    	</div>
    </div>
</body>
@endsection