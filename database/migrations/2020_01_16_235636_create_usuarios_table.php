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
            $table->date('birthday');              //fecha de nacimiento
            $table->string('genre');               //genero
            $table->string('phone');               //email
            $table->string('password');            //password
            $table->string('cpostal');             //código postal
            $table->string('ciudad');              //código postal
            $table->string('provincia');           //código postal
            $table->string('pais');                //código postal
            $table->string('name');                //nombre 
            $table->string('surname');             //apellido
            $table->boolean('working');            //si está trabajando o no
            $table->boolean('worked_before');      //si ha trabajado con anterioridad
            $table->boolean('estudios_oficiales'); //si ha trabajado con anterioridad
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
