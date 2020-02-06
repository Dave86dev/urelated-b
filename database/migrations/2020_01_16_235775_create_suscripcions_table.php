<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuscripcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suscripcions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('estado');                              //estado suscripcion
            $table->date('fecha_sus');                              //fecha suscripcion
            $table->unsignedBigInteger('idusuario');                //id usuario suscrito
            $table->foreign('idusuario', 'fk_suscripcions_usuarios')
            ->on('usuarios')
            ->references('id')
            ->onDelete('restrict');
            $table->unsignedBigInteger('idoferta');                  //id oferta suscrita
            $table->foreign('idoferta', 'fk_suscripcions_ofertas')   
            ->on('ofertas')
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
        Schema::dropIfExists('suscripcions');
    }
}
