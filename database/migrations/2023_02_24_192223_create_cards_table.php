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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();

            $table->string('name_card')->nullable();
            $table->string('number')->nullable();
            $table->string('cvv')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('type')->nullable();
            $table->boolean('used')->default(false);

            $table->unsignedBigInteger('reservation_id')->nullable();  
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');

            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
