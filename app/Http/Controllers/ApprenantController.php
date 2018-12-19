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

        if ($formation == null) {

            return view('interface_apprenant');
        }

        $dateDebutForm = $formation->date_debut;
        $dateFinForm = $formation->date_fin;
        $datePlus4Jours = date('Y-m-d', strtotime($dateDebutForm. ' + 4 days'));
        $datePlusOnzeJours = date('Y-m-d', strtotime($dateDebutForm. ' + 11 days'));

        

        return view('interface_apprenant', ['dateNow' => $dateNow , 'apprenant' => $apprenant, 'datePlus4Jours' => $datePlus4Jours, 'datePlusOnzeJours' => $datePlusOnzeJours, 'dateDebutForm' => $dateDebutForm, 'dateFinForm' => $dateFinForm, 'evalFormateur' => $evalFormateur, 'evalFormation' => $evalFormation]);

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

        if ($dataApprenant->commentaire_semaine1 != null) {

            return redirect()->back()->with('error', 'Vous avez déja écrit quelque chose pour cette semaine!'); 

        }else if ($com == null) {

            return redirect()->back()->with('error', 'Le commentaire est vide!'); 

        }else{

            DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['commentaire_semaine1' => $com]);
          
            return redirect()->back()->with('success', 'Commentaire semaine 1 ajouté, Merci!');  
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
        else if ($com == null) {

            return redirect()->back()->with('error', 'Le commentaire est vide!'); 

        }else if ($dataApprenant->commentaire_semaine2 != null) {

            return redirect()->back()->with('error', 'Vous avez déja écrit quelque chose pour cette semaine!'); 

        }else{

            DB::table('apprenants')->where('user_id' ,'=' , $idApprenant)->update(['commentaire_semaine2' => $com]);
          
            return redirect()->back()->with('success', 'Commentaire semaine 2 ajouté, Merci!');  
        }
    }

    public function sendFormFormateur(Request $request) //Fonction de creation du fichier excel questionnaire formateur et envoi a l'admin.
    {

        $data;
        $apprenant = auth()->user()->id;
        $dataApprenant = User::where('id','=', $apprenant)->first();
         
        $quest1 = "Le formateur sait transmettre ses connaissances (maitrise son sujet, donne des exemples pratiques)";
        $quest2 = "Le formateur sait mobiliser les participants (donne envie d'apprendre, fait participer)"; 
        $quest3 = "Le formateur sait s'adapter à chaque participant (personnalise son message, s'adapte au contexte de chacun)"; 
        $quest4 = "Le formateur a des points forts"; 
        $quest5 = "Les supports utilisés en formation étaient utiles pour apprendre (documents, vidéos)"; 
        $quest6 = "La progression pédagogique est adaptée (rythme, difficulté progressive, équilibre théorie/pratique...)"; 
        $quest7 = "L’alternance de moments de « théorie » avec des travaux pratiques vous a-t-elle semblé équilibrée"; 
        $quest8 = "Le niveau du formateur vous a semblé correct"; 
        $quest9 = "Le formateur a tenu un langage clair"; 
        $quest10 = "Le formateur a respecté le contenu du programme,il vous a aidé à atteindre les objectifs"; 
        $quest11 = "Il y a eu une adaptation au rythme, au contenu"; 
        $quest12 = "La qualité des exemples cités"; 
        $quest13 = "Le niveau des aptitudes (élocution, postures, tenue)"; 
        $quest14 = "Le niveau de compétences et de disponibilité";
        $quest15 = "Globalement, j'ai été très satisfait(e) du formateur";
        $quest16 = "Si vous deviez suivre à nouveau une formation, le feriez-vous volontiers avec ce formateur ?";
        $quest17 = "Recommanderiez-vous ce formateur à un centre de formation ou à une entreprise ?";    

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

        Mail::to('houselstein.thibaud@gmail.com')->send(new QuestionnaireFormateur($array_file));

        File::delete('storage/questionnaire_formateur.xlsx');

        DB::table('apprenants')->where('user_id' ,'=' , $apprenant)->update(['questionnaire_formateur' => 1]);

        return redirect()->back()->with('success', 'Questionnaire envoyé, merci!'); 

    }

    public function sendFormFormation(Request $request)// Fonction d'envoi du questionnaire et des réponses a l'admin.
    {

        $data;
        $apprenant = auth()->user()->id;
        $dataApprenant = User::where('id','=', $apprenant)->first();
              
        $quest1 = "Qualités des informations communiquées";
        $quest2 = "Clarté des critères de sélection"; 
        $quest3 = "Qualité des entretiens et des tests de recrutement"; 
        $quest4 = "Accompagnement pour la constitution du dossier de rémunération"; 
        $quest5 = "Accueil et service"; 
        $quest6 = "Qualité des salles de formation"; 
        $quest7 = "Qualité du matériel utilisé"; 
        $quest8 = "Accessibilité des locaux"; 
        $quest9 = "Adéquation de la formation avec vos objectifs d'emploi"; 
        $quest10 = "Parcours de formation adapté à votre niveau"; 
        $quest11 = "Durée de la formation"; 
        $quest12 = "Efficacité du parcours proposé"; 
        $quest13 = "Disponibilité du formateur"; 
        $quest14 = "Qualité d'animation du formateur";
        $quest15 = "Maîtrise du sujet et connaissance du secteur/métier par le formateur";
        $quest16 = "Qualité des supports pédagogiques de la formation";
        $quest17 = "Homogénéité du groupe";
        $quest18 = "Participation du groupe";
        $quest19 = "Ambiance générale de la formation"; 
        $quest19 = "Ambiance générale de la formation";
        $quest20 = "Vos commentaires sur cette formation";
        $quest21 = "Vous avez particulierement apprécié";
        $quest22 = "Vos suggestions d'amélioration";

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

        Mail::to('houselstein.thibaud@gmail.com')->send(new QuestionnaireFormation($array_file));//Envoi du mail a l'admin avec fichier excel.

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
