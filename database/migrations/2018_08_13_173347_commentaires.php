<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Commentaires extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {

            $table->increments('id');
            $table->date('date_jour')->nullable();
            $table->unsignedInteger('apprenant_id');
            $table->unsignedInteger('formateur_id');
            $table->text('commentaire', 1000);
            
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
