<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks_ores', function (Blueprint $table) {
            $table->id();
            $table->integer("units");
            $table->integer("selling_value")->nullable();

            $table->unsignedBigInteger('selling_station_id')->nullable();
            $table->foreign('selling_station_id')->references('id')->on('selling_stations')->onDelete('set null');

            $table->unsignedBigInteger('ore_id');
            $table->foreign('ore_id')->references('id')->on('ores')->onDelete('cascade');

            $table->unsignedBigInteger('task_id');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks_ores');
    }
};
