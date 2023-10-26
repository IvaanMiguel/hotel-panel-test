<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function schedules(){
        return $this->belongsToMany(Schedule::class)->withPivot(['price']);
    }

    public function rooms(){
        return $this->belongsToMany(Room::class)->withPivot(['default_price', 'default_extra_per_person']);    
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }
}
