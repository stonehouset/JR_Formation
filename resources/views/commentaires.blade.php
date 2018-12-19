@extends('layouts.menu')

@section('content')
<body>
    <h3 id="titre_page_commentaire">Commentaires</h3>
    <div id="affichage_coms_apprenants">
    	<div class="row" id="row_com_sem_apprenant">	
    		<div class="col-lg-12" id="row_commentaires">
    			<h4 id="entete_liste_com">Groupes</h4>
    			<div clas="table-responsive" id="cadre_scroll_commentaire"> 

    				<table class="table table-striped table-dark" style="width: 100%;table-layout: fixed;">
                        <thead>
                            <tr>  
                                <th scope="row">Commentaire</th>                      
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
        <div class="row" id="row_com_sem_apprenant">
    		<div class="col-lg-12" id="row_commentaires">
    			<h4 id="entete_liste_com">Individuels</h4>
    			<div clas="table-responsive" id="cadre_scroll_commentaire"> 
    				<table class="table table-striped table-dark" style="width: 100%;table-layout: fixed;">
                        <thead>
                            <tr> 
                               
                                <th scope="row">Commentaire</th> 
                                                                                                                
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