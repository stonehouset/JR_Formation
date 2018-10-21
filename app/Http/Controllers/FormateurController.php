<?php

namespace JR_Formation\Http\Controllers;

use JR_Formation\Formateur;
use JR_Formation\Formation;
use JR_Formation\Apprenant;
use JR_Formation\User;
use Illuminate\Http\Request;
use Auth;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class FormateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
            
                $users = User::where('id','=',$apprenant->user_id)->get();

                $apprenant->setAttribute('users', $users);

            }
        }

        // return $formations;

        return view('interface_formateur', ['formations' => $formations]);
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

    public function ajoutNote(Request $request)
    {

        $idApprenant = $request->nom_apprenant_note;

        if ($request->nom_apprenant_note == null) {
            
            return redirect()->back()->with('error', 'Vous n\'avez pas sélectionné de stagiaire!');
        }

        elseif ($request->note_apprenant == null) {
            
            return redirect()->back()->with('error', 'Vous n\'avez pas attribué de note!');
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

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formateur = new Formateur;
        $formateur->nom = $request->nom_formateur;
        $formateur->prenom = $request->prenom_formateur;
        $formateur->email = $request->email_formateur;
        $formateur->numero_telephone = $request->tel_formateur;
        $formateur->mdp = $request->mdp;
        $formateur->save();

        return redirect('/home');
    }

    public function extractApprenantCsv()
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
        Excel::create('stagiaires', function ($excel) use ($userData) {
 
            // Build the spreadsheet, passing in the users array
            $excel->sheet('sheet1', function ($sheet) use ($userData) {

                $sheet->fromArray($userData);

            });

        })->download('xlsx');

    }

    /**
     * Display the specified resource.
     *
     * @param  \JR_Formation\Formateur  $formateur
     * @return \Illuminate\Http\Response
     */
    public function show(Formateur $formateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \JR_Formation\Formateur  $formateur
     * @return \Illuminate\Http\Response
     */
    public function edit(Formateur $formateur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \JR_Formation\Formateur  $formateur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formateur $formateur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \JR_Formation\Formateur  $formateur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formateur $formateur)
    {
        //
    }
}
