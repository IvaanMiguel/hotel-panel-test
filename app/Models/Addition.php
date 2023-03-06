<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addition extends Model
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

        'name_en',
        'short_name_en',
        'description_en',
        'help_en',

        'name_fr',
        'short_name_fr',
        'description_fr',
        'help_fr',

        'price',
        'hotel_id',
        'status'
    ]; 
    
    //hotel 
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'reservation_addition')->withPivot('quantity', 'total');
    }
}
