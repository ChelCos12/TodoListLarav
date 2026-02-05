@extends('layouts.app')

@section('title', 'Categorías')

@section('content')
<div class="pagina">
    <h2 class="pagina__titulo">Gestión de Categorías</h2>

    <div class="formulario">
        <h3 class="formulario__titulo">Nueva Categoría</h3>
        
        <form action="{{ route('categorias.store') }}" method="POST">
            @csrf
            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
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
        
            <input 
                type="color" 
                name="color" 
                style="width: 60px; height: 48px; border: 2px solid #ddd; border-radius: 8px; cursor: pointer;"
                value="{{ old('color', '#ff8000') }}"
            >
            </div>
            @error('color')
                <div style="color: red; margin-bottom: 10px;">{{ $message }}</div>
            @enderror
            
            <button type="submit" class="formulario__boton">Agregar Categoría</button>
        </form>
    </div>

    <!-- Lista de categorías -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
        @if($categorias->count() > 0)
            @foreach($categorias as $categoria)
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
            @endforeach
        @else
            <div class="mensaje-vacio">No hay categorías. ¡Crea tu primera categoría!</div>
        @endif
    </div>
</div>
@endsection