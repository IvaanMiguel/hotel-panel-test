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
        Schema::create('hotel_type', function (Blueprint $table) {
            $table->id();

            $table->integer('max_people');
            $table->integer('base_people');
            $table->string('extra_per_person')->nullable();

            $table->unsignedBigInteger('hotel_id');  
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');

            $table->unsignedBigInteger('type_id');  
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_type');
    }
};
