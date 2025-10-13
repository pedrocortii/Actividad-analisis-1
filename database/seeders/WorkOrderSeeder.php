<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkOrder;

class WorkOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $WorkOrder = new WorkOrder(
            [
                'codigo' => 'WO-001',
                'descripcion' => 'Reparación de aire acondicionado',
                'direccion_de_servicio' => 'Calle Falsa 123',
                'fecha_solicitud' => '2023-10-01',
                'fecha_programada' => '2023-10-05',
                'fecha_finalizacion' => null,
                'estado' => 'Pendiente',
                'prioridad' => 'Alta',
                'observaciones' => 'Cliente solicita atención urgente'
            ]
        );
        $WorkOrder->save();
    }
}
