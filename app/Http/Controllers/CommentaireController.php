<?php

namespace JR_Formation\Http\Controllers;

use Illuminate\Http\Request;
use JR_Formation\Commentaire;
use Carbon\Carbon;
use JR_Formation\Apprenant;
use JR_Formation\User;
use JR_Formation\Formation;
use DateTime;
use Auth;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function __construct()
    {

        $this->middleware('auth');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)// Fonction de création d'un nouveau commentaire. 
    {


        $apprenant = $request->nom_apprenant_com; // Apprenant concerné par le commentaire.

        $dernierMessage = Commentaire::where('apprenant_id','=', $apprenant)->orderByRaw('date_jour DESC')->first(); //recuperation dernier commentaire de l'apprenant.

        if ($dernierMessage != null) {


            $dateJourDernierMessage = $dernierMessage->date_jour;
    
        }else{


            $dateJourDernierMessage = '1970-01-01 00:00:00';
            
        }

        $dateJour = date('Y-m-d H:i:s');

        $datePlus10Heures = date('Y-m-d H:i:s', strtotime($dateJourDernierMessage)+36000);
 

        if ($datePlus10Heures > $dateJour) {

             return redirect()->back()->with('error', 'Vous avez déja écrit un message à ce stagiaire aujourd\'hui!');

        }

        if ($request->contenu_commentaire == null) {
           
            return redirect()->back()->with('error', 'Votre message est vide!');                        //Erreurs si les inputs sont vides.

        }elseif ($request->nom_apprenant_com == null) {
           
            return redirect()->back()->with('error', 'Vous n\'avez pas sélectionné de stagiaire!');

        }else { //Sinon ajout du commentaire en base de donnee.
              
            // return $request->all();
            $commentaire = new Commentaire;

            $commentaire->date_jour = $dateJour;
            $commentaire->apprenant_id = $request->nom_apprenant_com;
            $commentaire->formateur_id = auth()->user()->id;
            $commentaire->commentaire = $request->contenu_commentaire;

            $commentaire->save();

            return redirect()->back()->with('success', 'Message enregistré!'); //Retour de la vue avec message succes.
        }
        
    }

    public function showCommentaires() //Fonction d'affichage des commentaires /semaine des apprenants et des commentaires des formateurs.
    {

        $apprenants = Apprenant::all(); //Recuperation de toute la table apprenants.
        $commentairesFormateur = Commentaire::all(); //recuperation de toute la table commentaires.

        foreach ($apprenants as $apprenant) { //Boucle sur les apprenants pour recuperer les infos user et formation.
            
            $infosApprenant = User::where('id', $apprenant->user_id)->first(); //Recuperation des infos de l'apprenant dans table users.
            $formationApprenant = Formation::where('nom', $apprenant->groupe_formation)->first(); //Recuperation des infos de la formation.
            $infosFormateur = User::where('id', $formationApprenant['formateur_id'])->first();//Recuperation du formateur de la formation.
                                                                                       
            $apprenant->setAttribute('infos', $infosApprenant); //Ajout des infos de l'apprenant (donnees user) a l'apprenant.
            $apprenant->setAttribute('formation', $formationApprenant); //Ajout des infos de la formation a l'apprenant.
            $apprenant->setAttribute('nom_formateur', $infosFormateur); // Ajout des infos du formateur a l'apprenant.
           

        }

        foreach ($commentairesFormateur as $commentaire) { //Boucle sur les commentaires formateur pour récupérer infos apprenant et  
                                                           //formateur cible.

            $apprenantCible = User::where('id', $commentaire->apprenant_id)->first();//Recuperation des infos de l'apprenant cible.
            $nomFormateur = User::where('id', $commentaire->formateur_id)->first();//Recuperation des infos du formateur cible.

            $commentaire->setAttribute('apprenant', $apprenantCible); //Ajout des infos de l'apprenant au commentaire.
            $commentaire->setAttribute('formateur', $nomFormateur);//Ajout des infos du formateur au commentaire.
        }

        return view('commentaires',['apprenants' => $apprenants, 'commentaires' => $commentairesFormateur]); //Envoi des donnees a la vue 
                                                                                                             //commentaires.blade.php.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
