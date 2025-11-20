<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkOrder;
use App\Models\Status;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pendienteStatus = Status::where('name', 'Pendiente de Asignacion')->first();

        $WorkOrder = new WorkOrder(
            [
                'codigo' => 'WO-001',
                'descripcion' => 'Service',
                'direccion_de_servicio' => 'Calle Falsa 123',
                'fecha_solicitud' => '2023-10-01',
                'fecha_programada' => '2023-10-05',
                'fecha_finalizacion' => null,
                'status_id' => $pendienteStatus ? $pendienteStatus->id : 1,
                'prioridad' => 'Alta',
                'observaciones' => 'Cliente solicita atención urgente',
                'user_id' => 1
            ]
        );
        $WorkOrder->save();
    }
}
