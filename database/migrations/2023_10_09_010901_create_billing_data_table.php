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
        Schema::create('billing_data', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->string('document_type');
            $table->string('document_number');
            $table->string('address');
            $table->string('zip_code');
            $table->string('state');
            $table->string('city');
            $table->foreignId('reservation_id')->references('id')->on('reservations')->cascadeOnDelete();
            $table->foreignId('country_id')->references('id')->on('countries')->cascadeOnDelete();
            $table->foreignId('uso_cfdi_id')->nullable()->references('id')->on('uso_cfdis')->cascadeOnDelete();
            $table->string('email');
            $table->string('tax_regime');
            $table->string('tax_postal_code');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_data');
    }
};
