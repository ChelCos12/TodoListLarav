<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    public function index()
    {
        $etiquetas = Etiqueta::all();
        return view('etiquetas.index', compact('etiquetas'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/' // Formato hexadecimal
        ]);
        
        Etiqueta::create([
            'nombre' => $request->nombre,
            'color' => $request->color
        ]);
        
        return redirect()->route('etiquetas.index')->with('success', 'Etiqueta creada exitosamente');
    }
    
    public function show($id)
    {
        $etiqueta = Etiqueta::with('tareas')->findOrFail($id);
        return view('etiquetas.show', compact('etiqueta'));
    }
    
    public function edit($id)
    {
        $etiqueta = Etiqueta::findOrFail($id);
        return view('etiquetas.edit', compact('etiqueta'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'nombre' => 'required|max:255',
            'color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/'
        ]);
        
        $etiqueta = Etiqueta::findOrFail($id);
        $etiqueta->update([
            'nombre' => $request->nombre,
            'color' => $request->color
        ]);
        
        return redirect()->route('etiquetas.index')->with('success', 'Etiqueta actualizada exitosamente');
    }
    
    public function destroy($id)
    {
        $etiqueta = Etiqueta::findOrFail($id);
        
        $etiqueta->delete();
        
        return redirect()->route('etiquetas.index')->with('success', 'Etiqueta eliminada exitosamente');
    }
}