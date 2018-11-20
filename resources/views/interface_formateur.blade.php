@extends('layouts.menu')

@section('content')
<div class="panel-body" id="body_interface_formateur"> 
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
    <div class="card-header" id="headingTwo">
        <h5 class="mb-0" style="color: white;">
            @foreach($formations as $formation)

                Formation : {{$formation->nom}} du {{\Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y')}} au {{\Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y')}}

            @endforeach
        </h5>
    </div>         
    <div class="row">       
        <div class="col-lg-7"> 
            <div class="card" style="border-color: white;background-color: #2D3F58;">   
                <div class="card-header" id="header_tableau_apprenants" style="background-color: #2D3F58;color: white;margin-top: 0%;border-color: #E0002D;">
                    <h5 class="mb-0" style="color: white;">
                        Liste de vos stagiaires 
                    </h5>
                </div>
                <div id="tab_infos_interface_formateur" ">
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th scope="col">Prénom</th>
                                <th scope="col">Nom</th>
                                <th scope="col">eMail</th> 
                                <th scope="col">Téléphone</th>                                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formations as $formation)
                                @foreach($formation->apprenants as $apprenant)
                                    @foreach($apprenant->users as $user)
                                    <tr>                         
                                        <td>{{$user->prenom}}</td>
                                        <td>{{$user->nom}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->numero_telephone}}</td>                                    
                                    </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>  
                </div>
                    <a href="{{route('formateur_apprenants_csv')}}" style="color: white;">Extraire tableau stagiaires format Excel</a>
                </button>                
            </div>                                    
        </div>
        <div class="col-lg-5" id="com_formateur_to_apprenant">            
            <div class="card" style="border: hidden;">         
                <form id="form_register_commentaire" method="POST" action="{{ route('commentaire') }}">
                {{ csrf_field() }} 
                    <select class="custom-select" id="inputGroupSelect01" name="nom_apprenant_com">
                        <option value="" disabled selected style="color: #2D3F58;">Sélectionnez un stagiaire</option>
                        @foreach($formations as $formation)
                            @foreach($formation->apprenants as $apprenant)
                                @foreach($apprenant->users as $user)
                       
                                <option value="{{$user->id}}">{{$user->prenom}} {{$user->nom}}</option>

                                @endforeach
                            @endforeach
                        @endforeach
                    </select>
                    <div id="com_formateur_to_apprenant_txt">
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Ecrivez un message à propos du stagiaire."rows="5" name="contenu_commentaire"></textarea>
                    </div>
                    <button type="submit" id="btn_ajouter_com_formateur_to_apprenant" class="btn btn-outline-primary">Ajouter</button>
                </form> 
                <button class="btn btn-outline-primary" disabled="true" id="label_retard_absence">Signaler un retard ou une absence</button>
                <form id="form_absence_retard" method="POST" action="{{ route('absence_retard') }}">
                    {{ csrf_field() }} 
                    <div class="row">
                        <div class="col-lg-6">
                            <select class="custom-select" id="select_nom_apprenant_absouret" name="nom_apprenant_absence_retard">
                                <option value="" disabled selected style="color: #2D3F58;">Stagiaire</option>
                                @foreach($formations as $formation)
                                    @foreach($formation->apprenants as $apprenant)
                                        @foreach($apprenant->users as $user)
                               
                                        <option value="{{$user->id}}">{{$user->prenom}} {{$user->nom}}</option>

                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6"> 
                            <select class="custom-select" id="select_absence_retard_apprenant" name="absence_ou_retard">
                                <option value="" disabled selected>Retard/Absence</option>
                                <option value="1">Retard</option>
                                <option value="2">Absence</option>     
                            </select>     
                        </div>
                    </div>
                    <button type="submit" id="btn_valider_retard_absence" class="btn btn-outline-primary">Signaler</button>
                </form>
                <button class="btn btn-outline-primary" disabled="true" id="label_note">Attribuer une note /20</button>
                <form id="form_register_note" method="POST" action="{{ route('note_apprenant')}}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6">
                            <select class="custom-select" id="select_ajout_note_apprenant" name="nom_apprenant_note">
                                <option value="" disabled style="color: #2D3F58;">Stagiaire</option>
                                @foreach($formations as $formation)
                                    @foreach($formation->apprenants as $apprenant)
                                        @foreach($apprenant->users as $user)
        
                                        <option value="{{$user->id}}">{{$user->prenom}} {{$user->nom}}</option>

                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input id="note_apprenant" type="number" class="form-control" name="note_apprenant" value="" min="0" max="20" required >
                        </div>
                    </div>
                    <button type="submit" id="btn_valider_note" class="btn btn-outline-primary">Ajouter</button>
                </form>
            </div>                     
        </div>     
    </div>  
</div>
@endsection