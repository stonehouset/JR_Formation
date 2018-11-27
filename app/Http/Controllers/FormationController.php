<?php

namespace JR_Formation\Http\Controllers;

use JR_Formation\Formation;
use JR_Formation\Apprenant;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use DB;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return redirect('home', ['users' => $users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $apprenants = Apprenant::where('groupe_formation', '=' , $request->nom_formation)->get();

        $programme_formation = $request->file('programme_formation');

        if ($request->debut_formation == null || $request->debut_formation == null || $request->fin_formation == null || $request->nom_client == null || $request->nom_formateur == null || $request->file('programme_formation') == null) {
           
            return redirect()->back()->with('error', 'Merci de compléter tous les champs!');
        }

        $nom_programme_formation = $programme_formation->getClientOriginalName();

        // return $apprenants;

        // Storage::put($nom_programme_formation, $programme_formation);

        Storage::putFileAs('programme_formation', new File($programme_formation), $nom_programme_formation);

        $formation = new Formation;

        $formation->nom = $request->nom_formation;
        $formation->date_debut = $request->debut_formation;
        $formation->date_fin = $request->fin_formation;
        $formation->client_id = $request->nom_client;
        $formation->formateur_id = $request->nom_formateur;
        $formation->programme_formation = $nom_programme_formation;

        $formation->save();

        $idFormation = DB::getPdo()->lastInsertId();

        // return $idFormation;

        foreach ($apprenants as $apprenant) {

            DB::table('apprenants')->where('user_id' ,'=' , $apprenant->user_id)->update(['formation_id' => $idFormation]);
            
        }

        return redirect()->back()->with('success', 'Le groupe de formation a été ajouté!'); 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \JR_Formation\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function show(Formation $formation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JR_Formation\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function edit(Formation $formation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JR_Formation\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formation $formation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JR_Formation\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formation $formation)
    {
        //
    }
}
