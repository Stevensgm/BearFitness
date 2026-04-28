<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * crea la tabla 'clientes' con sus respectivas columnas.
     */
    public function up(): void
    {
         Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->String('nombre');
            $table->string('correo')->unique();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla 'clientes' si existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
