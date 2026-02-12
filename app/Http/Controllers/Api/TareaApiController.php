<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaApiController extends Controller
{

    public function index()
    {
        $tareas = Tarea::with(['categoria', 'etiquetas'])->paginate(10);
        return response()->json($tareas);
    }

    public function store(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'nullable',
            'categoria_id' => 'required|exists:categorias,id',
            'etiquetas' => 'nullable|array',
            'etiquetas.*' => 'exists:etiquetas,id'
        ]);
        
        $tarea = Tarea::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'] ?? null,
            'categoria_id' => $validated['categoria_id'],
            'completada' => false
        ]);
        
        if (isset($validated['etiquetas'])) {
            $tarea->etiquetas()->attach($validated['etiquetas']);
        }
        
        $tarea->load(['categoria', 'etiquetas']);
        
        return response()->json([
            'message' => 'Tarea creada exitosamente',
            'data' => $tarea
        ], 201);
    }
    public function show($id)
    {
        $tarea = Tarea::with(['categoria', 'etiquetas'])->find($id);
        
        if (!$tarea) {
            return response()->json([
                'success' => false,
                'message' => 'Tarea no encontrada'
            ], 404);
        }
        
        return response()->json([
            'data' => $tarea
        ], 200);
    }
    
    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'nullable',
            'categoria_id' => 'required|exists:categorias,id',
            'etiquetas' => 'nullable|array',
            'etiquetas.*' => 'exists:etiquetas,id'
        ]);

        $tarea->update([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'] ?? null,
            'categoria_id' => $validated['categoria_id']
        ]);

        if (isset($validated['etiquetas'])) {
            $tarea->etiquetas()->sync($validated['etiquetas']);
        } else {
            $tarea->etiquetas()->detach(); 
        }
        
        $tarea->load(['categoria', 'etiquetas']);
        
        return response()->json([
            'message' => 'Tarea actualizada exitosamente',
            'data' => $tarea
        ], 200);
    }
    
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        
        $tarea->delete();
        
        return response()->json([
            'message' => 'Tarea eliminada exitosamente'
        ], 200);
    }
    
    public function toggleCompletada($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->completada = !$tarea->completada;
        $tarea->save();
        
        $tarea->load(['categoria', 'etiquetas']);
        
        return response()->json([
            'message' => 'Estado actualizado',
            'data' => $tarea
        ], 200);
    }
}