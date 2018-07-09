<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Apprenant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apprenants', function (Blueprint $table) {

            $table->unsignedInteger('user_id');      
            $table->char('sexe', 10)->nullable();
            $table->date('date_naissance')->nullable();
            $table->char('id_pole_emploi', 20)->unique()->nullable();      
            $table->char('numero_ss', 20)->nullable();
            $table->unsignedInteger('formation_id')->nullable();
            $table->string('groupe_formation')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('nationalite')->nullable();
            $table->char('adresse', 40)->nullable();   
            $table->date('debut_tutorat')->nullable();
            $table->date('fin_tutorat')->nullable();
            $table->date('date_cdi')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
