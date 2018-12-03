@extends('layouts.menu')

@section('content')

<h3 id="titre_page_commentaire">COMMENTAIRES</h3>
<div id="affichage_coms_apprenants">
	<div class="row" id="row_com_sem_apprenant">	
		<div class="col-lg-6 col-sm-12" id="row_commentaires">
			<h4 id="entete_liste_com">GROUPES</h4>
			<div id="cadre_scroll_commentaire"> 
				<table class="table table-striped table-dark" >
                    <thead>
                        <tr> 
                            <th scope="col">Formateur</th>  
                            <th scope="col">Groupe formation</th> 
                            <th scope="col">Contenu</th>  
                            <th scope="col">Date</th>                                                                                                    
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commentaires2 as $commentaire)
                        <tr>
                            <td>{{$commentaire->formateur->prenom}} {{$commentaire->formateur->nom}}</td>
                            <td>{{$commentaire->formation}}</td>                            
                            <td>{{$commentaire->commentaire}}</td> 
                            <td>{{\Carbon\Carbon::parse($commentaire->date_jour)->format('d/m/Y')}}</td>                                                                           
                        </tr>
                        @endforeach  
                    </tbody>
                </table>
	        </div>
		</div>
		<div class="col-lg-6 col-sm-12" id="row_commentaires">
			<h4 id="entete_liste_com">INDIVIDUELS</h4>
			<div id="cadre_scroll_commentaire"> 
				<table class="table table-striped table-dark" >
                    <thead>
                        <tr> 
                            <th scope="col">Formateur</th>  
                            <th scope="col">Apprenant</th> 
                            <th scope="col">Contenu</th> 
                            <th scope="col">Date</th>  
                                                                                                      
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commentaires1 as $commentaire)
                        <tr>
                            <td>{{$commentaire->formateur->prenom}} {{$commentaire->formateur->nom}}</td>
                            <td>{{$commentaire->apprenant->prenom}} {{$commentaire->apprenant->nom}}</td> 
                            <td>{{$commentaire->commentaire}}</td>
                            <td>{{\Carbon\Carbon::parse($commentaire->date_jour)->format('d/m/Y')}}</td>                                                                            
                        </tr>
                        @endforeach  
                    </tbody>
                </table>
	        </div>
		</div>
	</div>
		
</div>
@endsection