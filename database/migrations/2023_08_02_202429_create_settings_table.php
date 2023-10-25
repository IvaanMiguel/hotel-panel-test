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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('google_recaptcha_public_key');
            $table->string('google_recaptcha_private_key');
            $table->boolean('google_recaptcha')->default(false);
            $table->string('production_stripe_private_key');
            $table->string('production_stripe_public_key');
            $table->string('test_stripe_private_key');
            $table->string('test_stripe_public_key');
            $table->string('email');
            $table->string('usd_value');
            $table->string('eur_value');
            $table->boolean('production');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
