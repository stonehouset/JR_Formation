<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Formation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formations', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nom');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->unsignedInteger('client_id1');
            $table->unsignedInteger('client_id2')->nullable();
            $table->unsignedInteger('client_id3')->nullable();
            $table->unsignedInteger('client_id4')->nullable();
            $table->unsignedInteger('client_id5')->nullable();
            $table->unsignedInteger('formateur_id');
            $table->char('programme_formation', 100);
            $table->integer('compte_rendu_formateur')->default(0);
            $table->integer('impact_formation')->default(0);
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
        //
    }
}
