<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationRoom extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'final_amount', 'number_of_people', 'type_id', 'hotel_id', 'reservation_id',
    ];


    public function type()
    {
    	return $this->belongsTo(Type::class);
    }

    public function hotel()
    {
    	return $this->belongsTo(Hotel::class);
    }

    public function reservation()
    {
    	
        
        return $this->belongsTo(Reservation::class);
    }
}
