@extends('layouts.app')

@section('title', 'Editar Tarea')

@section('content')
<div class="pagina">
    <h2 class="pagina__titulo">Editar Tarea</h2>
    
    <div class="formulario">
        <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <label class="formulario__label">Título</label>
            <input 
                type="text" 
                name="titulo" 
                class="formulario__input" 
                value="{{ old('titulo', $tarea->titulo) }}"
                required
            >
            @error('titulo')
                <div style="color: red; margin-bottom: 10px;">{{ $message }}</div>
            @enderror
            
            <label class="formulario__label">Descripción</label>
            <textarea 
                name="descripcion" 
                class="formulario__textarea"
            >{{ old('descripcion', $tarea->descripcion) }}</textarea>
            
            <label class="formulario__label">Categoría</label>
            <select name="categoria_id" class="formulario__select" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" 
                        {{ old('categoria_id', $tarea->categoria_id) == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            
            <label class="formulario__label">Etiquetas</label>
            <div class="etiquetas-checkbox">
                @foreach($etiquetas as $etiqueta)
                    <div class="etiqueta-checkbox-item" style="background-color: {{ $etiqueta->color }};">
                        <input 
                            type="checkbox" 
                            name="etiquetas[]" 
                            value="{{ $etiqueta->id }}"
                            id="etiqueta-edit-{{ $etiqueta->id }}"
                            {{ in_array($etiqueta->id, old('etiquetas', $tarea->etiquetas->pluck('id')->toArray())) ? 'checked' : '' }}
                        >
                        <label for="etiqueta-edit-{{ $etiqueta->id }}">{{ $etiqueta->nombre }}</label>
                    </div>
                @endforeach
            </div>
            
            <button type="submit" class="formulario__boton">Guardar Cambios</button>
        </form>
        
        <div style="margin-top: 15px;">
            <a href="{{ route('tareas.index') }}" class="boton boton--ver">Cancelar</a>
        </div>
    </div>
</div>
@endsection