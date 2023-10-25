<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'address',
        'phone_number',
        'email',
        'url_address',
    ];

    public function contacts(){
       return $this->hasMany(Contact::class);
       // xd
    }
    public function rooms(){
        return $this->hasMany(Room::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }

    public function reservations(){
        return $this->hasManyThrough(Reservation::class, Room::class);
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getCoverAttribute(){
        return $this->morphMany(Image::class, 'imageable') ->where('type', 'cover')->first();
    }

    public function schedules(){
        return $this->hasManyThrough(Schedule::class, Room::class);
    }
}
