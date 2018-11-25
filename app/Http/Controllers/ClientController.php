<?php

namespace JR_Formation\Http\Controllers;

use JR_Formation\Client;
use JR_Formation\Formation;
use JR_Formation\Apprenant;
use Illuminate\Http\Request;
use JR_Formation\User;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DB;
use Carbon\Carbon;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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

            }
     
        }

        return view('interface_client', ['formations' => $formations]);
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
    /**
     * Show the form for creating a new resource.
     *
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
