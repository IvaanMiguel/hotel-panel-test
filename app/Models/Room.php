<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description' , 'max_people', 'cover', 'slug', 'extra_payment_per_person', 'hotel_id', 'type_id', 'status',
    ];

    public function hotel()
    {
    	return $this->belongsTo(Hotel::class);
    }

    public function type()
    {
    	return $this->belongsTo(Type::class);
    }

    public function images()
    {
        return $this->hasMany(RoomImage::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function scopeWithAndWhereHas($query, $relation, $constraint){
        return $query->whereHas($relation, $constraint)
                     ->with([$relation => $constraint]);
    }
}
