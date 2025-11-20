<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;
use App\Models\Workflow;
use App\Models\WorkflowTransition;

class WorkflowSeeder extends Seeder
{
    /**
     * Ejecuta las semillas de la base de datos.
     *
     * @return void
     */
    public function run()
    {
        // 1. Obtener Estados (ya fueron creados por StatusSeeder)
        $pendingAssignment = Status::where('name', 'Pendiente de Asignacion')->first();
        $assigned = Status::where('name', 'Asignado')->first();
        $accepted = Status::where('name', 'Aceptado')->first();
        $completed = Status::where('name', 'Completado')->first();
        $rejected = Status::where('name', 'Rechazado')->first();

        // 2. Crear Flujo de Trabajo
        $workOrderWorkflow = Workflow::create([
            'name' => 'Flujo de Trabajo de Orden de Servicio',
            'description' => 'Flujo de trabajo estándar para órdenes de servicio.'
        ]);

        // 3. Definir Transiciones del Flujo de Trabajo para el Proceso de Orden de Servicio
        // Pendiente de Asignacion -> Asignado
        WorkflowTransition::create([
            'workflow_id' => $workOrderWorkflow->id,
            'from_status_id' => $pendingAssignment->id,
            'to_status_id' => $assigned->id,
        ]);

        // Asignado -> Aceptado
        WorkflowTransition::create([
            'workflow_id' => $workOrderWorkflow->id,
            'from_status_id' => $assigned->id,
            'to_status_id' => $accepted->id,
        ]);

        // Asignado -> Rechazado
        WorkflowTransition::create([
            'workflow_id' => $workOrderWorkflow->id,
            'from_status_id' => $assigned->id,
            'to_status_id' => $rejected->id,
        ]);

        // Aceptado -> Completado
        WorkflowTransition::create([
            'workflow_id' => $workOrderWorkflow->id,
            'from_status_id' => $accepted->id,
            'to_status_id' => $completed->id,
        ]);

        // Aceptado -> Rechazado
        WorkflowTransition::create([
            'workflow_id' => $workOrderWorkflow->id,
            'from_status_id' => $accepted->id,
            'to_status_id' => $rejected->id,
        ]);
    }
}
