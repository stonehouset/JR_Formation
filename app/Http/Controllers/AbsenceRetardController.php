<?php

namespace JR_Formation\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use JR_Formation\AbsencesRetards;
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
    public function create(Request $request)//Fonction de signalement d'un retard ou d'une absence
    {

        $aujourdhui = Carbon::now();

        $apprenant = $request->nom_apprenant_absence_retard;

        if ($apprenant == null) {                   //Controle des inputs apprenant et type de signalement.
           
            return redirect()->back()->with('error', 'Vous n\'avez pas sélectionné de stagiaire!'); 

        }

        $userApprenant = User::where('id','=', $apprenant)->first(); //Recuperation des informations.

        $dataApprenant = Apprenant::where('user_id', '=', $apprenant)->first();

        $formation = Formation::where('nom', '=', $dataApprenant->groupe_formation)->first();

        $formateur = User::where('id','=',$formation->formateur_id)->first();

        
        if ($request->absence_ou_retard  == null) {
           
            return redirect()->back()->with('error', 'Vous n\'avez pas choisi le type de signalement!');
        }

        $dernierSignalement = AbsencesRetards::where('apprenant_id','=', $apprenant)->first();

        if ($dernierSignalement == null) {

            $absenceRetard = new AbsencesRetards; //Creation du retard ou de l'absence.

            $absenceRetard->date_jour = $aujourdhui;
            $absenceRetard->apprenant_id = $apprenant;
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

            if ($request->absence_ou_retard == 1) { //Envoi d'un email a l'admin pour signaler le retard.

                try{
                    Mail::to('ju.rivet1@gmail.com')->send(new SignalementRetard($data));

                    return redirect()->back()->with('success', 'Retard signalé!');
                }
                catch(\Exception $e){

                    $dernierSignalement = AbsencesRetards::where('apprenant_id','=', $apprenant)->first();

                    DB::table('absences_retards')->where('id', '=', $dernierSignalement->id)->delete();

                    return redirect()->back()->with('error', 'une erreur est survenue lors de l\'envoi du signalement, veuillez réessayer plus tard !'); 
                }
                
            }
            elseif ($request->absence_ou_retard == 2) { //Envoi d'un email a l'admin pour signaler l'absence.
                
                try{
                    Mail::to('ju.rivet1@gmail.com')->send(new SignalementAbsence($data));

                    return redirect()->back()->with('success', 'Absence signalée!');
                }
                catch(\Exception $e){
                    
                    $dernierSignalement = AbsencesRetards::where('apprenant_id','=', $apprenant)->first();

                    DB::table('absences_retards')->where('id', '=', $dernierSignalement->id)->delete();
                    
                    return redirect()->back()->with('error', 'une erreur est survenue lors de l\'envoi du signalement, veuillez réessayer plus tard !'); 
                }

                
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
