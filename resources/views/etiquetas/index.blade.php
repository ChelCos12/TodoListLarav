@extends('layouts.app')

@section('title', 'Etiquetas')

@section('content')
<div class="pagina">
    <h2 class="pagina__titulo">Gestión de Etiquetas</h2>
    
    <div class="formulario">
        <h3 class="formulario__titulo">Nueva Etiqueta</h3>
        
        <form action="{{ route('etiquetas.store') }}" method="POST">
            @csrf
            <div style="display: flex; gap: 10px; margin-bottom: 15px;">
            <input 
                type="text" 
                name="nombre" 
                class="formulario__input" 
                placeholder="Nombre de la etiqueta"
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
                value="{{ old('color', '#2ecc71') }}"
            >
            </div>


            @error('color')
                <div style="color: red; margin-bottom: 10px;">{{ $message }}</div>
            @enderror
            
            <button type="submit" class="formulario__boton">Agregar Etiqueta</button>
        </form>
    </div>


    <div style="display: flex; flex-direction: column; gap: 20px;">
        @if($etiquetas->count() > 0)
            @foreach($etiquetas as $etiqueta)
                <div style="background: white; padding: 20px; border-radius: 10px; border-left: 5px solid {{ $etiqueta->color }}; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                    
                    <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
                        <div style="width: 40px; height: 40px; background-color: {{ $etiqueta->color }}; border-radius: 8px;"></div>
                        <div style="font-size: 1.3em; font-weight: bold; color: {{ $etiqueta->color }};">
                            {{ $etiqueta->nombre }}
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('etiquetas.show', $etiqueta->id) }}" class="boton boton--ver">Ver</a>
                        <a href="{{ route('etiquetas.edit', $etiqueta->id) }}" class="boton boton--editar">Editar</a>
                        
                        <form action="{{ route('etiquetas.destroy', $etiqueta->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta etiqueta?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="boton boton--eliminar">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="mensaje-vacio">No hay etiquetas. ¡Crea tu primera etiqueta!</div>
        @endif
    </div>
</div>
@endsection