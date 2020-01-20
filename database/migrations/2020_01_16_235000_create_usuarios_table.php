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
            $table->date('birthday');                           //fecha de nacimiento
            $table->string('genre');                            //genero
            $table->string('phone')->nullable();;               //email
            $table->string('password');                         //password
            $table->string('cpostal')->nullable();;             //código postal
            $table->string('ciudad');                           //código postal
            $table->string('provincia');                        //código postal
            $table->string('pais');                             //código postal
            $table->string('name');                             //nombre 
            $table->string('surname')->nullable();;             //apellido
            $table->boolean('isWorking');                       //si está trabajando o no
            $table->boolean('isWorked_before');                 //si ha trabajado con anterioridad
            $table->boolean('isEstudios');                      //si tiene estudios oficiales
            
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
