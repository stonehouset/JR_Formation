@extends('layouts.menu')

@section('content')
<form class="form-horizontal" method="POST" action="">
{{ csrf_field() }}
    @if ($dateNow <= $datePlus4Jours)
        <h4 style="color: white;text-align: center;margin-top: 1%;">Revenez le {{\Carbon\Carbon::parse($datePlus4Jours)->format('d/m/Y')}} pour répondre au questionnaire!</h4>
    @endif
    @if ($dateNow >= $datePlus4Jours) 
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-group">
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    <h6>Le formateur sait transmettre ses connaissances (maitrise son sujet, donne des exemples pratiques)</h6>
                    <input type="radio" name="radio1" value="mediocre">
                    <input type="radio" name="radio1" value="faible">
                    <input type="radio" name="radio1" value="satisfaisant">
                    <input type="radio" name="radio1" value="excellent">
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    <h6>Le formateur sait mobiliser les participants (donne envie d'apprendre, fait participer)</h6>
                    <input type="radio" name="radio2" value="mediocre">
                    <input type="radio" name="radio2" value="faible">
                    <input type="radio" name="radio2" value="satisfaisant">
                    <input type="radio" name="radio2" value="excellent">
                      
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    <h6>Le formateur sait s'adapter à chaque participant (personnalise son message, s'adapte au contexte de chacun)</h6>
                    <input type="radio" name="radio3" value="mediocre">
                    <input type="radio" name="radio3" value="faible">
                    <input type="radio" name="radio3" value="satisfaisant">
                    <input type="radio" name="radio3" value="excellent">       
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    <h6>Le formateur a des points forts</h6> 
                    <input type="radio" name="radio4" value="mediocre">
                    <input type="radio" name="radio4" value="faible">
                    <input type="radio" name="radio4" value="satisfaisant">
                    <input type="radio" name="radio4" value="excellent"> 
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    <h6>Les supports utilisés en formation étaient utiles pour apprendre (documents, vidéos)</h6>
                    <input type="radio" name="radio5" value="mediocre">
                    <input type="radio" name="radio5" value="faible">
                    <input type="radio" name="radio5" value="satisfaisant">
                    <input type="radio" name="radio5" value="excellent">
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    <h6>La progression pédagogique est adaptée (rythme, difficulté progressive, équilibre théorie/pratique...)</h6> 
                    <input type="radio" name="radio6" value="mediocre">
                    <input type="radio" name="radio6" value="faible">
                    <input type="radio" name="radio6" value="satisfaisant">
                    <input type="radio" name="radio6" value="excellent">      
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    <h6>L’alternance de moments de « théorie » avec des travaux pratiques vous a-t-elle semblé équilibrée</h6>
                    <input type="radio" name="radio7" value="mediocre">
                    <input type="radio" name="radio7" value="faible">
                    <input type="radio" name="radio7" value="satisfaisant">
                    <input type="radio" name="radio7" value="excellent">      
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    <h6>Le niveau du formateur vous a semblé correct</h6>
                    <input type="radio" name="radio8" value="mediocre">
                    <input type="radio" name="radio8" value="faible">
                    <input type="radio" name="radio8" value="satisfaisant">
                    <input type="radio" name="radio8" value="excellent">       
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    Le formateur a tenu un langage clair
                    <br>
                    <input type="radio" name="radio9" value="mediocre">
                    <input type="radio" name="radio9" value="faible">
                    <input type="radio" name="radio9" value="satisfaisant">
                    <input type="radio" name="radio9" value="excellent">
                </li>
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-group">
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    Le formateur a respecté le contenu du programme, 
                    il vous a aidé à atteindre les objectifs 
                    <br>
                    <input type="radio" name="radio10" value="mediocre">
                    <input type="radio" name="radio10" value="faible">
                    <input type="radio" name="radio10" value="satisfaisant">
                    <input type="radio" name="radio10" value="excellent">                           
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    Il y a eu une adaptation au rythme, au contenu
                    <br>
                    <input type="radio" name="radio11" value="mediocre">
                    <input type="radio" name="radio11" value="faible">
                    <input type="radio" name="radio11" value="satisfaisant">
                    <input type="radio" name="radio11" value="excellent">
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    La qualité des exemples cités
                    <br>
                    <input type="radio" name="radio12" value="mediocre">
                    <input type="radio" name="radio12" value="faible">
                    <input type="radio" name="radio12" value="satisfaisant">
                    <input type="radio" name="radio12" value="excellent">                           
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    Le niveau des aptitudes (élocution, postures, tenue)
                    <br>
                    <input type="radio" name="radio13" value="mediocre">
                    <input type="radio" name="radio13" value="faible">
                    <input type="radio" name="radio13" value="satisfaisant">
                    <input type="radio" name="radio13" value="excellent">
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    Le niveau de compétences et de disponibilité
                    <br>
                    <input type="radio" name="radio14" value="mediocre">
                    <input type="radio" name="radio14" value="faible">
                    <input type="radio" name="radio14" value="satisfaisant">
                    <input type="radio" name="radio14" value="excellent">
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    Globalement, j'ai été très satisfait(e) du formateur
                    <br>
                    <input type="radio" name="radio15" value="mediocre">
                    <input type="radio" name="radio15" value="faible">
                    <input type="radio" name="radio15" value="satisfaisant">
                    <input type="radio" name="radio15" value="excellent">
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    Si vous deviez suivre à nouveau une formation, le feriez-vous volontiers avec ce formateur ?
                    <br>
                    <input type="radio" name="radio16" value="mediocre">
                    <input type="radio" name="radio16" value="faible">
                    <input type="radio" name="radio16" value="satisfaisant">
                    <input type="radio" name="radio16" value="excellent">
                </li>
                <li class="list-group-item" style="border-color: white;background-color: #2D3F58;color: white">
                    Recommanderiez-vous ce formateur à un centre de formation ou à une entreprise ?
                    <br>
                    <input type="radio" name="radio17" value="mediocre">
                    <input type="radio" name="radio17" value="faible">
                    <input type="radio" name="radio17" value="satisfaisant">
                    <input type="radio" name="radio17" value="excellent">        
                </li> 
            </ul>
            <button type="submit" id="btn_validation_form_formateur" style="width: 100%;margin-top: 6%;border-color:green;margin-bottom: 1%;" class="btn btn-outline-primary">Valider le questionnaire</button> 
        </div>
    </div>
    @endif
</form>

@endsection