<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Categoria;
use App\Models\Etiqueta;
use Illuminate\Http\Request;

class TareaController extends Controller
{

    public function index()
    {
        $tareas = Tarea::with(['categoria', 'etiquetas'])->get();
        
        $categorias = Categoria::all();
        $etiquetas = Etiqueta::all();
        
        return view('tareas.index', compact('tareas', 'categorias', 'etiquetas'));
    }
    
    public function store(Request $request)
    {
 
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'nullable',
            'categoria_id' => 'required|exists:categorias,id',
            'etiquetas' => 'nullable|array',
            'etiquetas.*' => 'exists:etiquetas,id'
        ]);
        
        $tarea = Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'completada' => false
        ]);
        
        if ($request->has('etiquetas')) {
            $tarea->etiquetas()->attach($request->etiquetas);
        }
        
        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente');
    }
    
    public function show($id)
    {
        $tarea = Tarea::with(['categoria', 'etiquetas'])->findOrFail($id);
        return view('tareas.show', compact('tarea'));
    }
    
    public function edit($id)
    {
        $tarea = Tarea::with(['categoria', 'etiquetas'])->findOrFail($id);
        $categorias = Categoria::all();
        $etiquetas = Etiqueta::all();
        
        return view('tareas.edit', compact('tarea', 'categorias', 'etiquetas'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|max:255',
            'descripcion' => 'nullable',
            'categoria_id' => 'required|exists:categorias,id',
            'etiquetas' => 'nullable|array',
            'etiquetas.*' => 'exists:etiquetas,id'
        ]);

        $tarea = Tarea::findOrFail($id);
        $tarea->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id
        ]);

        if ($request->has('etiquetas')) {
            $tarea->etiquetas()->sync($request->etiquetas);
        } else {
            $tarea->etiquetas()->detach(); 
        }
        
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada exitosamente');
    }
    
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente');
    }
    
    public function toggleCompletada($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->completada = !$tarea->completada;
        $tarea->save();
        
        return redirect()->route('tareas.index')->with('success', 'Estado actualizado');
    }
}