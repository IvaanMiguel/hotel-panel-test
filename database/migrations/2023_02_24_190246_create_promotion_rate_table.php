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
        Schema::create('promotion_rate', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('promotion_id');  
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');

            $table->unsignedBigInteger('rate_id');  
            $table->foreign('rate_id')->references('id')->on('rates')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_rate');
    }
};
