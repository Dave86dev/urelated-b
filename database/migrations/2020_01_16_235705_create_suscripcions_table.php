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
            // $table->integer('oferta_id');
            // $table->integer('usuario_id');
            $table->string('estado');
            $table->date('fecha_sus');
            $table->unsignedBigInteger('idusuario');
            $table->foreign('idusuario', 'fk_suscripcions_usuarios')
            ->on('usuarios')
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
