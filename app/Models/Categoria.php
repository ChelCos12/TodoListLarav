<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    // Nombre de la tabla
    protected $table = 'categorias';
    
    // Desactivar timestamps (created_at, updated_at)
    public $timestamps = false;
    
    // Campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'color'
    ];
    
    // ============================================
    // RELACIONES
    // ============================================
    
    /**
     * Una categoría tiene muchas tareas
     */
    public function tareas()
    {
        return $this->hasMany(Tarea::class, 'categoria_id');
    }
}