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
        Schema::create('contrato_directors', function (Blueprint $table) {
            $table->id('idContrato'); // PK autoincremental

            $table->date('fechaInicio');
            $table->date('fechaFin')->nullable();

            $table->unsignedBigInteger('codigoEquipo');
            $table->string('codigoDirector', 10); // porque la PK de directores es string

            // Relaciones
            $table->foreign('codigoEquipo')->references('codigoEquipo')->on('equipos')->onDelete('cascade');
            $table->foreign('codigoDirector')->references('codigoDirector')->on('directores')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrato_directors');
    }
};
