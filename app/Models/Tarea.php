<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $table = 'tareas';

    protected $guarded = [];
    
    public $timestamps = false;
    
    
    protected $casts = [
        'completada' => 'boolean'
    ];


    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    

    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class, 'etiqueta_tarea', 'tarea_id', 'etiqueta_id');
    }
}