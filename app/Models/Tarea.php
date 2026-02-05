<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    // Nombre de la tabla
    protected $table = 'tareas';
    
    public $timestamps = false;
    
    protected $fillable = [
        'titulo',
        'descripcion',
        'categoria_id',
        'completada'
    ];
    
    protected $casts = [
        'completada' => 'boolean'
    ];
    
    // RELACIONES


    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    

    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class, 'etiqueta_tarea', 'tarea_id', 'etiqueta_id');
    }
}