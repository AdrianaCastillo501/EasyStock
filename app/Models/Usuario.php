<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios'; // Nombre de la tabla
    protected $primaryKey = 'id_usuario'; // Si es clave primaria

    public $timestamps = false; // Si no tienes columnas created_at y updated_at

    protected $fillable = [
        'no_identificacion',
        'contrasena'
    ];

    protected $hidden = [
        'contrasena'
    ];
}
