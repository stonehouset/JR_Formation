<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AbsencesRetards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absences_retards', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('type')->default(0);
            $table->date('date_jour')->nullable();
            $table->unsignedInteger('apprenant_id');
            $table->unsignedInteger('formateur_id');
            
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
