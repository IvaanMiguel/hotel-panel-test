<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'max_people', 'status',
    ];

    public function rooms()
    {
    	return $this->hasMany(Room::class);
    }

    public function rates()
    {
        return $this->hasMany(Rate::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function hotels()
    {
        return $this->belongsToMany(Hotel::class)->withPivot('max_people','base_people','extra_per_person');
    }
}
