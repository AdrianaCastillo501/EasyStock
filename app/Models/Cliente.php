<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes'; 
    protected $primaryKey = 'id_cliente'; 
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'nombre',
        'tipo_cliente',
        'tipo_documento',
        'numero_documento',
        'correo',
        'celular',
        'direccion',
        'ciudad',
        'estado',
    ];

    const CREATED_AT = 'fecha_creacion';
    const UPDATED_AT = 'fecha_actualizacion';

    protected $casts = [
    'fecha_creacion' => 'datetime',
    'fecha_actualizacion' => 'datetime',
];


}
