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
        Schema::create('coupon_reservation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_id');  
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->unsignedBigInteger('reservation_id');  
            $table->foreign('reservation_id')->references('id')->on('reservations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_reservation');
    }
};
