<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    protected $table = 'etiquetas';

    protected $guarded = [];
    
    public $timestamps = false;
    

    
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'etiqueta_tarea', 'etiqueta_id', 'tarea_id');
    }
}