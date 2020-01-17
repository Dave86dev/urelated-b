<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('titulo');
            $table->string('ciudad');
            $table->date('fecha_publi');
            $table->string('exp_requerida');
            $table->string('tipo_contrato');
            $table->string('salario');
            $table->string('req_academicos');
            $table->string('des_requisitos');
            $table->string('sector');
            $table->integer('num_vacantes');
            $table->string('desc_general');
            // $table->integer('empresa_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ofertas');
    }
}
