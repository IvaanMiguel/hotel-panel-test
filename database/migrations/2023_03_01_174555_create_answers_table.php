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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reply_id');  
            $table->foreign('reply_id')->references('id')->on('replies');

            $table->unsignedBigInteger('question_id');  
            $table->foreign('question_id')->references('id')->on('questions');

            $table->unsignedBigInteger('option_id');  
            $table->foreign('option_id')->references('id')->on('options');

            $table->boolean('status')->default(true);
            $table->timestamps();
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
