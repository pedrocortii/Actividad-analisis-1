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
        Schema::table('work_orders', function (Blueprint $table) {
            // Drop the existing 'estado' column if it exists
            if (Schema::hasColumn('work_orders', 'estado')) {
                $table->dropColumn('estado');
            }
            $table->foreignId('status_id')->nullable()->constrained('statuses')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropColumn('status_id');
            // Re-add the 'estado' column if needed for rollback, or handle it differently
            // For now, we'll assume it's not needed for a clean rollback or handled elsewhere
            // $table->string('estado')->nullable();
        });
    }
};