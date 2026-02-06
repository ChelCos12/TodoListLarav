<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $guarded = [];

    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'categoria_id');
    }
}