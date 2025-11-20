<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\WorkOrder;
use App\Models\Status;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     *
     * @return void
     */
    public function up()
    {
        // Obtener el ID del estado 'Pendiente de Asignacion'
        $defaultStatus = Status::where('name', 'Pendiente de Asignacion')->first();

        if ($defaultStatus) {
            // Actualizar todas las WorkOrders existentes que tienen status_id nulo
            WorkOrder::whereNull('status_id')->update(['status_id' => $defaultStatus->id]);
        }
    }

    /**
     * Revierte las migraciones.
     *
     * @return void
     */
    public function down()
    {
        // En el rollback, es posible que no queramos establecerlo de nuevo en NULL,
        // ya que la columna 'estado' ha sido eliminada.
        // Por simplicidad, no revertiremos el status_id en down().
        // Si se necesita un rollback completo, esto podría requerir una intervención manual
        // o volver a agregar la columna 'estado' en el método down() de la migración anterior.
    }
};
