<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipacionesEquiposTable extends Migration
{
    public function up()
    {
        Schema::create('participaciones_equipos', function (Blueprint $table) {
            $table->id('codigoParticipacionEquipo'); // PK auto_increment
            $table->unsignedBigInteger('idPrueba');
            $table->unsignedBigInteger('codigoEquipo');
            $table->string('posicionFinal', 20);
            $table->timestamps();

            $table->foreign('idPrueba')->references('id')->on('pruebas')->onDelete('cascade');
            $table->foreign('codigoEquipo')->references('codigoEquipo')->on('equipos')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('participaciones_equipos');
    }
}
