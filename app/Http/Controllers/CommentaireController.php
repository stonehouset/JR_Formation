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

        if ($request->nom_apprenant_com == null) {
           
            return redirect()->back()->with('error', 'Vous n\'avez pas sélectionné de stagiaire!');

        }

        if ($request->contenu_commentaire == null) {
           
            return redirect()->back()->with('error', 'Votre message est vide!');                        //Erreurs si les inputs sont vides.

        }

        if ($dernierMessage != null) {


            $dateJourDernierMessage = $dernierMessage->date_jour;
    
        }else{


            $dateJourDernierMessage = '1970-01-01 00:00:00';
            
        }

        $dateJour = date('Y-m-d H:i:s');

        $datePlus10Heures = date('Y-m-d H:i:s', strtotime($dateJourDernierMessage)+36000);
 

        if ($datePlus10Heures > $dateJour) {

             return redirect()->back()->with('error', 'Vous avez déja écrit un message à propos de ce stagiaire aujourd\'hui!');

        }

        
        else { //Sinon ajout du commentaire en base de donnee.
              
            // return $request->all();
            $commentaire = new Commentaire;

            $commentaire->date_jour = $dateJour;
            $commentaire->apprenant_id = $request->nom_apprenant_com;
            $commentaire->formateur_id = auth()->user()->id;
            $commentaire->commentaire = $request->contenu_commentaire;
            $commentaire->type = 2;
            $commentaire->formation = null;

            $commentaire->save();

            return redirect()->back()->with('success', 'Message enregistré!'); //Retour de la vue avec message succes.
        }
        
    }

    public function showCommentaires() //Fonction d'affichage des commentaires /semaine des apprenants et des commentaires des formateurs.
    {

        //Recuperation des commentaires individuels.

        $commentairesFormateurToApprenant = Commentaire::where('type','=', 2)->orderByRaw('date_jour DESC')->get(); 

        //Recuperation des commentaires de groupes.

        $commentairesFormateurToGroupe = Commentaire::where('type','=', 1)->orderByRaw('date_jour DESC')->get(); 

        foreach ($commentairesFormateurToApprenant as $commentaire) { //Boucle sur les commentaires formateur pour récupérer infos. 

            $apprenantCible = User::where('id', $commentaire->apprenant_id)->first();//Recuperation des infos de l'apprenant cible.
            $nomFormateur = User::where('id', $commentaire->formateur_id)->first();//Recuperation des infos du formateur cible.

            $commentaire->setAttribute('apprenant', $apprenantCible); //Ajout des infos de l'apprenant au commentaire.
            $commentaire->setAttribute('formateur', $nomFormateur);//Ajout des infos du formateur au commentaire.

        }

        foreach ($commentairesFormateurToGroupe as $commentaire) { //Boucle sur les commentaires de groupe pour récupérer infos. 

            $apprenantCible = User::where('id', $commentaire->apprenant_id)->first();//Recuperation des infos de l'apprenant cible.
            $nomFormateur = User::where('id', $commentaire->formateur_id)->first();//Recuperation des infos du formateur cible.

            $commentaire->setAttribute('apprenant', $apprenantCible); //Ajout des infos de l'apprenant au commentaire.
            $commentaire->setAttribute('formateur', $nomFormateur);//Ajout des infos du formateur au commentaire.

        }


        return view('commentaires',['commentaires1' => $commentairesFormateurToApprenant, 'commentaires2' => $commentairesFormateurToGroupe]); //Envoi des donnees a la vue 
                                                                                                             
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
