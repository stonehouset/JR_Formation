<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->char('sexe', 10)->nullable();
            $table->char('id_pole_emploi', 20)->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('prenom')->nullable();
            $table->char('numero_ss', 20)->nullable();
            $table->char('numero_telephone', 10)->nullable();
            $table->string('email')->unique();
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('nationalite')->nullable();
            $table->char('adresse', 40)->nullable();   
            $table->date('debut_formation')->nullable();
            $table->date('fin_formation')->nullable();
            $table->date('debut_tutorat')->nullable();
            $table->date('fin_tutorat')->nullable();
            $table->date('date_CDI')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(0);
            $table->boolean('is_formateur')->default(0);
            $table->boolean('is_apprenant')->default(0);
            $table->rememberToken();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
