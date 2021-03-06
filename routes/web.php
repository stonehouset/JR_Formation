<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route page accueil.

Route::get('/', function () {

    return view('welcome');
    
});

Route::group(['middleware' => ['admin']], function () {
    
    Route::get('/home', 'HomeController@index')->name('home');
	Route::get('commentaires', [ 'as' => 'commentaires', 'uses' => 'CommentaireController@showCommentaires']);
	Route::get('apprenants_admin_csv', [ 'as' => 'apprenants_admin_csv', 'uses' => 'HomeController@extractApprenantCsv']);
	Route::get('get_csv_apprenant', [ 'as' => 'get_csv_apprenant', 'uses' => 'HomeController@GetCSVApprenant']);
	Route::get('questionnaires', [ 'as' => 'questionnaires', 'uses' => 'HomeController@showQuestionnaires']);


	Route::post('client', [ 'as' => 'client', 'uses' => 'ClientController@store']);
	Route::post('formateur', [ 'as' => 'formateur', 'uses' => 'FormateurController@store']);
	Route::post('apprenant', [ 'as' => 'apprenant', 'uses' => 'ApprenantController@importCsv']);
	Route::post('formation', [ 'as' => 'formation', 'uses' => 'FormationController@store']);
	Route::post('suppr_formation', [ 'as' => 'suppr_formation', 'uses' => 'HomeController@supprFormation']);
	Route::post('delete_user', [ 'as' => 'delete_user', 'uses' => 'HomeController@deleteUser']);
	Route::post('evalFormateur', [ 'as' => 'evalFormateur', 'uses' => 'QuestionnaireController@updateEvalFormateur']);
	Route::post('evalFormation', [ 'as' => 'evalFormation', 'uses' => 'QuestionnaireController@updateEvalFormation']);
	Route::post('autoEval', [ 'as' => 'autoEval', 'uses' => 'QuestionnaireController@updateAutoEval']);
	Route::post('impactFormation', [ 'as' => 'impactFormation', 'uses' => 'QuestionnaireController@updateImpactFormation']);
   
});

Route::group(['middleware' => ['client']], function () {
    
    Route::get('/interface_client', 'ClientController@index')->name('interface_client');

    Route::post('impact_formation', [ 'as' => 'impact_formation', 'uses' => 'ClientController@impactFormation']);
    Route::post('suivi_apprenant', [ 'as' => 'suivi_apprenant', 'uses' => 'ClientController@suiviApprenant']);

});

Route::group(['middleware' => ['formateur']], function () {
    
    Route::get('/interface_formateur', 'FormateurController@index')->name('interface_formateur');    
	Route::get('/questionnaire_formation', 'HomeController@questionnaireFormation')->name('questionnaire_formation');

	Route::post('commentaire_journalier', [ 'as' => 'commentaire_journalier', 'uses' => 'FormateurController@commentaireJournalierFormation']);
	Route::post('commentaire', [ 'as' => 'commentaire', 'uses' => 'CommentaireController@create']);
	Route::post('absence_retard', [ 'as' => 'absence_retard', 'uses' => 'AbsenceRetardController@create']);
	Route::post('note_apprenant', [ 'as' => 'note_apprenant', 'uses' => 'FormateurController@ajoutNote']);
	Route::post('send_compte_rendu_formarteur', [ 'as' => 'send_compte_rendu_formarteur', 'uses' => 'FormateurController@sendCompteRenduFormateur']);

});

Route::group(['middleware' => ['apprenant']], function () {
    
    Route::get('/interface_apprenant', 'ApprenantController@index')->name('interface_apprenant');
    Route::get('/creation_en_cours', 'HomeController@creationEnCours')->name('creation_en_cours');

    Route::post('send_form_formateur_apprenant', [ 'as' => 'send_form_formateur_apprenant', 'uses' => 'ApprenantController@sendFormFormateur']);
	Route::post('send_form_formation_apprenant', [ 'as' => 'send_form_formation_apprenant', 'uses' => 'ApprenantController@sendFormFormation']);
	Route::post('comFormSem1', [ 'as' => 'comFormSem1', 'uses' => 'ApprenantController@ajoutComSem1']);
	Route::post('comFormSem2', [ 'as' => 'comFormSem2', 'uses' => 'ApprenantController@ajoutComSem2']);
	Route::post('comFormSem3', [ 'as' => 'comFormSem3', 'uses' => 'ApprenantController@ajoutComSem3']);


});
   
//Routes Post

Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\AuthController@login']);
Route::post('change_user_password', [ 'as' => 'change_user_password', 'uses' => 'HomeController@changeUserPassword']);

//Routes Get

Route::get('/profil', 'HomeController@profil')->name('profil');
Route::get('downloadPdf', [ 'as' => 'downloadPdf', 'uses' => 'ApprenantController@getDownload']);
Route::get('downloadPdfClient', [ 'as' => 'downloadPdfClient', 'uses' => 'ClientController@getDownload']);
Route::get('/layouts.menu', 'HomeController@initials')->name('layouts.menu');
Route::get('apprenants_csv', [ 'as' => 'apprenants_csv', 'uses' => 'ClientController@extractCsv']);
Route::get('apprenants_formateur_csv', [ 'as' => 'apprenants_formateur_csv', 'uses' => 'HomeController@extractFormateurCsv']);
Route::get('formateur_apprenants_csv', [ 'as' => 'formateur_apprenants_csv', 'uses' => 'FormateurController@extractApprenantCsv']);


//Routes authentification Laravel.

Auth::routes();


