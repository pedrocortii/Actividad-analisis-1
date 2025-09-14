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
        Schema::create('work_groups', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->unsignedBigInteger('vehiculo_id')->nullable();
        $table->timestamps();

        $table->foreign('vehiculo_id')->references('id')->on('vehiculos')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_groups');
    }
};
