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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name_es')->nullable();
            $table->longText('description_es')->nullable();

            $table->string('name_en')->nullable();
            $table->longText('description_en')->nullable();

            $table->string('name_fr')->nullable();
            $table->longText('description_fr')->nullable();

            $table->string('cover')->default('cover.jpg');
            $table->float('price_per_person')->nullable();
            $table->integer('max_people')->nullable();
            $table->string('google_maps_url')->nullable();
            $table->string('status')->nullable();

            $table->string('category')->nullable()->default('Actividad');
     

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
