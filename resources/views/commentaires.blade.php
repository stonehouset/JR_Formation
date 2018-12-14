@extends('layouts.menu')

@section('content')

<h3 id="titre_page_commentaire">Commentaires</h3>
<div id="affichage_coms_apprenants">
	<div class="row" id="row_com_sem_apprenant">	
		<div class="col-lg-6 col-sm-12" id="row_commentaires">
			<h4 id="entete_liste_com">Groupes</h4>
			<div id="cadre_scroll_commentaire"> 
				<table class="table table-striped table-dark" >
                    <thead>
                        <tr> 
                            <th scope="col">Date</th>
                            <th scope="col">Formateur -> Groupe formation</th>  
                            <th scope="col">Commentaire</th>                      
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commentaires2 as $commentaire)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($commentaire->date_jour)->format('d/m/Y')}}</td>
                            <td>{{$commentaire->formateur->prenom}} {{$commentaire->formateur->nom}} -> {{$commentaire->formation}}</td>
                            <td>{{$commentaire->commentaire}}</td>                                     
                        </tr>
                        @endforeach  
                    </tbody>
                </table>
	        </div>
		</div>
		<div class="col-lg-6 col-sm-12" id="row_commentaires">
			<h4 id="entete_liste_com">Individuels</h4>
			<div id="cadre_scroll_commentaire"> 
				<table class="table table-striped table-dark" >
                    <thead>
                        <tr> 
                            <th scope="col">Date</th> 
                            <th scope="col">Formateur -> Apprenant</th>  
                            <th scope="col">Commentaire</th> 
                                                                                                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commentaires1 as $commentaire)
                        <tr>
                            <td>{{\Carbon\Carbon::parse($commentaire->date_jour)->format('d/m/Y')}}</td>
                            <td>{{$commentaire->formateur->prenom}} {{$commentaire->formateur->nom}} -> {{$commentaire->apprenant->prenom}} {{$commentaire->apprenant->nom}}</td>
                            <td>{{$commentaire->commentaire}}</td>
                                                                                                        
                        </tr>
                        @endforeach  
                    </tbody>
                </table>
	        </div>
		</div>
	</div>
		
</div>
@endsection