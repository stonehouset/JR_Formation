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
            $table->dateTime('date_jour')->nullable();
            $table->unsignedInteger('apprenant_id')->nullable();
            $table->unsignedInteger('formateur_id')->nullable();
            $table->text('commentaire', 200);
            $table->integer('type');
            $table->char('formation', 100)->nullable();
            
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
