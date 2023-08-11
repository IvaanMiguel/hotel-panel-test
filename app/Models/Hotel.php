<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    public function contacts(){
        $this->hasMany(Contact::class);
    }

    public function rooms(){
        $this->hasMany(Room::class);
    }

    public function users(){
        $this->hasMany(User::class);
    }

    public function reservations(){
        $this->hasManyThrough(Reservation::class, Room::class);
    }
}
