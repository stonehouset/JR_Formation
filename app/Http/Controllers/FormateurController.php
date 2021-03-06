<?php

namespace JR_Formation\Http\Controllers;

use JR_Formation\Formateur;
use JR_Formation\Commentaire;
use JR_Formation\Formation;
use JR_Formation\Apprenant;
use JR_Formation\User;
use JR_Formation\Questionnaire;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use JR_Formation\Mail\CompteRenduFormateur;
use Carbon\Carbon;
use File;
use Auth;
use DB;

class FormateurController extends Controller
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

    public function index() //Fonction d'envoi des donnees des formations d'un formateur a l'interface formateur.
    {

        $aujourdhui = date('Y-m-d');
        $users = User::all(); //Recuperation des donnees utilisateurs.
        $formateurId = auth()->user()->id; //Recuperation de l'id du formateur connecté.

        $formationsEnCours = Formation::where('date_debut', '<=', $aujourdhui)
                           ->where('date_fin', '>=', $aujourdhui)
                           ->where('formateur_id', '=', $formateurId)
                           ->get();


        foreach ($formationsEnCours as $formation) {
    
            $apprenants = Apprenant::where('formation_id','=',$formation->id)->get(['user_id','date_naissance','formation_id','groupe_formation','nationalite','note_formateur']); //Ajout des donnees des apprenants aux formations.

            // return $apprenants;

            $formation->setAttribute('apprenants', $apprenants);

            foreach ($apprenants as $apprenant) {
            
                $users = User::where('id','=',$apprenant->user_id)->orderBy('created_at','desc')->get(); //Ajout des donnees utilisateurs aux apprenants.

                $apprenant->setAttribute('users', $users);

            }

        }

        return view('interface_formateur',['formations' => $formationsEnCours]);
    }

    public function ajoutNote(Request $request)// Fonction d'ajout du note du formateur a l'apprenant.
    {

        $idApprenant = $request->nom_apprenant_note;

        if ($request->nom_apprenant_note == null) {
            
            return redirect()->back()->with('error', 'Vous n\'avez pas sélectionné de stagiaire!');
        }

        elseif ($request->note_apprenant == null) {
            
            return redirect()->back()->with('error', 'Vous n\'avez pas attribué de note!');
        }
        if ($request->note_apprenant > 20 || $request->note_apprenant < 0) {
            
            return redirect()->back()->with('error', 'La note doit être comprise entre 0 et 20!');
        }
        else{

            $apprenant = Apprenant::where('user_id', '=', $idApprenant)->first();

            if ($apprenant->note_formateur != null) {

                return redirect()->back()->with('error', 'Vous avez déja attribué une note à ce stagiaire!'); 
            }

            DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['note_formateur' => $request->note_apprenant]);

            return redirect()->back()->with('success', 'Note attribuée!');
        }
    }

    public function commentaireJournalierFormation(Request $request)// Fonction d'ajout d'un commentaire formation par le formateur.
    {

        $dateJour = date('Y-m-d H:i:s');
        $idFormation = $request->formation;

        if ($idFormation  == null) {
           
            return redirect()->back()->with('error', 'Aucune formation selectionnée!');
        } 

        $infoFormation = Formation::where('id', $idFormation)->first();
        $nomFormation = $infoFormation->nom;
        $contenuCommentaire = $request->contenu_commentaire;

        $dernierMessage = Commentaire::where('formation','=', $nomFormation)->orderByRaw('date_jour DESC')->first(); 

        if ($dernierMessage != null) {

            $dateJourDernierMessage = $dernierMessage->date_jour;
    
        }else{

            $dateJourDernierMessage = '1970-01-01 00:00:00';
            
        }
      
        $datePlus10Heures = date('Y-m-d H:i:s', strtotime($dateJourDernierMessage)+36000);

        if ($datePlus10Heures > $dateJour) {

            return redirect()->back()->with('error', 'Vous avez déja écrit un message à propos de ce groupe aujourd\'hui!');

        }

        else if ($contenuCommentaire == null) {
            
            return redirect()->back()->with('error', 'Le commentaire est vide!');
        }

        else if (strlen($contenuCommentaire) > 200) {
            
            return redirect()->back()->with('error', 'Le commentaire ne doit pas faire plus de 200 caractères!');
        }

        else{

            $commentaire = new Commentaire;

            $commentaire->date_jour = $dateJour;
            $commentaire->apprenant_id = null;
            $commentaire->formateur_id = auth()->user()->id;
            $commentaire->commentaire = $contenuCommentaire;
            $commentaire->type = 1;
            $commentaire->formation = $nomFormation;

            $commentaire->save();

            return redirect()->back()->with('success', 'Commentaire envoyé!');

        }

    } 

    public function extractApprenantCsv() //Fonction d'extraction des donnees des apprenants en fichier excel.
    {

        $users = User::all();
        $formateur_id = auth()->user()->id;
        $formations = Formation::where('formateur_id', '=', $formateur_id)->get();

        // return $formateur_id;

        foreach ($formations as $formation) {
            
            $apprenants = Apprenant::where('formation_id','=',$formation->id)->get();

            // return $apprenants;

            $formation->setAttribute('apprenants', $apprenants);

            foreach ($apprenants as $apprenant) {
            
                $user = User::where('id','=',$apprenant->user_id)->first();

                $apprenant->setAttribute('user', $user);

                $dateNaissance = Carbon::parse($apprenant->date_naissance)->format('d/m/Y');
                $dateDebut = Carbon::parse($formation->date_debut)->format('d/m/Y');
                $dateFin = Carbon::parse($formation->date_fin)->format('d/m/Y');

                $nomFormation = $apprenant->groupe_formation;

                $userData[] = [
                            
                    'Nom' => $user->nom,
                    'Prenom' => $user->prenom,
                    'eMail' => $user->email,
                    'Telephone' => $user->numero_telephone,  
                    'Date de naissance' => $dateNaissance,
                    'Nationalite' => $apprenant->nationalite,
                    'Date debut formation' => $dateDebut,
                    'Date fin formation' => $dateFin,
                                  
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

    public function sendCompteRenduFormateur(Request $request) //Recuperation du form de fin de formation du formateur +  envoi en mail.
    {


        $data;
        $formation = $request->nom_formation;

        $formateur = auth()->user()->id;                                //Recuperation des infos du formateur.
        $dataFormateur = User::where('id','=', $formateur)->first();
         
        $quest1 = "1";
        $quest2 = "2"; 
        $quest3 = "3"; 
        $quest4 = "4"; 
        $quest5 = "5"; 
        $quest6 = "6"; 
        $quest7 = "7"; 
        $quest8 = "8"; 
        $quest9 = "9"; 
        $quest10 = "10"; 
        $quest11 = "11"; 
        $quest12 = "12";
        $quest13 = "13"; 
        $rep1 = $request->radioPerf;
        $rep2 = $request->contenu_objectif_atteint_ou_non;
        $rep3 = $request->contenu_modifs;
        $rep4 = $request->matos_anim;$rep5 = $request->supports;
        $rep6 = $request->doc_partici;
        $rep7 = $request->acces;
        $rep8 = $request->salles;                           //Recuperation des reponses.
        $rep9 = $request->mobilier;
        $rep10 = $request->accueil;
        $rep11 = $request->pauses;
        $rep12 = $request->repas;
        $rep13 = $request->contenu_suggestions;

        if ($formation === 'Aucun sélectionné') {

            return redirect()->back()->with('error', 'Aucun groupe de formation selectionné!');
        }

        if ($rep1 == null || $rep2 == null || $rep3 == null || $rep4 == null || $rep5 == null || $rep6 == null || $rep7 == null || $rep8 == null || $rep9 == null || $rep10 == null || $rep11 == null || $rep12 == null || $rep13 == null) {
            
            return redirect()->back()->with('error', 'Merci de répondre à toutes les questions!');

        }

        $arrayQuestions =  array($quest1,$quest2,$quest3,$quest4,$quest5,$quest6,$quest7,$quest8,$quest9,$quest10,$quest11,$quest12,$quest13);
        $arrayReponses =  array($rep1,$rep2,$rep3,$rep4,$rep5,$rep6,$rep7,$rep8,$rep9,$rep10,$rep11,$rep12,$rep13);

        $nomFormateur;
        $nomFormateur['nom'] = $dataFormateur->nom;

        $prenomFormateur;
        $prenomFormateur['prenom'] = $dataFormateur->prenom; 

        for ($i=0; $i < count($arrayQuestions); $i++) { //Creation du tableau de donnees pour lier quetions et reponsess.
           
            for ($j=0; $j < count($arrayReponses) ; $j++) { 
              
                if ($i == $j) {

                    $data[$i]['Questions'] = $arrayQuestions[$i];
                    $data[$i]['Evaluations'] = $arrayReponses[$i];

                    if ($i == 0) {
                        $data[$i]['Nom'] = $nomFormateur['nom'];
                        $data[$i]['Prenom'] = $prenomFormateur['prenom'];
                    }
                }

            }

        }
        $file = Excel::create('compte_rendu_formateur', function ($excel) use ($data) { //Creation du fichier excel.
      
            $excel->sheet('sheet1', function ($sheet) use ($data) {

                $sheet->fromArray($data);

            });

        })->save('xlsx', storage_path('app/public'));

        $array_file = [];

        array_push($array_file, $file);

        try{

            Mail::to('ju.rivet1@gmail.com')->send(new CompteRenduFormateur($array_file)); // Envoi du mail à l'admin.
        }
        catch(\Exception $e){

            File::delete('storage/compte_rendu_formateur.xlsx'); //Suppression du fichier excel temporaire.
            return redirect()->back()->with('error', 'une erreur est survenue lors de l\'envoi du compte rendu, veuillez réessayer plus tard !'); 
        }
        

        File::delete('storage/compte_rendu_formateur.xlsx'); //Suppression du fichier excel temporaire.

        DB::table('formations')->where('id' ,'=' , $formation)->update(['compte_rendu_formateur' => 1]);

        return redirect()->back()->with('success', 'Compte rendu envoyé, merci!');
    }

}
