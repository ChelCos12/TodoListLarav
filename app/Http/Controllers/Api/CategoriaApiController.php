<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaApiController extends Controller
{

    public function index()
    {
        $categorias = Categoria::all()->paginate(10);
        return response()->json($categorias);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/' 
        ]);
        
        $categoria = Categoria::create([
            'nombre' => $validated['nombre'],
            'color' => $validated['color']
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Categoría creada exitosamente',
            'data' => $categoria
        ], 201);
    }
    

    public function show($id)
    {
        $categoria = Categoria::with('tareas')->find($id);
        
        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $categoria
        ], 200);
    }
    

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($id);
        
        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada'
            ], 404);
        }
        
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/'
        ]);
        
        $categoria->update([
            'nombre' => $validated['nombre'],
            'color' => $validated['color']
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Categoría actualizada exitosamente',
            'data' => $categoria
        ], 200);
    }
    

    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        
        if (!$categoria) {
            return response()->json([
                'success' => false,
                'message' => 'Categoría no encontrada'
            ], 404);
        }
        
        $categoria->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Categoría eliminada exitosamente'
        ], 200);
    }
}