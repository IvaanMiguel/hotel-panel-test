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
        Schema::create('facturations', function (Blueprint $table) {
            $table->id();
            $table->string('business_name');
            $table->set('document_type', ['PASAPORTE', 'RFC', 'OTRO']);
            $table->string('document_number');
            $table->string('address');
            $table->string('zip_code');
            $table->string('state');
            $table->string('city');
            $table->string('email');
            $table->string('tax_regime');
            $table->string('tax_zip_code');
            $table->foreignId('country_id')->references('id')->on('countries')->onDelete('restrict');
            $table->foreignId('reservation_id')->references('id')->on('reservations')->onDelete('cascade');
            $table->foreignId('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturations');
    }
};
