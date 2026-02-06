<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EtiquetaController;

Route::get('/', function () {
    return redirect()->route('tareas.index');
});

Route::resource('tareas', TareaController::class);
Route::resource('categorias', CategoriaController::class);
Route::resource('etiquetas', EtiquetaController::class);

// ruta adiccional toggle
Route::post('/tareas/{tarea}/toggle', [TareaController::class, 'toggleCompletada'])->name('tareas.toggle');