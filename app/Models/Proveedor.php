<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'PROVEEDORES'; // Nombre exacto de la tabla
    protected $primaryKey = 'id_proveedor'; 
    public $timestamps = false; // si la tabla no tiene created_at/updated_at

    protected $fillable = [
        'nombre_empresa',
        'numero_identificacion',
        'nombre_contacto',
        'telefono_contacto',
        'email_contacto',
        'direccion',    
        'ciudad',
        'tipo_proveedor',
        'condiciones_pago',   
        'fecha_creacion'
    ];

    // 🔹 Método para calcular tiempo de relación dinámicamente
   public function tiempoRelacion()
{
    if (!$this->fecha_creacion) {
        return 'Sin fecha';
    }

    $fechaCreacion = \Carbon\Carbon::parse($this->fecha_creacion);
    $ahora = \Carbon\Carbon::now();

    $diferencia = $fechaCreacion->diff($ahora);

    $años = $diferencia->y;
    $meses = $diferencia->m;
    $dias = $diferencia->d;

    if ($años == 0 && $meses == 0 && $dias == 0) {
        return 'Hoy';
    }

    $resultado = [];
    if ($años > 0) $resultado[] = $años . ' año' . ($años > 1 ? 's' : '');
    if ($meses > 0) $resultado[] = $meses . ' mes' . ($meses > 1 ? 'es' : '');
    if ($dias > 0) $resultado[] = $dias . ' día' . ($dias > 1 ? 's' : '');

    return implode(' ', $resultado);
}


}
