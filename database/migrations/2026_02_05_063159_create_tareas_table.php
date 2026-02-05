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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            
            // Relación con categorías (una tarea tiene UNA categoría)
            $table->foreignId('categoria_id')
                  ->constrained('categorias')
                  ->onDelete('cascade'); // Si se elimina la categoría, se eliminan sus tareas
            
            $table->boolean('completada')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};