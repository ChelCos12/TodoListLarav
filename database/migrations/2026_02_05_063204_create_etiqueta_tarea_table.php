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
        Schema::create('etiqueta_tarea', function (Blueprint $table) {
            $table->id();
            
            // Relación con tareas
            $table->foreignId('tarea_id')
                  ->constrained('tareas')
                  ->onDelete('cascade'); // Si se elimina la tarea, se eliminan sus relaciones
            
            // Relación con etiquetas
            $table->foreignId('etiqueta_id')
                  ->constrained('etiquetas')
                  ->onDelete('cascade'); // Si se elimina la etiqueta, se eliminan sus relaciones
            
            // Evitar duplicados: una tarea no puede tener la misma etiqueta dos veces
            $table->unique(['tarea_id', 'etiqueta_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etiqueta_tarea');
    }
};