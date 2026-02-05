<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\EtiquetaController;

Route::get('/', function () {
    return redirect()->route('tareas.index');
});

// TAREAS

Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
Route::get('/tareas/{id}', [TareaController::class, 'show'])->name('tareas.show');
Route::get('/tareas/{id}/editar', [TareaController::class, 'edit'])->name('tareas.edit');
Route::put('/tareas/{id}', [TareaController::class, 'update'])->name('tareas.update');
Route::delete('/tareas/{id}', [TareaController::class, 'destroy'])->name('tareas.destroy');
Route::post('/tareas/{id}/toggle', [TareaController::class, 'toggleCompletada'])->name('tareas.toggle');

// CATEGORÍAS

Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::post('/categorias', [CategoriaController::class, 'store'])->name('categorias.store');
Route::get('/categorias/{id}', [CategoriaController::class, 'show'])->name('categorias.show');
Route::get('/categorias/{id}/editar', [CategoriaController::class, 'edit'])->name('categorias.edit');
Route::put('/categorias/{id}', [CategoriaController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/{id}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');

// ETIQUETAS

Route::get('/etiquetas', [EtiquetaController::class, 'index'])->name('etiquetas.index');
Route::post('/etiquetas', [EtiquetaController::class, 'store'])->name('etiquetas.store');
Route::get('/etiquetas/{id}', [EtiquetaController::class, 'show'])->name('etiquetas.show');
Route::get('/etiquetas/{id}/editar', [EtiquetaController::class, 'edit'])->name('etiquetas.edit');
Route::put('/etiquetas/{id}', [EtiquetaController::class, 'update'])->name('etiquetas.update');
Route::delete('/etiquetas/{id}', [EtiquetaController::class, 'destroy'])->name('etiquetas.destroy');