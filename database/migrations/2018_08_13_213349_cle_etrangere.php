<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CleEtrangere extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formation_formateur', function (Blueprint $table) {
             
            $table->foreign('user_id')->references('id')->on('users'); 
            $table->foreign('formation_id')->references('id')->on('formations'); 

        });

        Schema::table('apprenants', function (Blueprint $table) {

            $table->foreign('formation_id')->references('id')->on('formations'); 
            $table->foreign('user_id')->references('id')->on('users'); 

        });

        Schema::table('formations', function (Blueprint $table) {
            
            $table->foreign('client_id')->references('id')->on('users'); 
            $table->foreign('formateur_id')->references('id')->on('users');
              
        });

        Schema::table('absences_retards', function (Blueprint $table) {

            $table->foreign('formateur_id')->references('id')->on('users'); 
            $table->foreign('apprenant_id')->references('user_id')->on('apprenants'); 

        });

        Schema::table('commentaires', function (Blueprint $table) {

            $table->foreign('formateur_id')->references('id')->on('users'); 
            $table->foreign('apprenant_id')->references('user_id')->on('apprenants'); 

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
