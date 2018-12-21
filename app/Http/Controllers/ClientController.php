<?php

namespace JR_Formation\Http\Controllers;

use JR_Formation\Client;
use JR_Formation\Formation;
use JR_Formation\Apprenant;
use Illuminate\Http\Request;
use JR_Formation\User;
use JR_Formation\Questionnaire;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use JR_Formation\Mail\ImpactFormation;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use File;
use DB;
use DateTime;
use Carbon\Carbon;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->middleware('auth');
        
    }

    public function index() //Affichage de la vue interface_client avec les donnees de l'utilsateur connecte.
    {
        $users = User::all();
        $dateJour = date('Y-m-d'); 

        $idClient = auth()->user()->id;
        $formations = Formation::where('client_id1', '=', $idClient) //Toutes les formations d'un client.
                                ->orWhere('client_id2', $idClient)
                                ->orWhere('client_id3', $idClient)
                                ->orWhere('client_id4', $idClient)
                                ->orWhere('client_id5', $idClient)
                                ->get();
     ;
        $formationsTerminees = Formation::where('date_fin', '<=', $dateJour)
                                        ->where('impact_formation', '=', '0')
                                        ->where(function($q) use ($idClient){
                                              $q->where('client_id1', $idClient)
                                                ->orWhere('client_id2', $idClient)
                                                ->orWhere('client_id3', $idClient)
                                                ->orWhere('client_id4', $idClient)
                                                ->orWhere('client_id5', $idClient);
                                          })
                                        ->get();   


        $impactFormation = Questionnaire::where('id',4)->first(); 

        foreach ($formations as $formation) {
            
            $apprenants = Apprenant::where('formation_id','=',$formation->id)->get(); //Recuperation des apprenants dune formation.
                                     
            $formation->setAttribute('apprenants', $apprenants);

            foreach ($apprenants as $apprenant) {
            
                $users = User::where('id','=',$apprenant->user_id)->get(); //Recuperation donnes user des apprenants.

                $apprenant->setAttribute('users', $users);


                if ($apprenant->date_embauche != null && $apprenant->motif_non_embauche == null) {

                    $apprenant->setAttribute('embauche', 'oui');
                }

                if($apprenant->date_embauche == null && $apprenant->motif_non_embauche != null){

                    $apprenant->setAttribute('embauche', 'non');
                }

                if($apprenant->date_embauche == null && $apprenant->motif_non_embauche == null){

                    $apprenant->setAttribute('embauche', '-');
                    $apprenant->setAttribute('embauche2Mois', '-');
                    $apprenant->setAttribute('embauche6Mois', '-');
                }


                if($apprenant->date_embauche != null && $apprenant->motif_non_embauche == null){

                    $apprenant->setAttribute('embauche', 'oui');
                    $apprenant->setAttribute('embauche2Mois', $apprenant->embauche_2_mois);
                    $apprenant->setAttribute('embauche6Mois', $apprenant->embauche_6_mois);
                }

                if($apprenant->date_embauche == null && $apprenant->motif_non_embauche != null){

                    $apprenant->setAttribute('embauche', 'non');
                    $apprenant->setAttribute('embauche2Mois', $apprenant->embauche_2_mois);
                    $apprenant->setAttribute('embauche6Mois', $apprenant->embauche_6_mois);
                }

            }
     
        }

        return view('interface_client', ['formations' => $formations, 'formations_terminees' => $formationsTerminees, 'impactFormation' => $impactFormation, 'dateJour' => $dateJour]);
    }

    public function getDownload()
    {
        
        $file = public_path(). '\file\eval_a_froid_action_de_formation.pdf';

        // return $file;
        
        $headers = [

              'Content-Type' => 'application/pdf',

           ];

        return response()->download($file, 'eval_a_froid.pdf', $headers);
    }

    public function extractCsv()
    {
 
        $users = User::all();

        $idClient = auth()->user()->id;

        $formations = Formation::where('client_id', '=', $idClient)->get();

        foreach ($formations as $formation) {
            
            $apprenants = Apprenant::where('formation_id','=',$formation->id)->orderBy('created_at','desc')->get();

            // return $apprenants;

            $formation->setAttribute('apprenants', $apprenants);

            foreach ($apprenants as $apprenant) {
            
                $users = User::where('id','=',$apprenant->user_id)->get();

                $apprenant->setAttribute('users', $users);

                foreach ($users as $user) {

                    $dateDebut = Carbon::parse($apprenant->debut_tutorat)->format('d/m/Y');
                    $dateFin = Carbon::parse($apprenant->fin_tutorat)->format('d/m/Y');
 
                    $userData[] = [
                        
                        'Nom' => $user->nom,
                        'Prenom' => $user->prenom,
                        'Lieu de naissance' => $apprenant->lieu_naissance,
                        'Nationalite' => $apprenant->nationalite,
                        'ID Pole Emploi' => $apprenant->id_pole_emploi,  
                        'N° Securite Sociale' => $apprenant->numero_ss,
                        'eMail' => $user->email,
                        'Telephone' => $user->numero_telephone, 
                        'Formation' => $apprenant->groupe_formation, 
                        'Date debut de formation' => $dateDebut, 
                        'Date fin de formation' => $dateFin,     
                    
                    ];
                }
            }

            return $userData;

            if ($userData == null) {

                return redirect()->back()->with('error', 'le tableau est vide!');

            }else{

                Excel::create('users', function ($excel) use ($userData) {
     
                    // Build the spreadsheet, passing in the users array
                    $excel->sheet('sheet1', function ($sheet) use ($userData) {

                        $sheet->fromArray($userData);

                    });
     
                })->download('xlsx');
            }
     
        }
        
    }

    public function suiviApprenant(Request $request)// Fonction d'ajout des donnees du suivi d'un apprenant en entreprise.
    {

        $idApprenant = $request->id_apprenant; // ID de l'apprenant choisi.
        $dateEmbauche = $request->date_embauche;
        $userApprenant = User::where('id', $idApprenant)->first(); //Infos user de l'apprenant.
        $apprenantEmbauche = Apprenant::where('user_id', $idApprenant)->first(); //Infos apprenant de l'apprenant.
        $embaucheOuNon = $request->embauche_ou_non; //Recuperation de la valeur de la checkbox embauche_ou_nom.
        $motifNonEmbauche = $request->motif_non_embauche; //Contenu du motif si apprenant non embauche
        $embaucheA2Mois = $request->embauche_2_mois; // Valeur checkbox embauche_2_mois.
        $embaucheA6Mois = $request->embauche_6_mois; // Valeur checkbox embauche_6_mois.
        $motifPredefini2Mois = $request->motif_predefini;
        $motifNonEmbauche2Mois = $request->motif_non_embauche_2_mois; //Contenu motif non_embauche_2_mois.
        $motifNonEmbauche6Mois = $request->motif_non_embauche_6_mois; //Contenu motif non_embauche_6_mois.
        $non = 'non';
        $oui = 'oui';

        if ($idApprenant == null) {

           return redirect()->back()->with('error', 'Vous n\'avez pas sélectionné d\'apprenant!');
        }

        if ($embaucheOuNon == null && $motifNonEmbauche == null) {
            
             return redirect()->back()->with('error', 'Veuillez saisir un motif si l\'apprenant n\'a pas été embauché!');
        }

        if ( strlen($motifNonEmbauche) > 100 || strlen($motifNonEmbauche2Mois) > 100 || strlen($motifNonEmbauche6Mois) > 100) {
            
            return redirect()->back()->with('error', 'Un motif ne doit pas faire plus de 100 caractères!');
        }

        if ($embaucheOuNon != null && $motifNonEmbauche != null) {
            
            return redirect()->back()->with('error', 'Aucun motif nécéssaire si l\'apprenant a été embauché!');
        }

        if ($apprenantEmbauche->motif_non_embauche != null && $motifNonEmbauche == null && $apprenantEmbauche->date_embauche == null) {

            return redirect()->back()->with('error', 'Vous avez déja signalé cet apprenant comme non embauché!');
        }

        if ($apprenantEmbauche->date_embauche != null && $motifNonEmbauche != null) {

            return redirect()->back()->with('error', 'Vous avez déja signalé cet apprenant comme embauché!');
        }  

        if ($embaucheOuNon == null && $motifNonEmbauche != null && $apprenantEmbauche->date_embauche == null) {
            
            DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update([

                'motif_non_embauche' => $motifNonEmbauche,
                'embauche_2_mois' => $non,
                'embauche_6_mois' => $non

                ]);

            return redirect()->back()->with('success', 'Suivi mis à jour, merci!');

        }
        else if($motifNonEmbauche == null){

            if ($embaucheOuNon != null && $dateEmbauche == null && $apprenantEmbauche->date_embauche != null) {
            

                DB::table('apprenants')->where('user_id', $idApprenant)->update(['date_embauche' => $apprenantEmbauche->date_embauche]);

            }
            if ($embaucheOuNon != null && $dateEmbauche == null && $apprenantEmbauche->date_embauche == null) {
            
                return redirect()->back()->with('error', 'Veuillez saisir une date en cas d\'embauche!');
            }
            else if($embaucheOuNon != null && $dateEmbauche == null && $apprenantEmbauche->date_embauche != null){

                $dateEmbauche = $apprenantEmbauche->date_embauche;
            }
            else if($embaucheOuNon != null && $dateEmbauche != null && $apprenantEmbauche->date_embauche == null){

                DB::table('apprenants')->where('user_id', $idApprenant)->update([

                    'date_embauche' => $dateEmbauche,
                    'embauche_2_mois' => '-',
                    'embauche_6_mois' => '-'

                    ]);
            }

            if ($embaucheA2Mois != null && $motifPredefini2Mois != null) {
                
                return redirect()->back()->with('error', 'Aucun motif nécessaire si l\'apprenant est toujours présent après 2 mois!');
            }

            if ($embaucheA2Mois != null && $motifNonEmbauche2Mois != null) {
                
                return redirect()->back()->with('error', 'Aucun motif nécessaire si l\'apprenant est toujours présent après 2 mois!');
            }

            if ($apprenantEmbauche->embauche_2_mois != null && $embaucheA2Mois != null) {
                
                DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['embauche_2_mois' => $apprenantEmbauche->embauche_2_mois]);
            }

            if ($embaucheA2Mois != null && $motifPredefini2Mois == null && $motifNonEmbauche2Mois == null) {
                
                DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['embauche_2_mois' => $oui]);
                
            }

            if ($apprenantEmbauche->embauche_2_mois == null && $embaucheA2Mois == null && $motifPredefini2Mois == null && $motifNonEmbauche2Mois == null) {
                
                DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['embauche_2_mois' => '-']);     
            }

            if($apprenantEmbauche->embauche_2_mois == '-' && $embaucheA2Mois == null && $motifPredefini2Mois != null && $motifNonEmbauche2Mois != null){

                DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update([

                    'embauche_2_mois' => $non,
                    'motif_predefini' => $motifPredefini2Mois,
                    'motif_non_embauche_2_mois' => $motifNonEmbauche2Mois,
                    'embauche_6_mois' => $non

                ]);

            }

            if ($embaucheA6Mois != null && $motifNonEmbauche6Mois != null) {
                
                return redirect()->back()->with('error', 'Aucun motif nécessaire si l\'apprenant est toujours présent après 6 mois!');
            }

            if ($apprenantEmbauche->embauche_6_mois != null && $embaucheA6Mois != null) {
                
                DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['embauche_6_mois' => $apprenantEmbauche->embauche_6_mois]);
            }

            if ($apprenantEmbauche->embauche_6_mois == null && $embaucheA6Mois == null && $motifNonEmbauche6Mois == null) {
                
                DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['embauche_6_mois' => '-']);
            }

            if ($embaucheA6Mois != null  && $motifNonEmbauche6Mois == null && $apprenantEmbauche->embauche_6_mois == null) {
                
                DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['embauche_6_mois' => $oui]);                
            }

            if ($embaucheA6Mois == null  && $motifNonEmbauche6Mois != null && $apprenantEmbauche->embauche_6_mois == null || $apprenantEmbauche->embauche_6_mois == '-') {
                
                DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update([  
                                                
                    'motif_non_embauche_6_mois' => $motifNonEmbauche6Mois,
                    'embauche_6_mois' => $non

                ]);                
            }

            return redirect()->back()->with('success', 'Suivi mis à jour, merci!');

        }
     
    }

    public function impactFormation(Request $request){ //Fonction d'envoi du formulaire impact formation sur entreprise.

   
        $data;

        $formation = $request->nom_formation;

        $infoFormation = Formation::where('id', $formation)->first();

        $labelEntreprise = 'Entreprise';
        $labelFormation = 'Formation Suivie';
        $labelHierarchie = 'Hierarchie';

        $entreprise = $request->nom_entreprise;
        $hierarchieClient = $request->hierarchie_entreprise_id;
        $fonctionClient = $request->hierarchie_entreprise_fonction;
        $intituleFormation = $request->formation_suivie_entreprise_intitule;
        $dureeFormation = $request->formation_suivie_entreprise_duree;

        $objectif1 = $request->objectif1;
        $resultObjectif1 = $request->radio1;

        $objectif2 = $request->objectif2;
        $resultObjectif2 = $request->radio2;

        $objectif3 = $request->objectif3;
        $resultObjectif3 = $request->radio3;                               //Recuperation de tous les champs du formulaire.

        $objectif4 = $request->objectif4;
        $resultObjectif4 = $request->radio4;

        $indicQuali1 = $request->indic1;
        $constatIndic1 = $request->constat1;
        $resultIndic1 = $request->result1;
        $constatFinalIndic1 = $request->constat_final1;


        $indicQuali2 = $request->indic2;
        $constatIndic2 = $request->constat2;
        $resultIndic2 = $request->result2;
        $constatFinalIndic2 = $request->constat_final2;


        $indicQuali3 = $request->indic3;
        $constatIndic3 = $request->constat3;
        $resultIndic3 = $request->result3;
        $constatFinalIndic3 = $request->constat_final3;


        $indicQuali4 = $request->indic4;
        $constatIndic4 = $request->constat4;
        $resultIndic4 = $request->result4;
        $constatFinalIndic4 = $request->constat_final4;


        $indicQuali5 = $request->indic5;       
        $constatIndic5 = $request->constat5;
        $resultIndic5 = $request->result5;
        $constatFinalIndic5 = $request->constat_final5;

        $intituleIndicQuanti1 = '1';
        $resultIndicQuanti1 = $request->evol1;

        $intituleIndicQuanti2 = '2';
        $resultIndicQuanti2 = $request->evol2;

        $intituleIndicQuanti3 = '3';
        $resultIndicQuanti3 = $request->evol2;

        $intituleIndicQuanti4 = '4';
        $resultIndicQuanti4 = $request->evol4;

        $intituleIndicQuanti5 = '5';
        $resultIndicQuanti5 = $request->evol5;

        $intituleIndicQuanti6 = '6';
        $resultIndicQuanti6 = $request->evol6;

        if ($entreprise == null || $hierarchieClient == null || $fonctionClient == null || $formation == null) {
        
            return redirect()->back()->with('error', 'Merci de compléter la section "Identification"!');
        }

        $reps = array($entreprise,$hierarchieClient,$fonctionClient,$intituleFormation,$dureeFormation,$objectif1,$objectif2,$objectif3,$objectif4,$indicQuali1,$constatIndic1,$resultIndic1,$constatFinalIndic1,$indicQuali2,$constatIndic2,$resultIndic2,$constatFinalIndic2,$indicQuali3,$constatIndic3,$resultIndic3,$constatFinalIndic3,$indicQuali4,$constatIndic4,$resultIndic4,$constatFinalIndic4,$indicQuali5,$constatIndic5,$resultIndic5,$constatFinalIndic5);

        foreach ($reps as $rep) {

            if (strlen($rep) > 100) {
            
                return redirect()->back()->with('error', 'Les champs ne doivent pas contenir plus de 100 caractères!');
            }
        }


        if ($objectif1 == null || $resultObjectif1 == null || $objectif2 == null || $resultObjectif2 == null || $indicQuali1 == null || $constatIndic1 == null || $resultIndic1 == null || $constatFinalIndic1 == null || $intituleIndicQuanti1 == null || $resultIndicQuanti1 == null || $intituleIndicQuanti2 == null || $resultIndicQuanti2 == null || $intituleIndicQuanti3 == null || $resultIndicQuanti3 == null || $intituleIndicQuanti4 == null || $resultIndicQuanti4 == null || $intituleIndicQuanti5 == null || $resultIndicQuanti5 == null || $intituleIndicQuanti6 == null || $resultIndicQuanti6 == null) {
            
            return redirect()->back()->with('error', 'Merci de compléter au moins 2 objectifs de progrès fixe et 1 indicateur quantitatif!');

        }
        else{ //Si section identification ok et minimum champs complétés ok, creation + envoi du fichier excel.

            $intituleFormation = $infoFormation->nom;

            $datetime1 = new DateTime($infoFormation->date_debut);
            $datetime2 = new DateTime($infoFormation->date_fin);
            $interval = $datetime1->diff($datetime2);
            $nbjour = $interval->format('%d'); //Retourne le nombre de jours

            $dureeFormation = $nbjour;

            if ($nbjour < 5) {
                
                $dureeFormation = $nbjour.' jours';
            }
            else if ($nbjour >= 5 && $nbjour <= 7) {
                
                $dureeFormation = '1 semaine';
            }
            else if ($nbjour > 7 && $nbjour <= 12) {
                
                $dureeFormation = '2 semaines';

            }
            else if ($nbjour > 12 && $nbjour <= 19) {
                
                $dureeFormation = '3 semaines';

            }else if ($nbjour > 19) {
                
                $dureeFormation = 'Plus de 3 semaines';
            }

            $arrayQuestions = array($labelEntreprise, $labelHierarchie, $labelFormation, $objectif1, $objectif2, $objectif3, $objectif4, $indicQuali1, $indicQuali2, $indicQuali3, $indicQuali4, $indicQuali5, $intituleIndicQuanti1, $intituleIndicQuanti2, $intituleIndicQuanti3, $intituleIndicQuanti4, $intituleIndicQuanti5, $intituleIndicQuanti6);
          
            $arrayReponses = array($entreprise, $hierarchieClient, $fonctionClient, $intituleFormation, $dureeFormation, $resultObjectif1, $resultObjectif2, $resultObjectif3, $resultObjectif4, $constatIndic1, $resultIndic1, $constatFinalIndic1, $constatIndic2, $resultIndic2, $constatFinalIndic2, $constatIndic3, $resultIndic3, $constatFinalIndic3, $constatIndic4, $resultIndic4, $constatFinalIndic4, $constatIndic5, $resultIndic5, $constatFinalIndic5, $resultIndicQuanti1, $resultIndicQuanti2, $resultIndicQuanti3, $resultIndicQuanti4, $resultIndicQuanti5, $resultIndicQuanti6);

            $j = 0;

            for ($i = 0; $i < count($arrayQuestions); $i++) { 
               
                $data[$i]['Questions/intitulé'] = $arrayQuestions[$i];
                $data[$i]['Réponses'] = $arrayReponses[$j];

                $j++;

                if ($i == 1 || $i == 2 || $i == 7 || $i == 8 || $i == 9 || $i == 10 || $i == 11) {
      
                    $data[$i]['Compléments réponses 1'] = $arrayReponses[$j++];

                    if ($i == 7 || $i == 8 || $i == 9 || $i == 10 || $i == 11) {

                        $data[$i]['Compléments réponses 2'] = $arrayReponses[$j++];
                    }
                }                       
            }

            $file = Excel::create('impact_formation', function ($excel) use ($data) {
      
                $excel->sheet('sheet1', function ($sheet) use ($data) {

                    $sheet->fromArray($data);

                });

            })->save('xlsx', storage_path('app/public'));

            $array_file = [];
            array_push($array_file, $file);

            try{

                Mail::to('ju.rivet1@gmail.com')->send(new ImpactFormation($array_file));
            }
            catch(\Exception $e){

                File::delete('storage/impact_formation.xlsx');

                return redirect()->back()->with('error', 'une erreur est survenue lors de l\'envoi du formulaire, veuillez réessayer plus tard.'); 
            }
            
            File::delete('storage/impact_formation.xlsx');

            DB::table('formations')->where('id' ,'=' , $formation)->update(['impact_formation' => 1]);

            return redirect()->back()->with('success', 'Formulaire envoyé, merci!');
        }

    }
    /**
     * Show the form for creating a new resource.
     *''
     * @return \Illuminate\Http\Response
     */
    public function create(array $data)
    {

       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // $client = new Client;

        // $client->nom = $request->nom_client;
        // $client->email = $request->email_client;
        // $client->numero_telephone = $request->tel_client;
        // $client->mdp = $request->mdp;

        // $client->save();

        // return redirect('/home');



        //
    }
    /**
     * Display the specified resource.
     *
     * @param  \JR_Formation\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JR_Formation\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JR_Formation\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JR_Formation\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
