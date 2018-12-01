<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(JR_Formation\User::class, function (Faker $faker) {

    return [

    	'nom' => 'Rivet',
        'prenom' => 'Julien',
        'numero_telephone' => '0662820768',
        'email' => 'ju.rivet1@gmail.com',
        'password' => bcrypt('JrT_Formation42'), // secret
        'role' => '3',
        'remember_token' => rememberToken(),
        'timestamps' => timestamps(),

    ];
});
