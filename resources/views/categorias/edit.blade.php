@extends('layouts.app')

@section('title', 'Editar Categoría')

@section('content')
<div class="pagina">
    <h2 class="pagina__titulo">Editar Categoría</h2>
    
    <div class="formulario">
        <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <label class="formulario__label">Nombre</label>
            <input 
                type="text" 
                name="nombre" 
                class="formulario__input" 
                value="{{ old('nombre', $categoria->nombre) }}"
                required
            >
            @error('nombre')
                <div style="color: red; margin-bottom: 10px;">{{ $message }}</div>
            @enderror
            
            <label class="formulario__label">Color</label>
            <input 
                type="color" 
                name="color" 
                class="formulario__color" 
                value="{{ old('color', $categoria->color) }}"
            >
            @error('color')
                <div style="color: red; margin-bottom: 10px;">{{ $message }}</div>
            @enderror
            
            <button type="submit" class="formulario__boton">Guardar Cambios</button>
        </form>
        
        <div style="margin-top: 15px;">
            <a href="{{ route('categorias.index') }}" class="boton boton--ver">Cancelar</a>
        </div>
    </div>
</div>
@endsection