<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    // Nombre de la tabla
    protected $table = 'etiquetas';
    
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
     * Una etiqueta pertenece a muchas tareas (relación N:M)
     */
    public function tareas()
    {
        return $this->belongsToMany(Tarea::class, 'etiqueta_tarea', 'etiqueta_id', 'tarea_id');
    }
}