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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime("calculatedCompletionDate");
            $table->dateTime("actualCompletionDate");
            $table->integer("calculatedCosts");
            $table->integer("actualCosts");
            $table->integer("calculatedProceeds");
            $table->integer("actualProceeds")->nullable();
            $table->integer("minerRation");
            $table->boolean("visible");

            $table->unsignedBigInteger("station_id");
            $table->foreign('station_id')->references('id')->on('stations');

            $table->unsignedBigInteger("method_id");
            $table->foreign('method_id')->references('id')->on('methods');

            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
