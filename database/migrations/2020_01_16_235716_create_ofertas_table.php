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
            $table->string('provincia');
            $table->boolean('isActive');
            $table->integer('estado');
            $table->date('fecha_publi');
            $table->integer('exp_requerida');
            $table->string('tipo_contrato');
            $table->integer('salario')->nullable();
            $table->string('sector');
            $table->integer('num_vacantes');
            $table->string('desc_general', 2000)->nullable();;
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
