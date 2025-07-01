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
        Schema::create('ciclistas', function (Blueprint $table) {
        $table->string('codigoCiclista', 10)->primary();
        $table->string('imagen')->nullable();
        $table->string('nombre', 40);
        $table->string('apellido', 40);
        $table->date('fechaNacimiento');
        $table->unsignedBigInteger('codigoNacionalidad'); 
        $table->foreign('codigoNacionalidad')->references('codigoNacionalidad')->on('nacionalidads');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciclistas');
    }
};
