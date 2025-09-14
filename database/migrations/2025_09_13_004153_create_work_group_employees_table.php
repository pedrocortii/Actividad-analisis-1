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
    Schema::create('work_group_employees', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('work_group_id');
        $table->unsignedBigInteger('employee_id');
        $table->timestamps();

        $table->foreign('work_group_id')->references('id')->on('work_groups')->onDelete('cascade');
        $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_group_employees');
    }
};
