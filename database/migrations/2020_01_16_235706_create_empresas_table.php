<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('email')->unique();               //email
            $table->string('picture')->nullable();          //foto de empresa
            $table->string('password');                     //password
            $table->string('secretQ');                      //secret question
            $table->string('secretA');                      //secret answer
            $table->string('token')->nullable();                      //secret answer
            $table->string('name_reg');                     //nombre registrante
            $table->string('surname_reg')->nullable();      //apellido registrante
            $table->string('name');                         //nombre empresa
            $table->string('phone')->nullable();            //teléfono empresa
            //$table->string('fiscal')->nullable();           id fiscal
            $table->string('description')->nullable();      //descripción empresa
            $table->string('sector')->nullable();           //descripción empresa
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
