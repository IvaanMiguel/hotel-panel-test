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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->integer('max_people');
            $table->string('cover')->nullable();
            $table->double('extra_pay_per_person')->nullable()->default(null);

            $table->foreignId('hotel_id')->references('id')->on('hotels')->cascadeOnDelete();
            $table->foreignId('type_id')->references('id')->on('types')->cascadeOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
