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
}


