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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('text_es')->nullable();
            $table->string('text_en')->nullable();
            $table->string('text_fr')->nullable();
            $table->boolean('is_required');

            $table->unsignedBigInteger('questionnaire_id');  
            $table->foreign('questionnaire_id')->references('id')->on('questionnaires');

            $table->string('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
