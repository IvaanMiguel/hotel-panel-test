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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->longText('message');
            $table->longText('response');
            $table->foreignId('hotel_id')->references('id')->on('hotels')->onDelete('cascade');
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('no action');
            $table->set('status', ['atendido', 'pendiente', 'archivado']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
