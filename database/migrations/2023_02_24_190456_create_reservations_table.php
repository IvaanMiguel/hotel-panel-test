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
            $table->string('code')->unique()->nullable();
            $table->integer('nights_reserved')->nullable();
            $table->integer('amount_of_people')->default(1);
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->longText('comments')->nullable();
            $table->string('payment_confirmation')->nullable();
            $table->double('amount')->nullable();
            $table->boolean('billing')->nullable();
            $table->string('lang')->nullable();
            $table->string('source')->nullable();
            $table->string('domain')->nullable();

            $table->unsignedBigInteger('room_id')->nullable();  
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');

            $table->unsignedBigInteger('rate_id')->nullable();  
            $table->foreign('rate_id')->references('id')->on('rates')->onDelete('cascade');

            $table->unsignedBigInteger('client_id')->nullable();  
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

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
