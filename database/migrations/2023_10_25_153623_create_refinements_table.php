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
        Schema::create('refinements', function (Blueprint $table) {
            $table->unsignedBigInteger('ore_id');
            $table->unsignedBigInteger('station_id');
            $table->integer('factorTime');
            $table->integer('factorCosts');
            $table->integer('factorYield');

            $table->primary(['ore_id', 'station_id']);

            $table->foreign('ore_id')->references('id')->on('ores');
            $table->foreign('station_id')->references('id')->on('stations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refinements');
    }
};
