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
        Schema::create('reservation_rooms', function (Blueprint $table) {
            $table->id();
            $table->double('final_amount');
            $table->integer('number_of_people');

            $table->unsignedBigInteger('type_id');  
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');

            $table->unsignedBigInteger('hotel_id');  
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');

            $table->unsignedBigInteger('reservation_id');  
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_rooms');
    }
};
