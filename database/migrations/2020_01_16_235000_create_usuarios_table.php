<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            //$table->date('birthday');                           //fecha de nacimiento
            //$table->string('genre');                            //genero
            $table->string('email');                            //email
            $table->string('phone')->nullable();               //telefono
            $table->string('password');                         //password
            $table->string('secretQ');                          //secret question
            $table->string('secretA');                          //secret answer
            $table->string('token')->nullable();                          //secret answer
            //$table->string('cpostal')->nullable();;             //código postal
            $table->string('ciudad');                           //código postal
            $table->string('provincia');                        //código postal
            $table->string('pais');                             //código postal
            $table->string('name');                             //nombre 
            $table->string('surname')->nullable();             //apellido
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
