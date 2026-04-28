<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla 'ventas' con sus respectivas columnas y relaciones.
     */
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
           $table->id();           
            $table->foreignId('cliente_id')->constrained('clientes')->cascadeOnUpdate()->restrictOnDelete();
            $table->decimal('total', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->string('estado')->default('pendiente');
            $table->timestamps();
        }); 
    }

    /**
     * Elimina la tabla 'ventas' si existe.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
