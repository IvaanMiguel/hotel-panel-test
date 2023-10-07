<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'nights_reserved',
        'amount_of_people',
        'check_in',
        'check_out',
        'comments',
        'payment_confirmation',
        'amount',
        'billing',
        'lang',

        'client_id',
        'room_id',
        'rate_id',
        'coupon_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function rate(){
        return $this->belongsTo(Rate::class);
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

     public function getHotelAttribute(){
        return $this->room->hotel;
    }
}
