<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'codigo',
        'descripcion',
        'direccion_de_servicio',
        'fecha_solicitud',
        'fecha_programada',
        'fecha_finalizacion',
        'estado',
        'prioridad',
        'observaciones',
    ];

    public static function estados()
    {
        return ['Pendiente', 'Aceptado', 'Completado', 'Rechazado'];
    }

    public static function transicionesPermitidas()
    {
        return [
            'Pendiente'  => ['Aceptado', 'Rechazado'],
            'Aceptado'   => ['Completado', 'Rechazado'],
            'Completado' => [],
            'Rechazado'  => [],
        ];
    }

    public function puedeCambiarA(string $nuevoEstado): bool
    {
        $map = self::transicionesPermitidas();
        return in_array($nuevoEstado, $map[$this->estado] ?? [], true);
    }
}


