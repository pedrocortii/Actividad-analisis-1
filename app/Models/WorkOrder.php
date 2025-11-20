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
        'status_id', // Reemplazamos 'estado' con 'status_id'
        'prioridad',
        'observaciones',
        'user_id',
        'work_group_id',
    ];

    /**
     * Los atributos que deben ser casteados.
     *
     * @var array
     */
    protected $casts = [
        'fecha_solicitud' => 'datetime',
        'fecha_programada' => 'datetime',
        'fecha_finalizacion' => 'datetime',
    ];

    // Nueva relación con el modelo Status
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function puedeCambiarA(string $newStatusName): bool
    {
        // Buscar el modelo de Status de destino
        $toStatus = Status::where('name', $newStatusName)->first();

        if (!$toStatus) {
            return false; // El estado de destino no existe
        }

        // Asumiendo un flujo de trabajo predeterminado para todas las WorkOrders por ahora
        // En una aplicación real, WorkOrder podría tener un workflow_id
        $defaultWorkflow = Workflow::first(); // O buscar por un nombre específico (ej. 'Flujo de Trabajo de Órdenes')

        if (!$defaultWorkflow) {
            return false; // No se encontró el flujo de trabajo predeterminado
        }

        // Verificar si existe una transición del estado actual al nuevo estado dentro del flujo de trabajo
        return WorkflowTransition::where('workflow_id', $defaultWorkflow->id)
            ->where('from_status_id', $this->status_id)
            ->where('to_status_id', $toStatus->id)
            ->exists();
    }

    // Relación con el usuario que creó la orden
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con el grupo de trabajo asignado a la orden
    public function workGroup()
    {
        return $this->belongsTo(WorkGroup::class);
    }
}