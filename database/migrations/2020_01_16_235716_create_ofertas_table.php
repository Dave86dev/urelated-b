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
            $table->string('titulo');                             //puesto de la oferta
            $table->string('ciudad');                             //ciudad 
            $table->boolean('isActive');                          //oferta si esta activa o no
            $table->integer('estado');                            //estado de a oferta
            $table->date('fecha_publi');                          //fecha publicacion
            $table->integer('exp_requerida');                     //experiencia requerida
            $table->string('tipo_contrato');                      //tipo contrato
            $table->integer('salario')->nullable();               //salario
            $table->string('sector');                             //sector
            $table->integer('num_vacantes');                      //numero vacantes
            $table->string('desc_general', 2000)->nullable();;    //descripcion general
            $table->unsignedBigInteger('idempresa');              //id empresa que crea la oferta
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
