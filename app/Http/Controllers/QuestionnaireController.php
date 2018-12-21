<?php

namespace JR_Formation\Http\Controllers;

use Illuminate\Http\Request;
use JR_Formation\Questionnaire;
use Auth;
use DB;
use Schema;
use Model;

class QuestionnaireController extends Controller
{

    public function updateEvalFormateur(Request $request)
    {

        $champ1 = $request->quest1_eval_formateur_admin;
        $champ2 = $request->quest2_eval_formateur_admin;
        $champ3 = $request->quest3_eval_formateur_admin;
        $champ4 = $request->quest4_eval_formateur_admin;
        $champ5 = $request->quest5_eval_formateur_admin;
        $champ6 = $request->quest6_eval_formateur_admin;
        $champ7 = $request->quest7_eval_formateur_admin;
        $champ8 = $request->quest8_eval_formateur_admin;
        $champ9 = $request->quest9_eval_formateur_admin;
        $champ10 = $request->quest10_eval_formateur_admin;
        $champ11 = $request->quest11_eval_formateur_admin;
        $champ12 = $request->quest12_eval_formateur_admin;
        $champ13 = $request->quest13_eval_formateur_admin;
        $champ14 = $request->quest14_eval_formateur_admin;
        $champ15 = $request->quest15_eval_formateur_admin;
        $champ16 = $request->quest16_eval_formateur_admin;
        $champ17 = $request->quest17_eval_formateur_admin;

        if (strlen($champ1) > 200 || strlen($champ2) > 200 || strlen($champ3) > 200 || strlen($champ4) > 200 || strlen($champ5) > 200 || strlen($champ6) > 200 || strlen($champ7) > 200 || strlen($champ8) > 200 || strlen($champ9) > 200 || strlen($champ10) > 200 || strlen($champ11) > 200 || strlen($champ12) > 200 || strlen($champ13) > 200 || strlen($champ14) > 200 || strlen($champ15) > 200 || strlen($champ16) > 200 || strlen($champ17) > 200){

    			return redirect()->back()->with('error', 'Un des champs fait plus de 200 caractères!');
		} 


        if ($champ1 == null && $champ2 == null && $champ3 == null && $champ4 == null && $champ5 == null && $champ6 == null && $champ7 == null && $champ8 == null && $champ9 == null && $champ10 == null && $champ11 == null && $champ12 == null && $champ13 == null && $champ14 == null && $champ15 == null && $champ16 == null && $champ17 == null) {
        	
        	return redirect()->back()->with('error', 'Tous les champs sont vides, rien à modifier!');

        }else{

        	if ($champ1 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ1' => $champ1]);
        	}
        	if ($champ2 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ2' => $champ2]);
        	}
        	if ($champ3 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ3' => $champ3]);
        	}
        	if ($champ4 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ4' => $champ4]);
        	}
        	if ($champ5 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ5' => $champ5]);
        	}
        	if ($champ6 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ6' => $champ6]);
        	}
        	if ($champ7 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ7' => $champ7]);
        	}
        	if ($champ8 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ8' => $champ8]);
        	}
        	if ($champ9 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ9' => $champ9]);
        	}
        	if ($champ10 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ10' => $champ10]);
        	}
        	if ($champ11 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ11' => $champ11]);
        	}
        	if ($champ12!= null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ12' => $champ12]);
        	}
        	if ($champ13 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ13' => $champ13]);
        	}
        	if ($champ14 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ14' => $champ14]);
        	}
        	if ($champ15 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ15' => $champ15]);
        	}
        	if ($champ16 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ16' => $champ16]);
        	}
        	if ($champ17 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 1)->update(['champ17' => $champ17]);
        	}


        	return redirect()->back()->with('success', 'Questionnaire modifié!');
        }
        


    }

    public function updateEvalFormation(Request $request)
    {

        $champ1 = $request->quest1_eval_formation_admin;
        $champ2 = $request->quest2_eval_formation_admin;
        $champ3 = $request->quest3_eval_formation_admin;
        $champ4 = $request->quest4_eval_formation_admin;
        $champ5 = $request->quest5_eval_formation_admin;
        $champ6 = $request->quest6_eval_formation_admin;
        $champ7 = $request->quest7_eval_formation_admin;
        $champ8 = $request->quest8_eval_formation_admin;
        $champ9 = $request->quest9_eval_formation_admin;
        $champ10 = $request->quest10_eval_formation_admin;
        $champ11 = $request->quest11_eval_formation_admin;
        $champ12 = $request->quest12_eval_formation_admin;
        $champ13 = $request->quest13_eval_formation_admin;
        $champ14 = $request->quest14_eval_formation_admin;
        $champ15 = $request->quest15_eval_formation_admin;
        $champ16 = $request->quest16_eval_formation_admin;
        $champ17 = $request->quest17_eval_formation_admin;
        $champ18 = $request->quest18_eval_formation_admin;
        $champ19 = $request->quest19_eval_formation_admin;
        $champ20 = $request->quest20_eval_formation_admin;
        $champ21 = $request->quest21_eval_formation_admin;
        $champ22 = $request->quest22_eval_formation_admin;

        if (strlen($champ1) > 200 || strlen($champ2) > 200 || strlen($champ3) > 200 || strlen($champ4) > 200 || strlen($champ5) > 200 || strlen($champ6) > 200 || strlen($champ7) > 200 || strlen($champ8) > 200 || strlen($champ9) > 200 || strlen($champ10) > 200 || strlen($champ11) > 200 || strlen($champ12) > 200 || strlen($champ13) > 200 || strlen($champ14) > 200 || strlen($champ15) > 200 || strlen($champ16) > 200 || strlen($champ17) > 200 || strlen($champ18) > 200 || strlen($champ19) > 200 || strlen($champ20) > 200 || strlen($champ21) > 200 || strlen($champ22) > 200){

    			return redirect()->back()->with('error', 'Un des champs fait plus de 200 caractères!');
		} 

        if ($champ1 == null && $champ2 == null && $champ3 == null && $champ4 == null && $champ5 == null && $champ6 == null && $champ7 == null && $champ8 == null && $champ9 == null && $champ10 == null && $champ11 == null && $champ12 == null && $champ13 == null && $champ14 == null && $champ15 == null && $champ16 == null && $champ17 == null && $champ18 == null && $champ19 == null && $champ20 == null && $champ21 == null && $champ22 == null) {
        	
        	return redirect()->back()->with('error', 'Tous les champs sont vides, rien à modifier!');

        }else{

        	if ($champ1 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ1' => $champ1]);
        	}
        	if ($champ2 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ2' => $champ2]);
        	}
        	if ($champ3 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ3' => $champ3]);
        	}
        	if ($champ4 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ4' => $champ4]);
        	}
        	if ($champ5 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ5' => $champ5]);
        	}
        	if ($champ6 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ6' => $champ6]);
        	}
        	if ($champ7 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ7' => $champ7]);
        	}
        	if ($champ8 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ8' => $champ8]);
        	}
        	if ($champ9 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ9' => $champ9]);
        	}
        	if ($champ10 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ10' => $champ10]);
        	}
        	if ($champ11 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ11' => $champ11]);
        	}
        	if ($champ12!= null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ12' => $champ12]);
        	}
        	if ($champ13 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ13' => $champ13]);
        	}
        	if ($champ14 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ14' => $champ14]);
        	}
        	if ($champ15 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ15' => $champ15]);
        	}
        	if ($champ16 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ16' => $champ16]);
        	}
        	if ($champ17 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ17' => $champ17]);
        	}
        	if ($champ18 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ18' => $champ18]);
        	}
        	if ($champ19 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ19' => $champ19]);
        	}
        	if ($champ20 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ20' => $champ20]);
        	}
        	if ($champ21 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ21' => $champ21]);
        	}
        	if ($champ22 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 2)->update(['champ22' => $champ22]);
        	}


        	return redirect()->back()->with('success', 'Questionnaire modifié!');
        }

    }

    public function updateAutoEval(Request $request)
    {

        $champ1 = $request->quest1_autoeval_formateur_admin;
        $champ2 = $request->quest2_autoeval_formateur_admin;
        $champ3 = $request->quest3_autoeval_formateur_admin;
        $champ4 = $request->quest4_autoeval_formateur_admin;
        $champ5 = $request->quest5_autoeval_formateur_admin;
        $champ6 = $request->quest6_autoeval_formateur_admin;
        $champ7 = $request->quest7_autoeval_formateur_admin;
        $champ8 = $request->quest8_autoeval_formateur_admin;
        $champ9 = $request->quest9_autoeval_formateur_admin;
        $champ10 = $request->quest10_autoeval_formateur_admin;
        $champ11 = $request->quest11_autoeval_formateur_admin;
        $champ12 = $request->quest12_autoeval_formateur_admin;
        $champ13 = $request->quest13_autoeval_formateur_admin;
        $champ14 = $request->quest14_autoeval_formateur_admin;
        $champ15 = $request->quest15_autoeval_formateur_admin;
        $champ16 = $request->quest16_autoeval_formateur_admin;
        $champ17 = $request->quest17_autoeval_formateur_admin;
        $champ18 = $request->quest18_autoeval_formateur_admin;
        $champ19 = $request->quest19_autoeval_formateur_admin;

        if (strlen($champ1) > 200 || strlen($champ2) > 200 || strlen($champ3) > 200 || strlen($champ4) > 200 || strlen($champ5) > 200 || strlen($champ6) > 200 || strlen($champ7) > 200 || strlen($champ8) > 200 || strlen($champ9) > 200 || strlen($champ10) > 200 || strlen($champ11) > 200 || strlen($champ12) > 200 || strlen($champ13) > 200 || strlen($champ14) > 200 || strlen($champ15) > 200 || strlen($champ16) > 200 || strlen($champ17) > 200 || strlen($champ18) > 200 || strlen($champ19) > 200){

    			return redirect()->back()->with('error', 'Un des champs fait plus de 200 caractères!');
		} 

        if ($champ1 == null && $champ2 == null && $champ3 == null && $champ4 == null && $champ5 == null && $champ6 == null && $champ7 == null && $champ8 == null && $champ9 == null && $champ10 == null && $champ11 == null && $champ12 == null && $champ13 == null && $champ14 == null && $champ15 == null && $champ16 == null && $champ17 == null && $champ18 == null && $champ19 == null) {
        	
        	return redirect()->back()->with('error', 'Tous les champs sont vides, rien à modifier!');

        }else{

        	if ($champ1 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ1' => $champ1]);
        	}
        	if ($champ2 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ2' => $champ2]);
        	}
        	if ($champ3 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ3' => $champ3]);
        	}
        	if ($champ4 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ4' => $champ4]);
        	}
        	if ($champ5 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ5' => $champ5]);
        	}
        	if ($champ6 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ6' => $champ6]);
        	}
        	if ($champ7 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ7' => $champ7]);
        	}
        	if ($champ8 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ8' => $champ8]);
        	}
        	if ($champ9 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ9' => $champ9]);
        	}
        	if ($champ10 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ10' => $champ10]);
        	}
        	if ($champ11 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ11' => $champ11]);
        	}
        	if ($champ12!= null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ12' => $champ12]);
        	}
        	if ($champ13 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ13' => $champ13]);
        	}
        	if ($champ14 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ14' => $champ14]);
        	}
        	if ($champ15 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ15' => $champ15]);
        	}
        	if ($champ16 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ16' => $champ16]);
        	}
        	if ($champ17 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ17' => $champ17]);
        	}
        	if ($champ18 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ18' => $champ18]);
        	}
        	if ($champ19 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 3)->update(['champ19' => $champ19]);
        	}

        	return redirect()->back()->with('success', 'Questionnaire modifié!');
        }

    }

    public function updateImpactFormation(Request $request)
    {

        $champ1 = $request->quest1_impact_formation_admin;
        $champ2 = $request->quest2_impact_formation_admin;
        $champ3 = $request->quest3_impact_formation_admin;
        $champ4 = $request->quest4_impact_formation_admin;
        $champ5 = $request->quest5_impact_formation_admin;
        $champ6 = $request->quest6_impact_formation_admin;
        $champ7 = $request->quest7_impact_formation_admin;
        $champ8 = $request->quest8_impact_formation_admin;
        $champ9 = $request->quest9_impact_formation_admin;
        $champ10 = $request->quest10_impact_formation_admin;
        $champ11 = $request->quest11_impact_formation_admin;
        $champ12 = $request->quest12_impact_formation_admin;
        $champ13 = $request->quest13_impact_formation_admin;
        $champ14 = $request->quest14_impact_formation_admin;
        $champ15 = $request->quest15_impact_formation_admin;
        $champ16 = $request->quest16_impact_formation_admin;
        $champ17 = $request->quest17_impact_formation_admin;
        $champ18 = $request->quest18_impact_formation_admin;
        $champ19 = $request->quest19_impact_formation_admin;

        if (strlen($champ1) > 200 || strlen($champ2) > 200 || strlen($champ3) > 200 || strlen($champ4) > 200 || strlen($champ5) > 200 || strlen($champ6) > 200 || strlen($champ7) > 200 || strlen($champ8) > 200 || strlen($champ9) > 200 || strlen($champ10) > 200 || strlen($champ11) > 200 || strlen($champ12) > 200 || strlen($champ13) > 200 || strlen($champ14) > 200 || strlen($champ15) > 200 || strlen($champ16) > 200 || strlen($champ17) > 200 || strlen($champ18) > 200 || strlen($champ19) > 200){

    			return redirect()->back()->with('error', 'Un des champs fait plus de 200 caractères!');
		} 

        if ($champ1 == null && $champ2 == null && $champ3 == null && $champ4 == null && $champ5 == null && $champ6 == null && $champ7 == null && $champ8 == null && $champ9 == null && $champ10 == null && $champ11 == null && $champ12 == null && $champ13 == null && $champ14 == null && $champ15 == null && $champ16 == null && $champ17 == null && $champ18 == null && $champ19 == null) {
        	
        	return redirect()->back()->with('error', 'Tous les champs sont vides, rien à modifier!');

        }else{

        	if ($champ1 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ1' => $champ1]);
        	}
        	if ($champ2 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ2' => $champ2]);
        	}
        	if ($champ3 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ3' => $champ3]);
        	}
        	if ($champ4 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ4' => $champ4]);
        	}
        	if ($champ5 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ5' => $champ5]);
        	}
        	if ($champ6 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ6' => $champ6]);
        	}
        	if ($champ7 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ7' => $champ7]);
        	}
        	if ($champ8 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ8' => $champ8]);
        	}
        	if ($champ9 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ9' => $champ9]);
        	}
        	if ($champ10 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ10' => $champ10]);
        	}
        	if ($champ11 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ11' => $champ11]);
        	}
        	if ($champ12!= null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ12' => $champ12]);
        	}
        	if ($champ13 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ13' => $champ13]);
        	}
        	if ($champ14 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ14' => $champ14]);
        	}
        	if ($champ15 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ15' => $champ15]);
        	}
        	if ($champ16 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ16' => $champ16]);
        	}
        	if ($champ17 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ17' => $champ17]);
        	}
        	if ($champ18 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ18' => $champ18]);
        	}
        	if ($champ19 != null ) {
        		
        		DB::table('questionnaires')->where('id' ,'=' , 4)->update(['champ19' => $champ19]);
        	}

        	return redirect()->back()->with('success', 'Questionnaire modifié!');
        }

    }
}
