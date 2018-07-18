<?php

namespace JR_Formation\Http\Controllers;

use JR_Formation\Apprenant;
use JR_Formation\User;
use Illuminate\Http\Request;

class ApprenantController extends Controller
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


    public function index()
    {
        $users = User::all();
        return view('interface_apprenant', ['users' => $users]);
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
        $apprenant = new Apprenant;

        $apprenant->sexe = $request->input('options.');
        $apprenant->nom = $request->nom_apprenant;
        $apprenant->prenom = $request->prenom_apprenant;
        $apprenant->email = $request->email_apprenant;
        $apprenant->date_naissance = $request->date_naissance_apprenant;
        $apprenant->mdp = $request->mdp;
        $apprenant->id_pole_emploi = $request->pole_emploi;
        $apprenant->numero_ss = $request->num_secu;
        $apprenant->numero_telephone = $request->num_telephone_apprenant;
        $apprenant->date_CDI = $request->date_cdi;
        $apprenant->debut_tutorat = $request->date_debut_tutorat;
        $apprenant->fin_tutorat = $request->date_fin_tutorat;
        $apprenant->adresse = $request->adresse_apprenant;
        $apprenant->nationalite = $request->nationalite;
        $apprenant->lieu_naissance = $request->lieu_naissance;
        $apprenant->formation = $request->input('formations.');
        $apprenant->groupe_formation = $request->input('groupe_formations.');

        $apprenant->save();

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \JR_Formation\Apprenant  $apprenant
     * @return \Illuminate\Http\Response
     */
    public function show(Apprenant $apprenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JR_Formation\Apprenant  $apprenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Apprenant $apprenant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JR_Formation\Apprenant  $apprenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apprenant $apprenant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JR_Formation\Apprenant  $apprenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apprenant $apprenant)
    {
        //
    }
}
