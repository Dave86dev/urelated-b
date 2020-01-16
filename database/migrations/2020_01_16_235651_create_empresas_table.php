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
            $table->string('email');         //email
            $table->string('password');      //password
            $table->string('name_reg');      //nombre registrante
            $table->string('surname_reg');   //apellido registrante
            $table->string('name');          //nombre empresa
            $table->string('phone');         //teléfono empresa
            $table->string('fiscal');        //id fiscal
            $table->string('description');   //descripción empresa
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
