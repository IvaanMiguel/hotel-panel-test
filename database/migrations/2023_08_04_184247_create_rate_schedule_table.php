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
        Schema::create('rate_schedule', function (Blueprint $table) {
            //BORRAR PROBABLEMENTE
            $table->id();
            $table->double('new_price')->nullable()->default(null);
            $table->double('new_extra_per_person');

            $table->foreignId('rate_id')    ->references('id')->on('rates')    ->cascadeOnDelete();
            $table->foreignId('schedule_id')->references('id')->on('schedules')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_schedule');
    }
};
