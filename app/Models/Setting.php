<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable = [
        "google_recaptcha_public_key",
        "google_recaptcha_private_key",
        "production_stripe_private_key",
        "production_stripe_public_key",
        "test_stripe_private_key",
        "test_stripe_public_key",
        "production",
        "email",
        "usd_value",
        "eur_value"   
    ];

    use HasFactory;

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getCoverAttribute(){
        return $this->morphMany(Image::class, 'imageable')->where('type', 'cover')->first();
    }
}