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
        Schema::create('replies', function (Blueprint $table) {

            $table->id();
            $table->longText('observations')->nullable();

            $table->unsignedBigInteger('questionnaire_id');  
            $table->foreign('questionnaire_id')->references('id')->on('questionnaires');

            $table->unsignedBigInteger('reservation_id');  
            $table->foreign('reservation_id')->references('id')->on('reservations');

            $table->boolean('status')->default(true);
            $table->timestamps();
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('replies');
    }
};
