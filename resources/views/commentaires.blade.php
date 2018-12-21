@extends('layouts.menu')

@section('content')
<body>
    <h3 id="titre_page_commentaire">Commentaires</h3>
    <div id="affichage_coms_apprenants">
    	<div class="row" id="row_com_sem_apprenant">	
    		<div class="col-lg-12" id="row_commentaires">
    			<h4 id="entete_liste_com">Groupes<input type="text" id="input_com1" onkeyup="search4()"  placeholder="rechercher" title="rechercher dans les commentaires"></h4>
    			<div clas="table-responsive" id="cadre_scroll_commentaire"> 
    				<table class="table table-striped table-dark table-hover" id="table_tab_com1">
                        <thead>
                            <tr>  
                                <th scope="row">Commentaires</th>                      
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commentaires2 as $commentaire)
                                <tr>
                                    <td style="word-wrap: break-word;">
                                    <h6 id="row_commentaire_gr">Le {{\Carbon\Carbon::parse($commentaire->date_jour)->format('d/m/Y')}},
                                    {{$commentaire->formateur->prenom}} {{$commentaire->formateur->nom}} sur {{$commentaire->formation}}</h6><br>
                                    {{$commentaire->commentaire}}</td>                                     
                                </tr>
                            @endforeach  
                        </tbody>
                    </table>
    	        </div>
    		</div>
        </div>
        <div class="row" id="row_com_sem_groupe">
    		<div class="col-lg-12" id="row_commentaires2">
    			<h4 id="entete_liste_com2">Individuels<input type="text" id="input_com2" onkeyup="search5()"  placeholder="rechercher" title="rechercher dans les commentaires"></h4>
    			<div clas="table-responsive" id="cadre_scroll_commentaire2"> 
    				<table class="table table-striped table-dark table-hover" id="table_tab_com2">
                        <thead>
                            <tr> 
                                <th scope="row">Commentaires</th>                                                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commentaires1 as $commentaire)
                                <tr>
                                    <td style="word-wrap: break-word;">
                                    <h6 id="row_commentaire_ind">Le {{\Carbon\Carbon::parse($commentaire->date_jour)->format('d/m/Y')}}, {{$commentaire->formateur->prenom}} {{$commentaire->formateur->nom}} à {{$commentaire->apprenant->prenom}} {{$commentaire->apprenant->nom}}</h6><br>{{$commentaire->commentaire}}</td>                               
                                </tr>
                            @endforeach  
                        </tbody>
                    </table>
    	        </div>
    		</div>
        </div>
    </div>
</body>
@endsection