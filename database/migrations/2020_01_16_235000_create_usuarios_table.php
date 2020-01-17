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
            $table->boolean('isWorking');          //si está trabajando o no
            $table->boolean('isWorked_before');    //si ha trabajado con anterioridad
            $table->boolean('isEstudios');         //si tiene estudios oficiales
            
        });
    }

/* public function up()
    {
        Schema::create('dispreds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numero', 20)->nullable($value = true);
            $table->unsignedBigInteger('idmarca');
            $table->foreign('idmarca', 'fk_dispreds_marcas')
            ->on('marcas')
            ->references('id')
            ->onDelete('restrict');
            $table->string('modelo', 20)->nullable($value = true);
            $table->unsignedBigInteger('idubicacion');
            $table->foreign('idubicacion', 'fk_dispreds_ubicacions')
            ->on('ubicacions')
            ->references('id')
            ->onDelete('restrict');
            $table->string('tpdisp', '20')->nullable($value = true);
            $table->string('numserie', '25')->nullable($value = true);
            $table->string('red', '20')->nullable($value = true);
            $table->macAddress('maclan')->nullable($value = true);
            $table->ipAddress('iplan')->nullable($value = true);
            $table->longText('observaciones')->nullable($value = true);
            $table->timestamps();
        });
//         dispreds (id ai pk, numero vchar20, idmarca FK, modelo vchar20, idubicacion FK, tpdisp
// vchar20, numserie vchar25, red vchar20, maclan macAddress, iplan ipAddress, observaciones
// longText)
    }*/ 


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
