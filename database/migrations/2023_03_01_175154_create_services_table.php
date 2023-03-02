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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name_es')->nullable();
            $table->string('short_name_es')->nullable();
            $table->longText('description_es')->nullable();
            $table->longText('help_es')->nullable();
            $table->string('url_es')->nullable();

            $table->string('name_en')->nullable();
            $table->string('short_name_en')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('help_en')->nullable();
            $table->string('url_en')->nullable();

            $table->string('name_fr')->nullable();
            $table->string('short_name_fr')->nullable();
            $table->longText('description_fr')->nullable();
            $table->longText('help_fr')->nullable();
            $table->string('url_fr')->nullable();

            $table->string('price_per_night')->nullable();

            $table->unsignedBigInteger('hotel_id')->nullable();  
            $table->foreign('hotel_id')->references('id')->on('hotels')->onDelete('cascade');

            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
