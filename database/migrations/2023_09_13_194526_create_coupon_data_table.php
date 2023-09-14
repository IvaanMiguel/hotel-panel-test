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

     
        Schema::create('coupon_data', function (Blueprint $table) {
            $table->id();
            $table->double('amount')->nullable();
            $table->double('price_per_night')->nullable();
            $table->boolean('is_percentage')->nullable();
            $table->integer('min_nights')->nullable();
            $table->string('exchange');
            $table->double('min_amount')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_data');
    }
};
