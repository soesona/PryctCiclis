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
        Schema::create('equipos', function (Blueprint $table) {
         $table->id('codigoEquipo');
         $table->string('nombreEquipo', 40);
         $table->date('fechaCreacion');
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
        Schema::dropIfExists('equipos');
    }
};
