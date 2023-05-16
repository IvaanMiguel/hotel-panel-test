<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
        'source',
        'domain',
        'room_id', 
        'rate_id', 
        'client_id',
        'facturacion_data_id', 
        'status'

    ];

    public function room()
    {
    	return $this->belongsTo(Room::class);
    }

    public function rate()
    {
    	return $this->belongsTo(Rate::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function facturacion_data()
    {
        return $this->hasOne(FacturationData::class);
    }

    public function card()
    {
        return $this->hasOne(Card::class);
    }
    public function reservations_rooms()
    {
        return $this->hasMany(ReservationRoom::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function reply()
    {
        return $this->hasOne(Reply::class);
    }

    public function questionnaires()
    {
        return $this->belongsToMany(Questionnaire::class)->withPivot('id','count','last_send');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot('applies_only_the_first_night', 'total_service');
    }

    public function additions()
    {
        return $this->belongsToMany(Addition::class, 'reservation_addition')->withPivot('quantity', 'total');
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                     ->with([$relation => $constraint]);
    }
}
