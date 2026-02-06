@extends('layouts.app')

@section('title', 'Tareas')

@section('content')
<div class="pagina">
    
    <div class="formulario">
        <h3 class="formulario__titulo">Nueva Tarea</h3>
        
        <form action="{{ route('tareas.store') }}" method="POST">
            @csrf
            
            <input 
                type="text" 
                name="titulo" 
                class="formulario__input" 
                placeholder="Título de la tarea"
                value="{{ old('titulo') }}"
                required
            >
            @error('titulo')
                <div style="color: red; margin-bottom: 10px;">{{ $message }}</div>
            @enderror
            
            <textarea 
                name="descripcion" 
                class="formulario__textarea" 
                placeholder="Descripción de la tarea"
            >{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <div style="color: red; margin-bottom: 10px;">{{ $message }}</div>
            @enderror
            
            <label class="formulario__label">Categoría</label>
            <select name="categoria_id" class="formulario__select" required>
                <option value="">Selecciona una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            @error('categoria_id')
                <div style="color: red; margin-bottom: 10px;">{{ $message }}</div>
            @enderror
            
            <label class="formulario__label">Etiquetas</label>
            <div class="etiquetas-checkbox">
                @if($etiquetas->count() > 0)
                    @foreach($etiquetas as $etiqueta)
                        <div class="etiqueta-checkbox-item" style="background-color: {{ $etiqueta->color }};">
                            <input 
                                type="checkbox" 
                                name="etiquetas[]" 
                                value="{{ $etiqueta->id }}"
                                id="etiqueta-{{ $etiqueta->id }}"
                                {{ in_array($etiqueta->id, old('etiquetas', [])) ? 'checked' : '' }}
                            >
                            <label for="etiqueta-{{ $etiqueta->id }}">{{ $etiqueta->nombre }}</label>
                        </div>
                    @endforeach
                @else
                    <p style="color: #7f8c8d;">No hay etiquetas. <a href="{{ route('etiquetas.index') }}" style="color: #3498db;">Crea una aquí</a></p>
                @endif
            </div>
            
            <button type="submit" class="formulario__boton">Agregar Tarea</button>
        </form>
    </div>

    <div style="display: flex; flex-direction: column; gap: 20px;">
        @if($tareas->count() > 0)
            @foreach($tareas as $tarea)
                <div style="background: white; padding: 20px; border-radius: 10px; border-left: 5px solid {{ $tarea->categoria->color }}; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); display: flex; gap: 15px; align-items: flex-start;">
                    
                    <!-- Checkbox -->
                    <form action="{{ route('tareas.toggle', $tarea->id) }}" method="POST">
                        @csrf
                        <input 
                            type="checkbox" 
                            {{ $tarea->completada ? 'checked' : '' }}
                            onchange="this.form.submit()"
                            style="width: 24px; height: 24px; cursor: pointer; margin-top: 5px;"
                        >
                    </form>
                    
                    <!-- Contenido -->
                    <div style="flex: 1;">
                        <div style="font-size: 1.3em; font-weight: bold; color: #2c3e50; margin-bottom: 8px; {{ $tarea->completada ? 'text-decoration: line-through; opacity: 0.5;' : '' }}">
                            {{ $tarea->titulo }}
                        </div>
                        <div style="color: #7f8c8d; margin-bottom: 12px; {{ $tarea->completada ? 'text-decoration: line-through; opacity: 0.5;' : '' }}">
                            {{ $tarea->descripcion }}
                        </div>
                        
                        <!-- Categoría -->
                        <span style="display: inline-block; padding: 6px 16px; border-radius: 20px; color: white; font-size: 0.9em; font-weight: 600; background-color: {{ $tarea->categoria->color }}; margin-bottom: 10px;">
                            {{ $tarea->categoria->nombre }}
                        </span>
                        
                        <!-- Etiquetas -->
                        <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                            @foreach($tarea->etiquetas as $etiqueta)
                                <span style="padding: 5px 12px; border-radius: 15px; color: white; font-size: 0.85em; font-weight: 500; background-color: {{ $etiqueta->color }};">
                                    {{ $etiqueta->nombre }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Botones de acción -->
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        <a href="{{ route('tareas.show', $tarea->id) }}" class="boton boton--ver">Ver</a>
                        <a href="{{ route('tareas.edit', $tarea->id) }}" class="boton boton--editar">Editar</a>
                        
                        <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta tarea?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="boton boton--eliminar" style="width: 100%;">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="mensaje-vacio">No hay tareas. ¡Crea tu primera tarea!</div>
        @endif
    </div>
</div>
@endsection