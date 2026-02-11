<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Mostrar la lista de categorías
     * phpdoc
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }
    
    /**
     * Guardar una nueva categoría
     * @param nombre  nombre de la categoria
     * @param color color debe venir en hexadecimal
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|max:255',
            'color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/' // Formato hexadecimal
        ]);
        
        // Crear la categoría
        // Categoria::create([
        //     'nombre' => $request->nombre,
        //     'color' => $request->color
        // ]);
        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->color = $request->color;
        $categoria->save();
        
        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente');
    }
    
    /**
     * Mostrar una categoría específica
     */
    public function show($id)
    {
        $categoria = Categoria::with('tareas')->findOrFail($id);
        return view('categorias.show', compact('categoria'));
    }
    
    /**
     * Mostrar el formulario de edición
     */
    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/'
        ]);
        
        $categoria = Categoria::findOrFail($id);
        $categoria->update([
            'nombre' => $request->nombre,
            'color' => $request->color
        ]);
        
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        
        if ($categoria->tareas()->count() > 0) {
            return redirect()->route('categorias.index')
                ->with('error', 'No se puede eliminar la categoría porque tiene tareas asociadas');
        }
        
        $categoria->delete();
        
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente');
    }
}