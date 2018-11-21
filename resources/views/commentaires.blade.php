@extends('layouts.menu')

@section('content')

<h3 id="titre_page_commentaire">LISTES DES COMMENTAIRES</h3>
<div id="affichage_coms_apprenants">
	<div class="row" id="row_com_sem_apprenant">	
		<div class="col-lg-6" id="row_commentaires">
			<h4 id="entete_liste_com">Commentaires des apprenants</h4>
			@foreach($apprenants as $apprenant)
				@if($apprenant->commentaire_semaine1 != null)
	                <div class="card" id="card_com_sem_apprenant">
	  					<div class="card-header" id="header_card_com_sem_apprenant">
					    Commentaire de {{$apprenant->infos->prenom}} {{$apprenant->infos->nom}}, formation {{$apprenant->groupe_formation}} semaine 1
					  	</div>
					  	<div class="card-body">
					    	<blockquote class="blockquote mb-0" id="body_card_com_semaine_apprenant">					    		
					      		<p>{{$apprenant->commentaire_semaine1}}</p>
					    	</blockquote>
					  	</div>
					</div>
                @endif		  	
				@if($apprenant->commentaire_semaine2 != null)
					<div class="card" id="card_com_sem_apprenant">
	  					<div class="card-header" id="header_card_com_sem_apprenant">
					    Commentaire de {{$apprenant->infos->prenom}} {{$apprenant->infos->nom}}, formation {{$apprenant->groupe_formation}} semaine 2
					  	</div>
					  	<div class="card-body">
					    	<blockquote class="blockquote mb-0" id="body_card_com_semaine_apprenant">
					      		<p>{{$apprenant->commentaire_semaine2}}</p>
					    	</blockquote>
					  	</div>
					</div>
				@endif		  	
            @endforeach
		</div>
		<div class="col-lg-6" id="row_commentaires">
			<h4 id="entete_liste_com">Commentaires des formateurs</h4>
			@foreach($commentaires as $commentaire)					  	
				<div class="card" id="card_com_sem_apprenant">
  					<div class="card-header" id="header_card_com_sem_apprenant">
				    Commentaire de {{$commentaire->formateur->prenom}} {{$commentaire->formateur->nom}} au sujet de {{$commentaire->apprenant->prenom}} {{$commentaire->apprenant->nom}}
				  	</div>
				  	<div class="card-body">
				    	<blockquote class="blockquote mb-0" id="body_card_com_semaine_apprenant">
				      		<p>{{$commentaire->commentaire}}</p>
				      		<p>Publié le : {{\Carbon\Carbon::parse($commentaire->date_jour)->format('d/m/Y')}}</p>
				    	</blockquote>
				  	</div>
				</div>	  	
            @endforeach
		</div>
	</div>
		
</div>
@endsection