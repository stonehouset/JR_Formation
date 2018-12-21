@extends('layouts.menu')

@section('content')
<body>
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
        <div class="row" id="titre_row_interface_formateur"> 
            <div class="offset-lg-4 col-lg-4">     
                <h4 id="titre_interface_formateur">
                    Interface Formateur
                </h4>    
            </div>
        </div>   
        <div class="row" id="row_principale_interface_formateur">       
            <div class="col-lg-7">  
                <div class="card-header" id="header_tableau_apprenants_formateur">    
                    Apprenants 
                    <input type="text" id="input_form" onkeyup="search2()"  placeholder="recherche par groupe" title="cherche formateur">
                </div>
                <div id="tab_infos_interface_formateur">
                    <table id="table_tab_formateur" class="table table-striped table">
                        <thead id="head_tab_apprenant_formateur">
                            <tr >
                                <th scope="col">Formation</th>
                                <th scope="col">Prénom / Nom</th>
                                <th scope="col">Fin formation</th>
                                <th scope="col">eMail</th> 
                                <th scope="col">Téléphone</th>                                            
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formations as $formation)
                                @foreach($formation->apprenants as $apprenant)
                                    @foreach($apprenant->users as $user)
                                    <tr id="td"> 
                                        <td class="td">{{$apprenant->groupe_formation}}</td>  
                                        <td class="td">{{$user->prenom}} {{$user->nom}}</td>  
                                        <td class="td">{{\Carbon\Carbon::parse($formation->date_fin)->format('d/m/Y')}}</td>  
                                        <td class="td">{{$user->email}}</td>
                                        <td class="td">{{$user->numero_telephone}}</td>                                    
                                    </tr>
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>            
                </div>                                             
            </div>
            <div class="col-lg-5" id="com_formateur_to_apprenant">            
                <div class="card" id="card_actions_formateur">         
                    <form id="form_register_commentaire" method="POST" action="{{ route('commentaire') }}">
                    {{ csrf_field() }} 
                        <select class="custom-select" id="inputGroupSelectapp" required name="nom_apprenant_com">
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
                            <textarea class="form-control" id="exampleFormControlTextareaApp" placeholder="Ecrivez un message à propos de l'apprenant sélectionné (200 caractères maximum)." required rows="3" maxlength="200" name="contenu_commentaire"></textarea>
                        </div>
                        <button type="submit" id="btn_ajouter_com_formateur_to_apprenant" class="btn btn-outline-primary">
                            <div id="label_btn_add_com_forma">
                                Ajouter
                            </div>
                            <div class="loader" id="loader1"></div>
                        </button>
                    </form> 
                    <button class="btn btn-outline-primary" disabled="true" id="label_retard_absence">Signalement retard/absence</button>
                    <form id="form_absence_retard" method="POST" action="{{ route('absence_retard') }}">
                        {{ csrf_field() }} 
                        <div class="row">
                            <div class="col-lg-6">
                                <select class="custom-select" required id="select_nom_apprenant_absouret" name="nom_apprenant_absence_retard">
                                    <option disabled selected>Apprenant</option>
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
                                <select class="custom-select" id="select_absence_retard_apprenant" required name="absence_ou_retard">
                                    <option disabled selected>Retard/Absence</option>
                                    <option value="1">Retard</option>
                                    <option value="2">Absence</option>     
                                </select>     
                            </div>
                        </div>
                        <button type="submit" id="btn_valider_retard_absence" class="btn btn-outline-primary">
                            <div id="label_btn_add_absret_forma">
                                SIGNALER
                            </div>
                            <div class="loader" id="loader2"></div>
                        </button>
                    </form>
                    <button class="btn btn-outline-primary" disabled="true" id="label_note">Attribuer une note</button>
                    <form id="form_register_note" method="POST" action="{{ route('note_apprenant')}}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6">
                                <select class="custom-select" id="select_ajout_note_apprenant" required name="nom_apprenant_note">
                                    <option disabled selected>Apprenant</option>
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
                                <input id="note_apprenant" type="number" class="form-control" name="note_apprenant" value="" min="0" max="20" required placeholder="/20">
                            </div>
                        </div>
                        <button type="submit" id="btn_valider_note" class="btn btn-outline-primary">
                            <div id="label_btn_add_note_forma">
                                Ajouter
                            </div>
                            <div class="loader" id="loader3"></div>
                        </button>
                    </form>
                </div>                     
            </div>     
        </div>
        <br>
        <div id="accordion" class="accordion_formateur1">
            <div class="card" id="card_com_jour">
                <div class="card-header" id="headingTen">
                    <h5 class="mb-0">
                        <button class="btn btn-link" id="header_com_groupe" data-toggle="collapse" data-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        Commentaire de groupe 
                        </button>
                    </h5>
                </div>
                <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordion">
                    <form class="form-horizontal" method="POST" action="{{ route('commentaire_journalier')}}" id="form_com_jour_forma">
                        {{csrf_field()}}
                        
                        <div class="row" id="commentaire_journalier_formation">
                            <div class="offset-lg-3 col-lg-6">
                                <select class="custom-select" required id="select_formation_com_journalier" name="formation">
                                    <option disabled selected>Sélectionnez une formation</option>
                                    @foreach($formations as $formation)
                                    <option value="{{$formation->id}}">{{$formation->nom}}</option> 
                                    @endforeach    
                                </select>
                                <textarea class="form-control" required id="zone_text_com_jour" placeholder="Donnez votre ressenti globale de la journée sur le groupe de formation sélectionné (200 caractères max). " rows="5" name="contenu_commentaire" maxlength="200"></textarea>
                                <button type="submit" id="btn_valider_com_jour" class="btn btn-outline-primary">
                                    <div id="label_btn_add_come_form_forma">
                                        Ajouter
                                    </div>
                                    <div class="loader" id="loader4"></div>
                                </button>
                            </div>
                        </div>  
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection