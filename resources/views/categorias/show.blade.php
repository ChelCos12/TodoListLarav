@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
<div class="pagina">
    <h2 class="pagina__titulo">Gestión de Categorías</h2>
    
    <div class="formulario">
        <h3 class="formulario__titulo">Nueva Categoría</h3>
        
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf
            
            <input 
                type="text" 
                name="nombre" 
                class="formulario__input" 
                placeholder="Nombre de la categoría"
                value="{{ old('nombre') }}"
                required
            >
            @error('nombre')
                <div style="color: red; margin-bottom: 10px;">{{ $message }}</div>
            @enderror
            
            <label class="formulario__label">Color de la categoría</label>
            <input 
                type="color" 
                name="color" 
                class="formulario__color" 
                value="{{ old('color', '#3498db') }}"
            >
            @error('color')
                <div style="color: red; margin-bottom: 10px;">{{ $message }}</div>
            @enderror
            
            <button type="submit" class="formulario__boton">Agregar Categoría</button>
        </form>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
        <div style="background: white; padding: 20px; border-radius: 10px; border-left: 5px solid {{ $categoria->color }}; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                    
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                        <div style="width: 40px; height: 40px; background-color: {{ $categoria->color }}; border-radius: 8px;"></div>
                        <div style="font-size: 1.3em; font-weight: bold; color: {{ $categoria->color }};">
                            {{ $categoria->nombre }}
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('categorias.show', $categoria->id) }}" class="boton boton--ver">Ver</a>
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="boton boton--editar">Editar</a>
                        
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="boton boton--eliminar">Eliminar</button>
                        </form>
                    </div>
                </div>
    </div>
</div>
@endsection