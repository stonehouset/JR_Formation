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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/interface_apprenant', function () {
    return view('interface_apprenant');
});

Route::get('/interface_formateur', function () {
    return view('interface_formateur');
});

Route::get('/interface_client', function () {
    return view('interface_client');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
