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
            $table->longText('description');
            $table->string('code');
            $table->double('amount')->nullable();
            $table->double('price_per_night')->nullable();
            $table->set('type', ['amount', 'percentage']);
            $table->set('exchange', ['MXN', 'USD', 'EUR']);
            $table->integer('min_nights')->nullable();
            $table->integer('min_amount')->nullable();


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
