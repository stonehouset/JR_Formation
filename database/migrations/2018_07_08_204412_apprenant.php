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
            $table->char('sexe', 10);
            $table->date('date_naissance');
            $table->char('id_pole_emploi', 20)->unique();      
            $table->char('numero_ss', 20)->unique();
            $table->unsignedInteger('formation_id')->nullable();
            $table->string('groupe_formation');
            $table->string('lieu_naissance');
            $table->string('nationalite');
            $table->char('adresse', 100);   
            $table->date('date_embauche')->nullable();
            $table->char('motif_non_embauche', 100)->nullable();
            $table->char('note_formation', 5)->nullable();
            $table->char('note_formateur', 5)->nullable();
            $table->char('embauche_2_mois', 10)->nullable();
            $table->char('embauche_6_mois', 10)->nullable();
            $table->text('motif_predefini', 200)->nullable(); 
            $table->text('motif_non_embauche_2_mois', 200)->nullable(); 
            $table->text('motif_non_embauche_6_mois', 200)->nullable(); 
            $table->text('commentaire_semaine1', 500)->nullable(); 
            $table->text('commentaire_semaine2', 500)->nullable(); 

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
