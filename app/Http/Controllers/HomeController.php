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

        $aujourdhui = date('Y-m-d');
        $users = User::all();
        $statut = null;
        $groupes_formation = Apprenant::distinct()->get(['groupe_formation']);
        $clients = User::where('role', '=', '2')->get();
        $formateurs = User::where('role', '=', '1')->get();
        $apprenants = User::where('role', '=', '0')->get();

        $totalApprenants = count($apprenants);
        $EmbauchesTotal = Apprenant::where('date_embauche', '!=', null)->get();
        $nbEmbauchesTotal = $EmbauchesTotal->count();
        $pourcentageEmbauchesTotal = $nbEmbauchesTotal * 100/ $totalApprenants;

        $Embauches2moisTotal = Apprenant::where('embauche_2_mois', 'oui')->get();
        $nbEmbauches2moisTotal = $Embauches2moisTotal->count();
        $pourcentageEmbauches2MoisTotal = $nbEmbauches2moisTotal * 100/ $totalApprenants;

        $Embauches6moisTotal = Apprenant::where('embauche_2_mois', 'oui')->get();
        $nbEmbauches6moisTotal = $Embauches6moisTotal->count();
        $pourcentageEmbauches6MoisTotal = $nbEmbauches6moisTotal * 100/ $totalApprenants;

        $NonEmbauches = Apprenant::where('motif_non_embauche', '!=', null)->get();
        $nbNonEmbauches = $NonEmbauches->count();
        $pourcentageNonEmbauches = $nbNonEmbauches * 100/ $totalApprenants;

        // return array($nbEmbauchesTotal, $nbEmbauches2moisTotal, $nbEmbauches6moisTotal);
        //Formations en cours,

        $formations = Formation::where('date_fin', '>=', $aujourdhui)->get();

        foreach ($formations as $formation) {

            $client1 = User::where('id','=',$formation->client_id1)->first();
            $client2 = User::where('id','=',$formation->client_id2)->first();
            $client3 = User::where('id','=',$formation->client_id3)->first();
            $client4 = User::where('id','=',$formation->client_id4)->first();
            $client5 = User::where('id','=',$formation->client_id5)->first();
            $formateur = User::where('id','=',$formation->formateur_id)->first();
            $apprenantsFormation = Apprenant::where('formation_id', '=', $formation->id)->get();

            $formation->setAttribute('client1', $client1);
            $formation->setAttribute('client2', $client2);
            $formation->setAttribute('client3', $client3);
            $formation->setAttribute('client4', $client4);
            $formation->setAttribute('client5', $client5);
            $formation->setAttribute('formateur', $formateur);
            $formation->setAttribute('apprenants', $apprenantsFormation);
        
        }

        //Formation terminess
        
        $formationsTerminees = Formation::where('date_fin', '<', $aujourdhui)->get();

        foreach ($formationsTerminees as $formation) {
            
            $apprenantsFormationTerminees = Apprenant::where('formation_id', $formation->id)->get();

            $nbApprenants = $apprenantsFormationTerminees->count();

            if ($nbApprenants != 0) {

                $notesApprenants = Apprenant::where('formation_id', $formation->id)->avg('note_formation');

                $ApprenantsEmbauches = Apprenant::where('formation_id', $formation->id)->where('date_embauche', '!=', null)->get();

                $nbApprenantsEmbauches = $ApprenantsEmbauches->count();

                $formation->setAttribute('nbApprenantsEmbauches', $nbApprenants);

                $pourcentageSatisfaction = $notesApprenants * 5;

                $formation->setAttribute('pourcentageSatisfaction', $pourcentageSatisfaction.' %');

                $pourcentageApprenantEmbauches = $nbApprenantsEmbauches * 100 / $nbApprenants;

                $formation->setAttribute('pourcentageEmbauches', '('.$pourcentageApprenantEmbauches.' %)');
    
            }
            else{

                $formation->setAttribute('pourcentageSatisfaction', '-');

                $formation->setAttribute('pourcentageEmbauches', '-');
            }  

            $formateur = User::where('id','=', $formation->formateur_id)->first();
            $client1 = User::where('id','=',$formation->client_id1)->first();
            $client2 = User::where('id','=',$formation->client_id2)->first();
            $client3 = User::where('id','=',$formation->client_id3)->first();
            $client4 = User::where('id','=',$formation->client_id4)->first();
            $client5 = User::where('id','=',$formation->client_id5)->first();

            $formation->setAttribute('apprenants', $apprenantsFormationTerminees);
            $formation->setAttribute('formateur', $formateur);
            $formation->setAttribute('client1', $client1);
            $formation->setAttribute('client2', $client2);
            $formation->setAttribute('client3', $client3);
            $formation->setAttribute('client4', $client4);
            $formation->setAttribute('client5', $client5);


            if ($formation->compte_rendu_formateur == 1) {
              
                $formation->setAttribute('compte_rendu_formateur', 'OK');

            }
            else{
          
                $formation->setAttribute('compte_rendu_formateur', '-');
             
            }

            if ($formation->impact_formation == 1) {
              
                $formation->setAttribute('impact_formation', 'OK');

            }
            else{

                $formation->setAttribute('impact_formation', '-');
            }

        }              
        
        return view('home', ['users' => $users, 'clients' => $clients, 'formateurs' => $formateurs, 'groupes_formation' => $groupes_formation, 'formations' => $formations, 'apprenants' => $apprenants, 'formations_finies' => $formationsTerminees, 'nbEmbauchesTotal' => $nbEmbauchesTotal , 'nbEmbauches2moisTotal' => $nbEmbauches2moisTotal , 'nbEmbauches6moisTotal' => $nbEmbauches6moisTotal, 'pourcentageEmbauchesTotal' => $pourcentageEmbauchesTotal ,'pourcentageEmbauches2MoisTotal' => $pourcentageEmbauches2MoisTotal ,'pourcentageEmbauches6MoisTotal' => $pourcentageEmbauches6MoisTotal, 'pourcentageNonEmbauches' => $pourcentageNonEmbauches]);
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

    public function deleteUser(Request $request)
    {

        $idUserADelete = $request->suppr_user;

        $user = DB::table('users')->where('id','=', $idUserADelete)->first();

        if ($user->role == 2 || $user->role == 3) {

            DB::table('users')->where('id', '=', $idUserADelete)->delete();

            return redirect()->back()->with('success', $user->nom.' '.$user->prenom.' a été supprimé !');
        }
   
    }

    public function getCSVApprenant()
    {
        
        $file = public_path(). '\file\fichier_type.csv';

        // return $file;
        
        $headers = [

              'Content-Type' => 'application/excel',

           ];

        return response()->download($file, 'fichier_type', $headers);
    }
    
}