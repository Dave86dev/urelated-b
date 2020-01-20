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
            $table->string('salario')->nullable();
            $table->string('req_academicos')->nullable();;
            $table->string('des_requisitos')->nullable();;
            $table->string('sector');
            $table->integer('num_vacantes');
            $table->string('desc_general')->nullable();;
            $table->unsignedBigInteger('idempresa');
            $table->foreign('idempresa', 'fk_ofertas_empresas')
            ->on('empresas')
            ->references('id')
            ->onDelete('restrict');
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
