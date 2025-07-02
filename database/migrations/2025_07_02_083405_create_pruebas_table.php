<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('pruebas', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('codigoNombrePrueba');
    $table->year('anioEdicion');
    $table->unsignedInteger('numEtapas');
    $table->decimal('kilometrosTotales', 8, 2);
    $table->string('idCiclista', 10);
    $table->timestamps();

    $table->foreign('codigoNombrePrueba')->references('codigoNombrePrueba')->on('nombrespruebas');
    $table->foreign('idCiclista')->references('codigoCiclista')->on('ciclistas');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pruebas');
    }
};
