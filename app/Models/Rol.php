<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles'; // Nombre de la tabla
    protected $primaryKey = 'id_rol'; // Clave primaria si aplica
    public $timestamps = false; // Si no tienes created_at y updated_at

    protected $fillable = [
        'nombre_rol'
    ];
}
