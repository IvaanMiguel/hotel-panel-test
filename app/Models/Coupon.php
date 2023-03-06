<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'description',
        'code',
        'image_path',
        'amount',
        'price_per_night',
        'is_percentage',
        'exchange',
        'min_nights',
        'min_amount',
        'uses_count',
        'limit_uses',
        'start_date',
        'end_date',
        'hotel_id',
        'rate_id',
        'status',
    ];

    //tarifa a la que aplica
    public function rate()
    {
    	return $this->belongsTo(Rate::class);
    }

    //hotel en el que aplica
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class);
    }
}
