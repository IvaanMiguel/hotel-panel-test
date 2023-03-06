<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [

        'name_es',
        'description_es',

        'name_en',
        'description_en',

        'name_fr',
        'description_fr',

        'cover',
        'price_per_person',
        'max_people',
        'google_maps_url',
        'status'
    ];

    public function hotels(){
        return $this->belongsToMany(Hotel::class);
    }
}
