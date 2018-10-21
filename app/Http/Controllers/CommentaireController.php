<?php

namespace JR_Formation\Http\Controllers;

use Illuminate\Http\Request;
use JR_Formation\Commentaire;
use Carbon\Carbon;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $aujourdhui = Carbon::now();

        $apprenant = $request->nom_apprenant_com;

        $dernierMessage = Commentaire::where('apprenant_id','=', $apprenant)->first();

        if ($dernierMessage) {

            $date_jour = $dernierMessage->date_jour;

            return redirect()->back()->with('error', 'Vous avez déja écrit un message à ce stagiaire aujourd\'hui!');

        }elseif ($request->contenu_commentaire == null) {
           
            return redirect()->back()->with('error', 'Votre message est vide!');

        }elseif ($request->nom_apprenant_com == null) {
           
            return redirect()->back()->with('error', 'Vous n\'avez pas sélectionné de stagiaire!');

        }else {
              
            // return $request->all();
            $commentaire = new Commentaire;

            $commentaire->date_jour = $aujourdhui;
            $commentaire->apprenant_id = $request->nom_apprenant_com;
            $commentaire->formateur_id = auth()->user()->id;
            $commentaire->commentaire = $request->contenu_commentaire;

            $commentaire->save();

            return redirect()->back()->with('success', 'Message enregistré!');
        }
        
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
        //
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
