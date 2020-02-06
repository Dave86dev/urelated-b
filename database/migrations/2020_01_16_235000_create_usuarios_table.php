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
            $table->string('email')->unique();                   //email
            $table->string('picture')->nullable();               //foto de usuario
            $table->string('phone')->nullable();                 //telefono
            $table->string('password');                          //password
            $table->string('secretQ');                           //secret question
            $table->string('secretA');                           //secret answer
            $table->string('token')->nullable();                 //token
            $table->string('ciudad');                            //ciudad
            $table->string('provincia');                         //provincia
            $table->string('pais');                              //pais
            $table->string('name');                              //nombre 
            $table->string('surname')->nullable();               //apellido
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
