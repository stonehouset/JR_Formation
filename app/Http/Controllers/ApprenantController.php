<?php

namespace JR_Formation\Http\Controllers;

use JR_Formation\Apprenant;
use JR_Formation\Formation;
use JR_Formation\User;
use JR_Formation\Questionnaire;
use Illuminate\Http\Request;
use Carbon\Carbon; 
use JR_Formation\Http\Requests\ContactRequest; 
use Illuminate\Support\Facades\Mail;
use JR_Formation\Mail\Contact;
use JR_Formation\Mail\QuestionnaireFormateur;
use JR_Formation\Mail\QuestionnaireFormation;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use View;
use File;
use DateTime;
use Illuminate\Support\Facades\Storage;


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

        $idApprenant = auth()->user()->id;
        $apprenant = Apprenant::where('user_id','=',$idApprenant)->first();   
        $dateNow = date('Y-m-d');

        $formation = Formation::where('id','=',$apprenant->formation_id)->first(); //Recuperation des infos de l'apprenant connecte

        $evalFormateur = Questionnaire::where('id',1)->first();
        $evalFormation = Questionnaire::where('id',2)->first();

        $dateDebutForm = $formation->date_debut;
        $dateFinForm = $formation->date_fin;

        $datePlus4Jours = date('Y-m-d', strtotime($dateDebutForm. ' + 4 days'));
        $datePlusOnzeJours = date('Y-m-d', strtotime($dateDebutForm. ' + 11 days'));
        $datePlus18Jours = date('Y-m-d', strtotime($dateDebutForm. ' + 18 days'));

        $dateDebutDateFormat = new DateTime($dateDebutForm);
        $dateFinDateFormat = new DateTime($dateFinForm);
        $interval = $dateDebutDateFormat->diff($dateFinDateFormat);

        $interval = $interval->format('%a');

        if ($formation == null) {

            return view('interface_apprenant');
        }

        return view('interface_apprenant', ['dateNow' => $dateNow , 'apprenant' => $apprenant, 'datePlus4Jours' => $datePlus4Jours, 'datePlusOnzeJours' => $datePlusOnzeJours, 'datePlus18Jours' => $datePlus18Jours,'dateDebutForm' => $dateDebutForm, 'dateFinForm' => $dateFinForm, 'evalFormateur' => $evalFormateur, 'evalFormation' => $evalFormation, 'interval' => $interval]);

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
        
        
        
    }

    public function csvToArray($filename = '', $delimiter = ';') //Fonction de récupération du fichier CSV pour créer un tableau de données.
    {
        if (!file_exists($filename) || !is_readable($filename)){

            return 'erreur fichié';
        }

        $header = null;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== false)
        {

            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {

                if (!$header)

                    $header = $row;

                else

                    $data[] = array_combine($header, $row);
            }

            fclose($handle);
        }

        return $data;
    }

    public function importCsv(Request $request) // Fonction d'import du tableau de données créé ci-dessus dans la basse de données.
    {

        $users = User::all();
        $file = $request->file('fichier_csv_apprenants');
        $customerArr = $this->csvToArray($file);

        function generatePassword($length = 10) { 

            $chars = 'abcdefghijklmnopqrstuvwxyz0123456789./][{};:';
            $count = mb_strlen($chars);
            $result;

            for ($i = 0, $result = ''; $i < $length; $i++) {

                $index = rand(0, $count - 1);
                $result .= mb_substr($chars, $index, 1);
            }

            return $result;
        }

        foreach ($customerArr as $item) {

            if($item['date_naissance'] != null) {

                $explodeDate = explode('/', $item['date_naissance']);

                $day = $explodeDate[0];
                $month = $explodeDate[1];
                $year = $explodeDate[2]; 

                $date = Carbon::createFromFormat('Y-m-d', $year.'-'.$month.'-'.$day)->toDateString();
                $item['date_naissance'] = $date;    

            }   
            // return $item['date_naissance'];

            $mdp = generatePassword();

            $item['password'] = $mdp;

            $user = User::where('email', '=', $item['email'])->first();

            $userIdP = User::where('email', '=', $item['id_pole_emploi'])->first();

            $userSs = User::where('email', '=', $item['numero_ss'])->first();

            if ($userSs != null) {
                
                return redirect()->back()->with('error', 'Le numéro de sécurité s : '.$userSS->numero_ss.' est déja utilisé par un utilisateur!'); 
            }

            if ($userIdP != null) {
                
                return redirect()->back()->with('error', 'L\'ID Pole emploi : '.$userIdP->id_pole_emploi.' est déja utilisé par un utilisateur!'); 
            }

            if ($user != null) {
                
                return redirect()->back()->with('error', 'L\'adresse email : '.$user->email.' est déja utilisée par un utilisateur!'); 
            }
     
            $user = new User;

            $user->nom = $item['nom'];
            $user->prenom = $item['prenom'];
            $user->numero_telephone = $item['numero_telephone'];
            $user->email = $item['email'];
            $user->password = bcrypt($item['password']);
            $user->role = 0;

            $user->save();
            // return $user;

            $getUserCreate = User::where('email', $user->email)->first();

            $apprenant = new Apprenant;

            $apprenant->user_id = $getUserCreate->id;
            $apprenant->sexe = $item['sexe'];
            $apprenant->date_naissance = $item['date_naissance'];
            $apprenant->id_pole_emploi = $item['id_pole_emploi'];
            $apprenant->numero_ss = $item['numero_ss'];
            $apprenant->groupe_formation = $item['groupe_formation'];
            $apprenant->lieu_naissance = $item['lieu_naissance'];
            $apprenant->nationalite = $item['nationalite'];
            $apprenant->adresse = $item['adresse'];

            $apprenant->save();

            $data = [

               'nom' => $item['nom'],
               'prenom' => $item['prenom'],
               'email' => $item['email'],
               'formation' => $item['groupe_formation'],
               'mdp' => $item['password']
            ];

            // return view("emails.apprenants", []);
            try{

                Mail::to($item['email'])->send(new Contact($data));
            }
            catch(\Exception $e){

                return redirect()->back()->with('error', 'une erreur est survenue lors de l\'envoi des données à l\'adresse : '.$item['email'].' !'); 
            }
            
        }
      
        return redirect()->back()->with('success', 'Apprenants ajoutés!');    
    }

    public function getDownload() //Fonction de telechargement du programme de formation.
    {

        $idApprenant = auth()->user()->id;
        $apprenant = Apprenant::where('user_id','=',$idApprenant)->first();   
        $formation = Formation::where('id','=',$apprenant->formation_id)->first();

        $nomProgrammeFormation = $formation->programme_formation; 

        return response()->download(storage_path("app/programme_formation/{$nomProgrammeFormation}"));
    }

    public function ajoutComSem1(Request $request)// Fonction d'ajout du commentaire de la premiere semaine de formation.
    {

        $idApprenant = auth()->user()->id;
        $com = $request->com_apprenant_sem1;
        $dataApprenant = Apprenant::where('user_id','=',$idApprenant)->first();

        if (strlen($com) > 250) {
           
            return redirect()->back()->with('error', 'Le commentaire ne doit pas dépasser 250 caractères!'); 
        }

        if ($dataApprenant->commentaire_semaine1 != null) {

            return redirect()->back()->with('error', 'Vous avez déja écrit quelque chose pour cette semaine!'); 

        }else if ($com == null) {

            return redirect()->back()->with('error', 'Le commentaire est vide!'); 

        }else{

            DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['commentaire_semaine1' => $com]);
          
            return redirect()->back()->with('success', 'Commentaire de la première semaine ajouté, Merci!');  
        }
    }

    public function ajoutComSem2(Request $request) //Fonction d'ajout du commentaire de la deuxième semaine de formation.
    {

        $idApprenant = auth()->user()->id;
        $com = $request->com_apprenant_sem2;
        $dataApprenant = Apprenant::where('user_id','=',$idApprenant)->first();

        if ($dataApprenant->commentaire_semaine1 == null) {

            return redirect()->back()->with('error', 'Merci de remplir le commentaire de la première semaine!'); 

        }
        if (strlen($com) > 250) {
           
            return redirect()->back()->with('error', 'Le commentaire ne doit pas dépasser 250 caractères!'); 
        }
        else if ($com == null) {

            return redirect()->back()->with('error', 'Le commentaire est vide!'); 

        }else if ($dataApprenant->commentaire_semaine2 != null) {

            return redirect()->back()->with('error', 'Vous avez déja écrit quelque chose pour cette semaine!'); 

        }else{

            DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['commentaire_semaine2' => $com]);
          
            return redirect()->back()->with('success', 'Commentaire de la deuxième semaine ajouté, Merci!');  
        }
    }

    public function ajoutComSem3(Request $request) //Fonction d'ajout du commentaire de la deuxième semaine de formation.
    {

        $idApprenant = auth()->user()->id;
        $com = $request->com_apprenant_sem3;
        $dataApprenant = Apprenant::where('user_id','=',$idApprenant)->first();

        if ($dataApprenant->commentaire_semaine2 == null) {

            return redirect()->back()->with('error', 'Merci de remplir le commentaire de la deuxième semaine!'); 

        }

        if (strlen($com) > 250) {
           
            return redirect()->back()->with('error', 'Le commentaire ne doit pas dépasser 250 caractères!'); 
        }
        else if ($com == null) {

            return redirect()->back()->with('error', 'Le commentaire est vide!'); 

        }else if ($dataApprenant->commentaire_semaine3 != null) {

            return redirect()->back()->with('error', 'Vous avez déja écrit quelque chose pour cette semaine!'); 

        }else{

            DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['commentaire_semaine3' => $com]);
          
            return redirect()->back()->with('success', 'Commentaire de la troisième semaine ajouté, Merci!');  
        }
    }

    public function sendFormFormateur(Request $request) //Fonction de creation du fichier excel questionnaire formateur et envoi a l'admin.
    {

        $data;
        $apprenant = auth()->user()->id;
        $dataApprenant = User::where('id','=', $apprenant)->first();
         
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
        $quest14 = "14";
        $quest15 = "15";
        $quest16 = "16";
        $quest17 = "17";    

        $rep1 = $request->radio1;
        $rep2 = $request->radio2;
        $rep3 = $request->radio3;
        $rep4 = $request->radio4;
        $rep5 = $request->radio5;
        $rep6 = $request->radio6;
        $rep7 = $request->radio7;
        $rep8 = $request->radio8;
        $rep9 = $request->radio9;
        $rep10 = $request->radio10;
        $rep11 = $request->radio11;
        $rep12 = $request->radio12;
        $rep13 = $request->radio13;
        $rep14 = $request->radio14;
        $rep15 = $request->radio15;
        $rep16 = $request->radio16;
        $rep17 = $request->radio17;

        if ($rep1 == null || $rep2 == null || $rep3 == null || $rep4 == null || $rep5 == null || $rep6 == null || $rep7 == null || $rep8 == null || $rep9 == null || $rep10 == null || $rep11 == null || $rep12 == null || $rep13 == null ||$rep14 == null || $rep15 == null || $rep16 == null || $rep17 == null) {
            
            return redirect()->back()->with('error', 'Merci de répondre à toutes les questions!');
        }

        $arrayQuestions =  array($quest1,$quest2,$quest3,$quest4,$quest5,$quest6,$quest7,$quest8,$quest9,$quest10,$quest11,$quest12,$quest13,$quest14,$quest15,$quest16,$quest17);

        $arrayReponses =  array($rep1,$rep2,$rep3,$rep4,$rep5,$rep6,$rep7,$rep8,$rep9,$rep10,$rep11,$rep12,$rep13,$rep14,$rep15,$rep16,$rep17);

        $nomApprenant;
        $nomApprenant['nom'] = $dataApprenant->nom;

        $prenomApprenant;
        $prenomApprenant['prenom'] = $dataApprenant->prenom;

        for ($i = 0; $i < count($arrayQuestions); $i++) { 
           
            for ($j = 0; $j < count($arrayReponses) ; $j++) { 
              
                if ($i == $j) {

                    $data[$i]['Questions'] = $arrayQuestions[$i];
                    $data[$i]['Evaluations'] = $arrayReponses[$i];

                    if ($i == 0) {

                        $data[$i]['Nom'] = $nomApprenant['nom'];
                        $data[$i]['Prenom'] = $prenomApprenant['prenom'];
                    }
                }

            }

        }

        $file = Excel::create('questionnaire_formateur', function ($excel) use ($data) {
      
            $excel->sheet('sheet1', function ($sheet) use ($data) {

                $sheet->fromArray($data);

            });

        })->save('xlsx', storage_path('app/public'));

        $array_file = [];
        array_push($array_file, $file);


        try{

            Mail::to('houselstein.thibaud@gmail.com')->send(new QuestionnaireFormateur($array_file));
        }
        catch(\Exception $e){

            File::delete('storage/questionnaire_formateur.xlsx');
            return redirect()->back()->with('error', 'une erreur est survenue lors de l\'envoi du questionnaire, merci de réessayer'); 
        }
        
        File::delete('storage/questionnaire_formateur.xlsx');

        DB::table('apprenants')->where('user_id' ,'=' , $apprenant)->update(['questionnaire_formateur' => 1]);

        return redirect()->back()->with('success', 'Questionnaire envoyé, merci!'); 

    }

    public function sendFormFormation(Request $request)// Fonction d'envoi du questionnaire et des réponses a l'admin.
    {

        $data;
        $apprenant = auth()->user()->id;
        $dataApprenant = User::where('id','=', $apprenant)->first();
              
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
        $quest14 = "14";
        $quest15 = "15";
        $quest16 = "16";
        $quest17 = "17";
        $quest18 = "18";
        $quest19 = "19"; 
        $quest20 = "20";
        $quest21 = "21";
        $quest22 = "22";

        $rep1 = $request->radio1; //Recuperation des reponses du questinnaire.
        $rep2 = $request->radio2;
        $rep3 = $request->radio3;
        $rep4 = $request->radio4;
        $rep5 = $request->radio5;
        $rep6 = $request->radio6;
        $rep7 = $request->radio7;
        $rep8 = $request->radio8;
        $rep9 = $request->radio9;
        $rep10 = $request->radio10;
        $rep11 = $request->radio11;
        $rep12 = $request->radio12;
        $rep13 = $request->radio13;
        $rep14 = $request->radio14;
        $rep15 = $request->radio15;
        $rep16 = $request->radio16;
        $rep17 = $request->radio17;
        $rep18 = $request->radio18;
        $rep19 = $request->radio19;
        $rep20 = $request->commentaires_eval;
        $rep21 = $request->apprecie_eval;
        $rep22 = $request->sugg_amelio;

        $noteFormation = $request->note_formation;

        if (strlen($rep20) > 200 || strlen($rep21) > 200 || strlen($rep22) > 200) {
           
            return redirect()->back()->with('error', 'Les 3 derniers champs ne doivent pas dépasser 250 caractères!'); 
        }

        if ($rep1 == null || $rep2 == null || $rep3 == null || $rep4 == null || $rep5 == null || $rep6 == null || $rep7 == null || $rep8 == null || $rep9 == null || $rep10 == null || $rep11 == null || $rep12 == null || $rep13 == null ||$rep14 == null || $rep15 == null || $rep16 == null || $rep17 == null || $rep18 == null || $rep18 == null || $rep19 == null || $rep20 == null || $rep21 == null || $rep22 == null) {
            
            return redirect()->back()->withInput()->with('error', 'Merci de répondre à toutes les questions!');
        }

        $arrayQuestions =  array($quest1,$quest2,$quest3,$quest4,$quest5,$quest6,$quest7,$quest8,$quest9,$quest10,$quest11,$quest12,$quest13,$quest14,$quest15,$quest16,$quest17,$quest18,$quest19,$quest20,$quest21,$quest22);

        $arrayReponses =  array($rep1,$rep2,$rep3,$rep4,$rep5,$rep6,$rep7,$rep8,$rep9,$rep10,$rep11,$rep12,$rep13,$rep14,$rep15,$rep16,$rep17,$rep18,$rep19,$rep20,$rep21,$rep22);

        $nomApprenant;
        $nomApprenant['nom'] = $dataApprenant->nom;

        $prenomApprenant;
        $prenomApprenant['prenom'] = $dataApprenant->prenom; //Creatuin du tableau de donnees a inserer dans le fichier excel.

        for ($i=0; $i < count($arrayQuestions); $i++) { 
           
            for ($j=0; $j < count($arrayReponses) ; $j++) {

                if ($i == $j) {

                    $data[$i]['Questions'] = $arrayQuestions[$i];
                    $data[$i]['Evaluations'] = $arrayReponses[$i];
                }
                if ($i == 0) {
                    $data[$i]['Nom'] = $nomApprenant['nom'];
                    $data[$i]['Prenom'] = $prenomApprenant['prenom'];
                    $data[$i]['Note formation'] = $noteFormation;
                }
                                     
            }

        }
        $file = Excel::create('questionnaire_formation', function ($excel) use ($data) { //Creation du fichier excel avec les donnees.
      
            $excel->sheet('sheet1', function ($sheet) use ($data) {

                $sheet->fromArray($data);

            });

        })->save('xlsx', storage_path('app/public'));

        $array_file = [];
        
        array_push($array_file, $file);

        try{

            Mail::to('houselstein.thibaud@gmail.com')->send(new QuestionnaireFormation($array_file));//Envoi du mail a l'admin avec fichier excel.
        }
        catch(\Exception $e){

            File::delete('storage/questionnaire_formation.xlsx');
            return redirect()->back()->with('error', 'une erreur est survenue lors de l\'envoi du questionnaire, merci de réessayer'); 
        }
        

        File::delete('storage/questionnaire_formation.xlsx');

        DB::table('apprenants')->where('user_id' ,'=' , $apprenant)->update(['note_formation' => $noteFormation]);

        return redirect()->back()->with('success', 'Questionnaire envoyé, merci!'); 

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
