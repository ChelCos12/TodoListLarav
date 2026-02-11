<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Etiqueta;
use Illuminate\Http\Request;

class EtiquetaApiController extends Controller
{
    public function index()
    {
        $etiquetas = Etiqueta::all();
        
        return response()->json([
            'success' => true,
            'data' => $etiquetas
        ], 200);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/' // Formato hexadecimal
        ]);
        
        $etiqueta = Etiqueta::create([
            'nombre' => $validated['nombre'],
            'color' => $validated['color']
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Etiqueta creada exitosamente',
            'data' => $etiqueta
        ], 201);
    }
    public function show($id)
    {
        $etiqueta = Etiqueta::with('tareas')->find($id);
        
        if (!$etiqueta) {
            return response()->json([
                'success' => false,
                'message' => 'Etiqueta no encontrada'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $etiqueta
        ], 200);
    }
    
    public function update(Request $request, $id)
    {
        $etiqueta = Etiqueta::find($id);
        
        if (!$etiqueta) {
            return response()->json([
                'success' => false,
                'message' => 'Etiqueta no encontrada'
            ], 404);
        }
        
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/'
        ]);
        
        $etiqueta->update([
            'nombre' => $validated['nombre'],
            'color' => $validated['color']
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Etiqueta actualizada exitosamente',
            'data' => $etiqueta
        ], 200);
    }
    

    public function destroy($id)
    {
        $etiqueta = Etiqueta::find($id);
        
        if (!$etiqueta) {
            return response()->json([
                'success' => false,
                'message' => 'Etiqueta no encontrada'
            ], 404);
        }
        
        $etiqueta->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Etiqueta eliminada exitosamente'
        ], 200);
    }
}