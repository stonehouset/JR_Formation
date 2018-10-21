<?php

namespace JR_Formation\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use JR_Formation\AbsenceRetard;
use JR_Formation\User;
use JR_Formation\Apprenant;
use JR_Formation\Formation;
use Illuminate\Support\Facades\Mail;
use JR_Formation\Mail\SignalementRetard;
use JR_Formation\Mail\SignalementAbsence;


class AbsenceRetardController extends Controller
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

        $apprenant = $request->nom_apprenant_absence_retard;

        if ($request->nom_apprenant_absence_retard == null) {
           
            return redirect()->back()->with('error', 'Vous n\'avez pas sélectionné de stagiaire!');

        }

        $userApprenant = User::where('id','=', $apprenant)->first();

        $dataApprenant = Apprenant::where('user_id', '=', $apprenant)->first();

        $formation = Formation::where('nom', '=', $dataApprenant->groupe_formation)->first();

        $formateur = User::where('id','=',$formation->formateur_id)->first();

        if ($request->absence_ou_retard  == null) {
           
            return redirect()->back()->with('error', 'Vous n\'avez pas choisi le type de signalement!');
        }

        $dernierSignalement = AbsenceRetard::where('apprenant_id','=', $apprenant)->first();

        if ($dernierSignalement == null) {

            $absenceRetard = new AbsenceRetard;

            $absenceRetard->date_jour = $aujourdhui;
            $absenceRetard->apprenant_id = $request->nom_apprenant_absence_retard;
            $absenceRetard->formateur_id = auth()->user()->id;
            $absenceRetard->type = $request->absence_ou_retard;

            $absenceRetard->save();

            $data = [

               'nom_apprenant' => $userApprenant->nom,
               'prenom_apprenant' => $userApprenant->prenom,
               'formation' => $formation->nom,
               'formateur_nom' => $formateur->nom,
               'formateur_prenom' => $formateur->prenom,
               
            ];

            if ($request->absence_ou_retard == 1) { 

                Mail::to('houselstein.thibaud@gmail.com')->send(new SignalementRetard($data));
                return redirect()->back()->with('success', 'Retard signalé!');
                
            }
            elseif ($request->absence_ou_retard == 2) {
                
                Mail::to('houselstein.thibaud@gmail.com')->send(new SignalementAbsence($data));
                return redirect()->back()->with('success', 'Absence signalée!');
                
            }
            
        }

        else if ($dernierSignalement->date_jour = $aujourdhui) {

            return redirect()->back()->with('error', 'Vous avez déja signalé ce stagiaire aujourd\'hui!');

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
