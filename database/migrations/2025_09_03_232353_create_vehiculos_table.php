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
        Schema::create('vehiculos', function (Blueprint $table) {
        $table->id();
        $table->string('patente', 10)->unique();
        $table->unsignedBigInteger('marca_vehiculo_id');
        $table->string('modelo', 100);
        $table->year('año');
        $table->string('foto', 255)->nullable();
        $table->date('vtv');
        $table->timestamps();

        $table->foreign('marca_vehiculo_id')->references('id')->on('marca_vehiculos')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos');
    }
};
