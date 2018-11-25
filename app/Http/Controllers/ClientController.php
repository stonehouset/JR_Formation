<?php

namespace JR_Formation\Http\Controllers;

use JR_Formation\Client;
use JR_Formation\Formation;
use JR_Formation\Apprenant;
use Illuminate\Http\Request;
use JR_Formation\User;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
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

    public function suiviApprenant(Request $request)
    {

        

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
