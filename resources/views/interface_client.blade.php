@extends('layouts.menu')

@section('content')
<div class="panel-body" id="body_interface_client">
    <div class="row">
        <div class="col-lg-12">  
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        Formation : ......  Du ../../.. au ../../..
                    </h5>
                </div>
                <div class="card-header" id="header_tableau_apprenants">
                    <h5 class="mb-0">
                        Liste des Stagiaires 
                    </h5>
                </div>
                <table class="table table-striped table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Prénom</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Note</th>
                            <th scope="col">Commentaire</th>       
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>thib</td>
                            <td>hous</td>
                            <td>12/20</td>
                            <td>Iter Para Plumplum</td>                                        
                        </tr>
                    </tbody>
                </table>                   
            </div>                               
        </div>
    </div>
</div>
@endsection