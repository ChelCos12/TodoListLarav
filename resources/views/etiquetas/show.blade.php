@extends('layouts.app')

@section('title', 'Ver Etiqueta')

@section('content')
<div class="pagina">
    <h2 style="color: #2c3e50; margin-bottom: 20px;">{{ $etiqueta->nombre }}</h2>
    
    <div style="width: 80px; height: 80px; background-color: {{ $etiqueta->color }}; border-radius: 10px; margin: 20px 0;"></div>
    
    <p style="margin: 15px 0;"><strong>Código de color:</strong> {{ $etiqueta->color }}</p>
    
    <p style="margin: 15px 0;"><strong>Tareas con esta etiqueta:</strong> {{ $etiqueta->tareas->count() }}</p>
    
    <div style="margin-top: 30px;">
        <a href="{{ route('etiquetas.index') }}" class="boton boton--ver">Volver a Etiquetas</a>
        <a href="{{ route('etiquetas.edit', $etiqueta->id) }}" class="boton boton--editar">Editar</a>
    </div>
</div>
@endsection