<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->text('descripcion');
            $table->string('direccion_de_servicio');
            $table->date('fecha_solicitud');
            $table->date('fecha_programada')->nullable();
            $table->date('fecha_finalizacion')->nullable();
            $table->string('estado');
            $table->string('prioridad');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
};
