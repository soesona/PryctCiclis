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
        Schema::create('contrato_ciclistas', function (Blueprint $table) {
            $table->id('idContrato'); // PK autoincremental

            $table->date('fechaInicio');
            $table->date('fechaFin')->nullable();

            $table->unsignedBigInteger('codigoEquipo');
            $table->string('codigoCiclista', 10); // porque la PK de ciclistas es string

            // Relaciones
            $table->foreign('codigoEquipo')->references('codigoEquipo')->on('equipos')->onDelete('cascade');

            $table->foreign('codigoCiclista')->references('codigoCiclista')->on('ciclistas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrato_ciclistas');
    }
};
