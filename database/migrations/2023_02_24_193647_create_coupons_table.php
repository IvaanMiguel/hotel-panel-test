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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('code')->unique()->nullable();
            $table->string('image_path')->default('coupon.jpg');
            $table->double('amount')->nullable();
            $table->double('price_per_night')->nullable();
            $table->boolean('is_percentage')->nullable();
            $table->string('exchange');
            $table->integer('min_nights')->nullable();
            $table->double('min_amount')->nullable();
            $table->integer('uses_count')->default(0);
            $table->integer('limit_uses')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            //tarifa a la que aplica
            $table->unsignedBigInteger('hotel_id')->nullable();  
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');

            //tarifa a la que aplica
            $table->unsignedBigInteger('rate_id')->nullable();  
            $table->foreign('rate_id')->references('id')->on('rates')->onDelete('cascade');

            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
