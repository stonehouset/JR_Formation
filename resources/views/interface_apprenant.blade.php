@extends('layouts.menu')

@section('content')
     
<div class="panel-body" id="body_interface_apprenant">
    <div class="row">
        <div class="col-lg-12">  
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        Profil de {{Auth::user()->prenom}} {{Auth::user()->nom}}
                    </h5>
                </div>             
            </div>                               
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">  
            <div class="card">
                <div class="card-header" id="headingTwo">  
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Formation suivie : 
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <h5>Groupe de formation :</h5> 
                        <h5>Formateur : </h5> 
                        <h5>Dates de formation : du ../../.. au ../../..</h5> 
                    </div>
                </div>
                <div class="card-header" id="headingFive">  
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Commentaire de fin de semaine 
                        </button>
                    </h5>
                </div>
                <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
                    <div class="card-body">
                       <div class="input-group mb-3">
                            <input type="tel" class="form-control" placeholder="" aria-label=telephone" aria-describedby="basic-addon2">
                        </div>
                    </div>
                </div>

            </div>                               
        </div>
        <div class="col-lg-6"> 
            <div class="card">
                <div class="card-header" id="headingThree">  
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Programme de formation 
                        </button>
                    </h5>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                    <div class="card-body">
                        <h5>Bientôt disponible!</h5> 
                        <button class="btn btn-link collapsed">
                            <a>Télécharger le programme de formation</a>
                        </button>
                    </div>
                </div>
                <div class="card-header" id="headingFour">  
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Questionnaire de satisfaction de la formation 
                        </button>
                    </h5>
                </div>
                <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
                    <div class="card-body">
                        <h5>Bientôt disponible!</h5> 
                    </div>
                </div> 
                <div class="card-header" id="headingSix">  
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        Questionnaire de satisfaction du formateur 
                        </button>
                    </h5>
                </div>
                <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
                    <div class="card-body">
                        <h5>Bientôt disponible!</h5> 
                    </div>
                </div> 
            </div>                             
        </div>
    </div>
</div>
@endsection