<?php
namespace JR_Formation\Http\Controllers;

use Illuminate\Http\Request;
use JR_Formation\User;
use JR_Formation\Apprenant;
use JR_Formation\Formation;
use JR_Formation\Commentaire;
use JR_Formation\AbsencesRetards;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;

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

        $usersNonApprenant = User::where('role', '=', '1')->orWhere('role', '=', '2')->orWhere('role', '=', '3')->get();

        foreach ($apprenants as $apprenant) {
            
            $infosUserApprenant = Apprenant::where('user_id', $apprenant->id)->first();

            $apprenant->setAttribute('commentaire_semaine1', $infosUserApprenant->commentaire_semaine1);
            $apprenant->setAttribute('commentaire_semaine2', $infosUserApprenant->commentaire_semaine2);
            $apprenant->setAttribute('groupe_formation', $infosUserApprenant->groupe_formation);
            $apprenant->setAttribute('note_formation', $infosUserApprenant->note_formation);

        }

        $totalApprenants = count($apprenants);

        if ($totalApprenants != 0) {

            $EmbauchesTotal = Apprenant::where('date_embauche', '!=', null)->get();
            $nbEmbauchesTotal = $EmbauchesTotal->count();
            $pourcentageEmbauchesTotal = $nbEmbauchesTotal * 100/ $totalApprenants;
            $pourcentageEmbauchesTotal = round($pourcentageEmbauchesTotal);

            $Embauches2moisTotal = Apprenant::where('embauche_2_mois', 'oui')->get();
            $nbEmbauches2moisTotal = $Embauches2moisTotal->count();
            $pourcentageEmbauches2MoisTotal = $nbEmbauches2moisTotal * 100/ $totalApprenants;
            $pourcentageEmbauches2MoisTotal = round($pourcentageEmbauches2MoisTotal);

            $Embauches6moisTotal = Apprenant::where('embauche_6_mois', 'oui')->get();
            $nbEmbauches6moisTotal = $Embauches6moisTotal->count();
            $pourcentageEmbauches6MoisTotal = $nbEmbauches6moisTotal * 100/ $totalApprenants;
            $pourcentageEmbauches6MoisTotal = round($pourcentageEmbauches6MoisTotal);

            $NonEmbauches = Apprenant::where('motif_non_embauche', '!=', null)->get();
            $nbNonEmbauches = $NonEmbauches->count();
            $pourcentageNonEmbauches = $nbNonEmbauches * 100/ $totalApprenants;
            $pourcentageNonEmbauches = round($pourcentageNonEmbauches);

        }

        else{

            $nbEmbauchesTotal = '-';
            $nbEmbauches2moisTotal = '-';
            $nbEmbauches6moisTotal = '-';
            $nbNonEmbauches = '-';
            $pourcentageEmbauchesTotal = '-';
            $pourcentageEmbauches2MoisTotal = '-';
            $pourcentageEmbauches6MoisTotal = '-';
            $pourcentageNonEmbauches = '-';

        }
        

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
                $ApprenantsEmbauches2Mois = Apprenant::where('formation_id', $formation->id)->where('embauche_2_mois', '=', 'oui')->get();
                $ApprenantsEmbauches6Mois = Apprenant::where('formation_id', $formation->id)->where('embauche_6_mois', '=', 'oui')->get();
                $apprenantsVoteNonNull = Apprenant::where('formation_id', $formation->id)->where('note_formation', '!=', null)->get();

                $nbVotant = $apprenantsVoteNonNull->count();
                $formation->setAttribute('nbVotant', $nbVotant);

                $nbApprenantsEmbauches = $ApprenantsEmbauches->count();
                $formation->setAttribute('nbApprenantsEmbauches', $nbApprenantsEmbauches);

                $nbApprenantsEmbauches2Mois = $ApprenantsEmbauches2Mois->count();
                $formation->setAttribute('nbApprenantsEmbauches2Mois', $nbApprenantsEmbauches2Mois);

                $nbApprenantsEmbauches6Mois = $ApprenantsEmbauches6Mois->count();
                $formation->setAttribute('nbApprenantsEmbauches6Mois', $nbApprenantsEmbauches6Mois);

                $pourcentageSatisfaction = $notesApprenants * 5;
                $pourcentageSansDecimalSatif = round($pourcentageSatisfaction);
                $formation->setAttribute('pourcentageSansDecimalSatif', $pourcentageSansDecimalSatif.' %');

                $pourcentageApprenantEmbauches = $nbApprenantsEmbauches * 100 / $nbApprenants;
                $pourcentageSansDecimalAppEmbauches = round($pourcentageApprenantEmbauches);
                $formation->setAttribute('pourcentageSansDecimalAppEmbauches', '('.$pourcentageSansDecimalAppEmbauches.' %)');

                $pourcentageApprenantEmbauches2Mois = $nbApprenantsEmbauches2Mois * 100 / $nbApprenants;
                $pourcentageSansDecimalAppEmbauches2 = round($pourcentageApprenantEmbauches2Mois);
                $formation->setAttribute('pourcentageSansDecimalAppEmbauches2', '('.$pourcentageSansDecimalAppEmbauches2.' %)');

                $pourcentageApprenantEmbauches6Mois = $nbApprenantsEmbauches6Mois * 100 / $nbApprenants;
                $pourcentageSansDecimalAppEmbauches6 = round($pourcentageApprenantEmbauches6Mois);
                $formation->setAttribute('pourcentageSansDecimalAppEmbauches6', '('.$pourcentageSansDecimalAppEmbauches6.' %)');
    
            }
            else{

                $formation->setAttribute('pourcentageSansDecimalSatif', '-');
                $formation->setAttribute('pourcentageSansDecimalAppEmbauches', '-');
                $formation->setAttribute('pourcentageSansDecimalAppEmbauches2', '-');
                $formation->setAttribute('pourcentageSansDecimalAppEmbauches6', '-');
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
        
        return view('home', ['users' => $users, 'usersNonApprenant' => $usersNonApprenant, 'clients' => $clients, 'formateurs' => $formateurs, 'groupes_formation' => $groupes_formation, 'formations' => $formations, 'apprenants' => $apprenants, 'formations_finies' => $formationsTerminees, 'nbEmbauchesTotal' => $nbEmbauchesTotal , 'nbEmbauches2moisTotal' => $nbEmbauches2moisTotal , 'nbEmbauches6moisTotal' => $nbEmbauches6moisTotal, 'pourcentageEmbauchesTotal' => $pourcentageEmbauchesTotal ,'pourcentageEmbauches2MoisTotal' => $pourcentageEmbauches2MoisTotal ,'pourcentageEmbauches6MoisTotal' => $pourcentageEmbauches6MoisTotal, 'nbNonEmbauches' => $nbNonEmbauches]);
    }
    public function profil()
    {

        $roleUser = auth()->user()->role;

        if (auth()->user()->formation_id == null && auth()->user()->role == 0) {

            return view('interface_apprenant');
        }

        if ($roleUser == 0) {

            $dataApprenant = Apprenant::where('user_id','=',auth()->user()->id)->first();
       
            $formation = Formation::where('nom', '=', $dataApprenant->groupe_formation)->first();

            $number = $dataApprenant->id_pole_emploi;

            $number = preg_replace("/(^.|.$)(*SKIP)(*F)|(.)/","*",$number);

            $dataApprenant->setAttribute('date_debut', $formation->date_debut);
            $dataApprenant->setAttribute('date_fin', $formation->date_fin);
            $dataApprenant->setAttribute('id_pole_emploi',$number );
            

        }
        

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

        if ($roleUser == 0) {

            return view('profil',['statut' => $statut, 'apprenant' => $dataApprenant]);
        }

        return view('profil',['statut' => $statut]);
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

                    $dateDebut = Carbon::parse($formation->date_debut)->format('d/m/Y');
                    $dateFin = Carbon::parse($formation->date_fin)->format('d/m/Y');

                    foreach ($formateurs as $formateur) {

                        $nomFormateur =  $formateur->prenom.' '.$formateur->nom;
                        
                    }    
                }

                
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
                    'ID Securite Sociale' => $apprenant->numero_ss,  
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

        $user = User::where('id','=', $idUserADelete)->first();

        if ($user->role == 1 || $user->role == 2) {

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

    public function supprFormation(Request $request)
    {
        
        $formationChoisie = $request->nom_formation;

        $formationBdd = Formation::where('nom', $formationChoisie)->first();

        $apprenantsFormation = Apprenant::where('formation_id', $formationBdd->id )->get();

        $commentairesGroupes = Commentaire::where('formation', $formationBdd->nom)->get();

        foreach ($commentairesGroupes as $commentaire) {
            

            DB::table('commentaires')->where('formation', $commentaire->formation)->delete();

        }

        foreach($apprenantsFormation as $apprenant) {


            DB::table('apprenants')->where('formation_id', '=', $formationBdd->id)->delete(); 

            DB::table('users')->where('id', $apprenant->user_id)->delete();  

        }

        unlink(storage_path('app/programme_formation/'.$formationBdd->programme_formation));

        DB::table('formations')->where('nom', '=', $formationChoisie)->delete();

        return redirect()->back()->with('success', ' La formation '.$formationChoisie.' été supprimée ainsi que toutes les données liées !');

    }

    
    
}