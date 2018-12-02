<?php

namespace JR_Formation\Http\Controllers;

use JR_Formation\Client;
use JR_Formation\Formation;
use JR_Formation\Apprenant;
use Illuminate\Http\Request;
use JR_Formation\User;
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


    public function index()
    {
        $users = User::all();
        $dateJour = date('Y-m-d');

        $idClient = auth()->user()->id;

        $formations = Formation::where('client_id1', '=', $idClient)
                                ->orWhere('client_id2', $idClient)
                                ->orWhere('client_id3', $idClient)
                                ->orWhere('client_id4', $idClient)
                                ->orWhere('client_id5', $idClient)
                                ->get();

        $formationsTerminees = Formation::where('date_fin', '<=', $dateJour)
                                        ->where('client_id1', '=', $idClient)
                                        ->orWhere('client_id2', $idClient)
                                        ->orWhere('client_id3', $idClient)
                                        ->orWhere('client_id4', $idClient)
                                        ->orWhere('client_id5', $idClient)
                                        ->where('impact_formation', '=', 0)
                                        ->get();


        foreach ($formations as $formation) {
            
            $apprenants = Apprenant::where('formation_id','=',$formation->id)->get();

            // return $apprenants;

            $formation->setAttribute('apprenants', $apprenants);

            foreach ($apprenants as $apprenant) {
            
                $users = User::where('id','=',$apprenant->user_id)->get();

                $apprenant->setAttribute('users', $users);

            }
     
        }

        return view('interface_client', ['formations' => $formations, 'formations_terminees' => $formationsTerminees]);
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
            
            $apprenants = Apprenant::where('formation_id','=',$formation->id)->get();

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

        $infosApprenant = Apprenant::where('user_id', $idApprenant)->first(); //Infos apprenant de l'apprenant.

        $embaucheOuNon = $request->embauche_ou_non; //Recuperation de la valeur de la checkbox embauche_ou_nom.

        $motifNonEmbauche = $request->motif_non_embauche; //Contenu du motif si apprenant non embauche

        $embaucheA2Mois = $request->embauche_2_mois; // Valeur checkbox embauche_2_mois.

        $embaucheA6Mois = $request->embauche_6_mois; // Valeur checkbox embauche_6_mois.

        $motifPredefini2Mois = $request->motif_predefini;

        $motifNonEmbauche2Mois = $request->motif_non_embauche_2_mois; //Contenu motif non_embauche_2_mois.

        $motifNonEmbauche6Mois = $request->motif_non_embauche_6_mois; //Contenu motif non_embauche_6_mois.

        $non = 'non';

        $oui = 'oui';

        // return array($idApprenant, $embaucheOuNon, $motifNonEmbauche, $embaucheA2Mois, $embaucheA6Mois, $motifNonEmbauche2Mois, $motifNonEmbauche6Mois, $motifPredefini2Mois);

        if ($idApprenant == null) {

           return redirect()->back()->with('error', 'Vous n\'avez pas sélectionné d\'apprenant!');
        }

        if ($embaucheOuNon != null && $dateEmbauche == null) {
            
            return redirect()->back()->with('error', 'Veuillez indiquer une date en cas d\'embauche!');
        }

        if ($embaucheOuNon == null && $motifNonEmbauche == null) {
            
            return redirect()->back()->with('error', 'Veuillez saisir un motif si l\'apprenant n\'a pas été embauché!');
        }

        if ($embaucheOuNon != null && $motifNonEmbauche != null) {
            
            return redirect()->back()->with('error', 'Aucun motif nécéssaire si l\'apprenant a été embauché!');

        }

        if ($embaucheOuNon == null && $motifNonEmbauche != null) {
            
            DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update([

                'motif_non_embauche' => $motifNonEmbauche,
                'embauche_2_mois' => $non,
                'embauche_6_mois' => $non

                ]);

            return redirect()->back()->with('success', 'Merci pour votre participation!');

        }

        if ($embaucheOuNon != null && $motifNonEmbauche == null) {
            
            DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['date_embauche' => $dateEmbauche]);


            if ($embaucheA2Mois != null && $motifPredefini2Mois == null && $motifNonEmbauche2Mois == null) {

                
                DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['embauche_2_mois' => $oui]);

            }
            else{

                DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update([

                    'embauche_2_mois' => $non,
                    'motif_predefini' => $motifPredefini2Mois,
                    'motif_non_embauche_2_mois' => $motifNonEmbauche2Mois

                    ]);
            }

            if ($embaucheA6Mois != null && $motifPredefini2Mois == null && $motifNonEmbauche2Mois == null) {


                DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['embauche_6_mois' => $oui]);

            }
            else{

                DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update([

                    'embauche_6_mois' => $non,
                    'motif_non_embauche_6_mois' => $motifNonEmbauche6Mois

                    ]);
            }


            return redirect()->back()->with('success', 'Merci pour votre participation!');

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
        $resultObjectif3 = $request->radio3;

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

        $intituleIndicQuanti1 = 'Organisation du travail et cohésion d’équipe';
        $resultIndicQuanti1 = $request->evol1;

        $intituleIndicQuanti2 = 'Sécurité au travail (respect de règles, accidents du travail…)';
        $resultIndicQuanti2 = $request->evol2;

        $intituleIndicQuanti3 = 'Utilisation des supports écrits professionnels';
        $resultIndicQuanti3 = $request->evol2;

        $intituleIndicQuanti4 = 'Respect des normes qualité et environnemental';
        $resultIndicQuanti4 = $request->evol4;

        $intituleIndicQuanti5 = 'Qualité de la relation client / usager';
        $resultIndicQuanti5 = $request->evol5;

        $intituleIndicQuanti6 = 'Fidélisation et/ou maintien dans l’emploi';
        $resultIndicQuanti6 = $request->evol6;

        // return array($objectif1, $resultObjectif1, $objectif2, $resultObjectif2, $objectif3, $resultObjectif3, $objectif4, $resultObjectif4, $indicQuali1, $constatIndic1, $resultIndic1, $constatFinalIndic1, $indicQuali2, $constatIndic2, $resultIndic2, $constatFinalIndic2, $indicQuali3, $constatIndic3, $resultIndic3, $constatFinalIndic3, $indicQuali4, $constatIndic4, $resultIndic4, $constatFinalIndic4, $indicQuali5, $constatIndic5, $resultIndic5, $constatFinalIndic5, $intituleIndicQuanti1, $resultIndicQuanti1, $intituleIndicQuanti2, $resultIndicQuanti2, $intituleIndicQuanti3, $resultIndicQuanti3, $intituleIndicQuanti4, $resultIndicQuanti4, $intituleIndicQuanti5, $resultIndicQuanti5, $intituleIndicQuanti6, $resultIndicQuanti6,);


        if ($entreprise == null || $hierarchieClient == null || $fonctionClient == null || $formation == null) {
        
            return redirect()->back()->with('error', 'Merci de compléter la section "identification"!');
        }

        if ($objectif1 == null || $resultObjectif1 == null || $objectif2 == null || $resultObjectif2 == null || $indicQuali1 == null || $constatIndic1 == null || $resultIndic1 == null || $constatFinalIndic1 == null || $intituleIndicQuanti1 == null || $resultIndicQuanti1 == null || $intituleIndicQuanti2 == null || $resultIndicQuanti2 == null || $intituleIndicQuanti3 == null || $resultIndicQuanti3 == null || $intituleIndicQuanti4 == null || $resultIndicQuanti4 == null || $intituleIndicQuanti5 == null || $resultIndicQuanti5 == null || $intituleIndicQuanti6 == null || $resultIndicQuanti6 == null) {
            
            return redirect()->back()->with('error', 'Merci de compléter au moins 2 objectifs de progrès fixe et 1 indicateur quantitatif!');

        }
        else{

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

            Mail::to('houselstein.thibaud@gmail.com')->send(new ImpactFormation($array_file));

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


        $client = new Client;

        $client->nom = $request->nom_client;
        $client->email = $request->email_client;
        $client->numero_telephone = $request->tel_client;
        $client->mdp = $request->mdp;

        $client->save();

        return redirect('/home');



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
