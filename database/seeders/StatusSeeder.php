<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'Pendiente de Asignacion'],
            ['name' => 'Asignado'],
            ['name' => 'Aceptado'],
            ['name' => 'Completado'],
            ['name' => 'Rechazado'],
        ];

        foreach ($statuses as $status) {
            Status::firstOrCreate($status);
        }
    }
}
