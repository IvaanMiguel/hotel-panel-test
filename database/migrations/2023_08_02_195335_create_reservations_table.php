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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->integer('nights_reserved')->default(1);
            $table->integer('amount_of_people')->default(1);
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->longText('comments')->nullable();
            $table->string('payment_confirmation')->nullable();
            $table->double('amount')->nullable();
            $table->boolean('billing')->default(false);
            $table->string('lang')->nullable();
            $table->string('origin')->nullable();
            $table->foreignId('client_id')->references('id')->on('clients')->cascadeOnDelete();
            $table->foreignId('room_id')  ->references('id')->on('rooms')  ->cascadeOnDelete();
            $table->foreignId('rate_id')  ->references('id')->on('rates')  ->cascadeOnDelete();
            $table->foreignId('coupon_id')->nullable()->references('id')->on('coupons')->cascadeOnDelete();

            $table->string('status')->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
