@extends('layouts.app')

@section('title', 'Ver Tarea')

@section('content')
<div class="pagina">
    <h2 style="color: #2c3e50; margin-bottom: 20px;">{{ $tarea->titulo }}</h2>
    
    <p style="margin: 15px 0;"><strong>Descripción:</strong><br>{{ $tarea->descripcion }}</p>
    
    <p style="margin: 15px 0;">
        <strong>Categoría:</strong> 
        <span style="background-color: {{ $tarea->categoria->color }}; color: white; padding: 5px 12px; border-radius: 15px;">
            {{ $tarea->categoria->nombre }}
        </span>
    </p>
    
    <p style="margin: 15px 0;">
        <strong>Etiquetas:</strong>
            @foreach($tarea->etiquetas as $etiqueta)
                <span style="background-color: {{ $etiqueta->color }}; color: white; padding: 5px 12px; border-radius: 15px;">
                    {{ $etiqueta->nombre }}
                </span>
            @endforeach
    </p>
    
    <p style="margin: 15px 0;">
        <strong>Estado:</strong> 
        {{ $tarea->completada ? 'Completada' : 'Pendiente' }}
    </p>
    
    <div style="margin-top: 30px;">
        <a href="{{ route('tareas.index') }}" class="boton boton--ver">Volver a Tareas</a>
        <a href="{{ route('tareas.edit', $tarea->id) }}" class="boton boton--editar">Editar</a>
    </div>
</div>
@endsection