<?php
namespace JR_Formation\Http\Controllers;

use Illuminate\Http\Request;
use JR_Formation\User;
use JR_Formation\Apprenant;
use JR_Formation\Formation;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {

        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $users = User::all();
        $statut = null;
        $groupes_formation = Apprenant::distinct()->get(['groupe_formation']);
        $clients = User::where('role', '=', '2')->get();
        $formateurs = User::where('role', '=', '1')->get();
        $apprenants = User::where('role', '=', '0')->get();
        $formations = Formation::all();

        foreach ($formations as $formation) {

            $client1 = User::where('id','=',$formation->client_id1)->first();
            $client2 = User::where('id','=',$formation->client_id2)->first();
            $client3 = User::where('id','=',$formation->client_id3)->first();
            $client4 = User::where('id','=',$formation->client_id4)->first();
            $client5 = User::where('id','=',$formation->client_id5)->first();
            $formateur = User::where('id','=',$formation->formateur_id)->first();
            $formation->setAttribute('client1', $client1);
            $formation->setAttribute('client2', $client2);
            $formation->setAttribute('client3', $client3);
            $formation->setAttribute('client4', $client4);
            $formation->setAttribute('client5', $client5);
            $formation->setAttribute('formateur', $formateur);
            
        }
        // return $groupes_formation;
        return view('home', ['users' => $users, 'clients' => $clients, 'formateurs' => $formateurs, 'groupes_formation' => $groupes_formation, 'formations' => $formations, 'apprenants' => $apprenants]);
    }
    public function profil()
    {

        $roleUser = auth()->user()->role;
        $dataApprenant = Apprenant::where('user_id','=',auth()->user()->id)->first();
        $statut = null;

        if ($roleUser == 0) {

            $statut = "Apprenant";

        }elseif ($roleUser == 1) {

            $statut = "Formateur";

        }elseif ($roleUser == 2) {

            $statut = "Client";

        }elseif ($roleUser == 3) {

            $statut = "Admin";

        }

        return view('profil',['statut' => $statut, 'apprenant' => $dataApprenant]);
    }

    public function questionnaireFormation() // Affichage de la page compte rendu formateur avec Formations sans eval
    {
        $aujourdhui = date('Y-m-d');
        $idFormateur = auth()->user()->id;
        $formateur = User::where('id' ,'=', $idFormateur)->first();   
        $dateNow = Carbon::now();
        $formationsTermineesSansEval = Formation::where('date_fin', '<=', $aujourdhui)
                           ->where('compte_rendu_formateur', '=', 0)
                           ->where('formateur_id', '=', $idFormateur)
                           ->get();

        if ($formationsTermineesSansEval == null) {

            return view('questionnaire_formation');
        }


        return view('questionnaire_formation',['formations' => $formationsTermineesSansEval]);
    }

    public function extractApprenantCsv()
    {
 
        $userApprenants = User::where('role', '=', '0')->get();   

        foreach ($userApprenants as $userApprenant) {

            $apprenants = Apprenant::where('user_id','=', $userApprenant->id)->get();
            $userApprenant->setAttribute('apprenants', $apprenants);

            foreach ($apprenants as $apprenant) {

                $formations = Formation::where('id', '=', $apprenant->formation_id)->get();
                $apprenant->setAttribute('formations', $formations);

                foreach ($formations as $formation) {

                    $formateurs = User::where('id','=',$formation->formateur_id)->get();

                    foreach ($formateurs as $formateur) {

                        $nomFormateur =  $formateur->prenom.' '.$formateur->nom;
                        
                    }    
                }

                $dateDebut = Carbon::parse($apprenant->debut_tutorat)->format('d/m/Y');
                $dateFin = Carbon::parse($apprenant->fin_tutorat)->format('d/m/Y');
                $dateNaissance = Carbon::parse($apprenant->date_naissance)->format('d/m/Y');

                $userData[] = [
                    
                    'Nom' => $userApprenant->nom,
                    'Prenom' => $userApprenant->prenom,
                    'Sexe' => $apprenant->sexe,
                    'Nationalite' => $apprenant->nationalite,
                    'Date Naissance' => $dateNaissance,
                    'Lieu Naissance' => $apprenant->lieu_naissance,
                    'Adresse' => $apprenant->adresse,
                    'eMail' => $userApprenant->email,
                    'Telephone' => $userApprenant->numero_telephone,
                    'ID Pole Emploi' => $apprenant->id_pole_emploi,  
                    'Formation' => $apprenant->groupe_formation,
                    'Formateur' => $nomFormateur, 
                    'Date debut de formation' => $dateDebut, 
                    'Date fin de formation' => $dateFin,  
                       
                ];       
            }
        }

        Excel::create('apprenants', function ($excel) use ($userData) {
 
            // Build the spreadsheet, passing in the users array
            $excel->sheet('sheet1', function ($sheet) use ($userData) {

                $sheet->fromArray($userData);

            });

        })->download('xlsx'); 
 
    }

    public function extractFormateurCsv()
    {

        $userFormateurs = User::where('role', '=', '1')->get();

        foreach ($userFormateurs as $formateur) {
            
            $formation = Formation::where('formateur_id','=',$formateur->id)->first();
            $formateur->setAttribute('formation', $formation);

            if ($formateur->formation == null) {
                
                $nomFormation = "Aucune";

            }else{

                $nomFormation = $formateur->formation->nom;

            }

            $userData[] = [
                            
                        'Nom' => $formateur->nom,
                        'Prenom' => $formateur->prenom,
                        'eMail' => $formateur->email,
                        'Telephone' => $formateur->numero_telephone,  
                        'Formation' => $nomFormation,  
                               
                    ];
        }

        Excel::create('formateurs', function ($excel) use ($userData) {
 
            // Build the spreadsheet, passing in the users array
            $excel->sheet('sheet1', function ($sheet) use ($userData) {

                $sheet->fromArray($userData);

            });

        })->download('xlsx');
    }

    public function changeUserPassword(Request $request) //Methode pour modifier le mot de passe d'un utilisateur via page profil.blade.php
    {

        $idUser = auth()->user()->id;

        $mdp = $request->motdepasse;
        $confirmMdp = $request->confirmPassword;

        if (strlen($mdp) < 6){

            return redirect()->back()->with('error', 'le mot de passe doit contenir au moins 6 caractères!');

        }
        elseif ($mdp === $confirmMdp){
            
            $password = bcrypt($mdp);

            User::where('id', $idUser)->update(['password' => $password]);

            return redirect()->back()->with('success', 'le mot de passe a été modifié!');
        }
        else{

            return redirect()->back()->with('error', 'les mots de passe ne correspondent pas!');
        }


    }
    
}