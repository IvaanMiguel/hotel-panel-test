<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'subscribed',
        'country_id',
    ];

    use HasFactory, SoftDeletes;

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }
}
