<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'google_recaptcha_public_key', 
        'google_recaptcha_private_key', 

        'production_stripe_private_key',
        'production_stripe_public_key',

        'test_stripe_private_key',
        'test_stripe_public_key',

        'email', 
        'usd_value',
        'eur_value',
        'production',
    ];
}
