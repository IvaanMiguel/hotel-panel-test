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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('name_es')->nullable();
            $table->string('name_en')->nullable();
            $table->string('name_fr')->nullable();
            $table->longText('description_es')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_fr')->nullable();
            $table->string('url_es')->nullable();
            $table->string('url_en')->nullable();
            $table->string('url_fr')->nullable();
            $table->string('cover')->default('cover.jpg');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('price');

            $table->unsignedBigInteger('hotel_id');  
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');

            $table->string('status')->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
