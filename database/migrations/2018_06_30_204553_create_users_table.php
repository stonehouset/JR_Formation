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
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->char('numero_telephone', 10)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role')->default(0);
            $table->rememberToken();
            $table->timestamps();
            
        });

        DB::table('users')->insert(

            array(

                'nom' => 'Rivet',
                'prenom' => 'Julien',
                'numero_telephone' => '0662820768',
                'email' => 'ju.rivet1@gmail.com',
                'password' => bcrypt('JrT_Formation42'), // secret
                'role' => '3',
               
            )

        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');

        $table->foreign('formateur_id')->references('id')->on('commentaires')->onDelete('cascade');
    }
}
