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
    <h4 class="mb-0" id="titre_interface_formateur">
        GESTION DES APPRENANTS
    </h4>       
    <div class="row" id="row_principale_interface_formateur">       
        <div class="col-lg-7"> 
            <div class="card" id="card_principale_interface_formateur">   
                <div class="card-header" id="header_tableau_apprenants_formateur">
                    <h5 class="mb-0" id="titre_header_tab_apprenants_formateur">
                        LISTE DE VOS APPRENANTS 
                    </h5>
                </div>
                <div id="tab_infos_interface_formateur">
                    <table class="table table-hover table-dark">
                        <thead class="">
                            <tr>
                                <th scope="col">Prénom</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Formation</th>
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
                                        <td>{{$apprenant->groupe_formation}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->numero_telephone}}</td>                                    
                                    </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>  
                </div>
                <a href="{{route('formateur_apprenants_csv')}}" id="lien_tab_to_csv_formateur">Extraire tableau apprenants format Excel</a>                
            </div>                                    
        </div>
        <div class="col-lg-5" id="com_formateur_to_apprenant">            
            <div class="card" id="card_actions_formateur">         
                <form id="form_register_commentaire" method="POST" action="{{ route('commentaire') }}">
                {{ csrf_field() }} 
                    <select class="custom-select" id="inputGroupSelect01" name="nom_apprenant_com">
                        <option value="" disabled selected>Sélectionnez un apprenant</option>
                        @foreach($formations as $formation)
                            @foreach($formation->apprenants as $apprenant)
                                @foreach($apprenant->users as $user)
                       
                                <option value="{{$user->id}}">{{$user->prenom}} {{$user->nom}}</option>

                                @endforeach
                            @endforeach
                        @endforeach
                    </select>
                    <div id="com_formateur_to_apprenant_txt">
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Ecrivez un message à propos de l'apprenant séléctionné." rows="5" name="contenu_commentaire"></textarea>
                    </div>
                    <button type="submit" id="btn_ajouter_com_formateur_to_apprenant" class="btn btn-outline-primary">Ajouter</button>
                </form> 
                <button class="btn btn-outline-primary" disabled="true" id="label_retard_absence">Signaler un retard ou une absence</button>
                <form id="form_absence_retard" method="POST" action="{{ route('absence_retard') }}">
                    {{ csrf_field() }} 
                    <div class="row">
                        <div class="col-lg-6">
                            <select class="custom-select" id="select_nom_apprenant_absouret" name="nom_apprenant_absence_retard">
                                <option value="" disabled selected>Apprenant</option>
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
                                <option value="" disabled>Apprenant</option>
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
    <button type="button" class="btn btn-outline-primary" id="btn_form_com_jour_formateur" onclick="functionShowHideFormComJour();">COMMENTAIRE JOURNALIER DES FORMATIONS</button> 
    <form class="form-horizontal" method="POST" action="">
        {{csrf_field()}}
        <div class="form-group" id="form_ajout_com_journalier_formateur">
            <div class="row" id="commentaire_journalier_formation">
                <div class="offset-lg-3 col-lg-6">
                    <select class="custom-select" id="select_formation_com_journalier" name="formation">
                        <option value="" disabled selected>Sélectionner une formation</option>
                        @foreach($formations as $formation)
                        <option value="{{$formation->id}}">{{$formation->nom}}</option> 
                        @endforeach    
                    </select>
                    <textarea class="form-control" id="zone_text_com_jour" placeholder="Donnez votre ressenti globale sur le groupe de formation sélectionné" rows="5" name="contenu_commentaire"></textarea>
                    <button type="submit" id="btn_valider_com_jour" class="btn btn-outline-primary">AJOUTER COMMENTAIRE</button>
                </div>
            </div>  
        </div>
    </form>
</div>
@foreach($formations as $formation)

            Formation en cours : {{$formation->nom}} du {{\Carbon\Carbon::parse($formation->date_debut)->format('d/m/Y')}} au {{\Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y')}}

        @endforeach
@endsection