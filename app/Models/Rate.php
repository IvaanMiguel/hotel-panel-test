<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'extra_per_person', 'default_price', 'hotel_id', 'type_id', 'status',
    ];

    public function hotel()
    {
    	return $this->belongsTo(Hotel::class);
    }

    public function type()
    {
    	return $this->belongsTo(Type::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function schedules()
    {
        return $this->belongsToMany(Schedule::class);
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class);
    }

    public function rooms(){
        return $this->belongsToMany(Room::class);
    }
}
