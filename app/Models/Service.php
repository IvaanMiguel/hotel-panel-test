<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;


      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'name_es',
        'short_name_es',
        'description_es',
        'help_es',
        'url_es',

        'name_en',
        'short_name_en',
        'description_en',
        'help_en',
        'url_en',

        'name_fr',
        'short_name_fr',
        'description_fr',
        'help_fr',
        'url_fr',

        'price_per_night',

        'hotel_id',
        'status'
    ]; 
    
    //hotel en el que aplica
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class)->withPivot('applies_only_the_first_night', 'total_service');
    }
}
