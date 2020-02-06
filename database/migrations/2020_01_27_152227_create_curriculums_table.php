<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurriculumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curriculums', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('idusuario');            //id usuario
            $table->foreign('idusuario', 'fk_curriculums_usuarios')
            ->on('usuarios')
            ->references('id')
            ->onDelete('restrict');
            $table->boolean('isWorking');                       //si está trabajando o no
            $table->boolean('isWorked_before');                 //si ha trabajado con anterioridad
            $table->boolean('isEstudios');                      //si tiene estudios oficiales
            $table->string('formacion', 2000)->nullable();      //formacion del candidato
            $table->string('experiencia', 2000)->nullable();    //experiencia del candidato
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculums');
    }
}
