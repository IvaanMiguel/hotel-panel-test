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
        Schema::create('rate_room', function (Blueprint $table) {
            $table->id();
            $table->double('default_price');
            $table->double('default_extra_per_person');

            $table->foreignId('rate_id')->references('id')->on('rates')->cascadeOnDelete();
            $table->foreignId('room')->references('id')->on('rooms')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_room');
    }
};
