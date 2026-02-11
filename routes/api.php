<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriaApiController;
use App\Http\Controllers\Api\TareaApiController;
use App\Http\Controllers\Api\EtiquetaApiController;

Route::apiResource('tareas', TareaApiController::class)->names('api.tareas');
Route::apiResource('categorias', CategoriaApiController::class)->names('api.categorias');
Route::apiResource('etiquetas', EtiquetaApiController::class)->names('api.etiquetas');

Route::post('tareas/{id}/toggle', [TareaApiController::class, 'toggleCompletada']);