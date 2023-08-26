<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'max_people',
        'hotel_id',
        'type_id'
    ];
    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

    public function reservations(){
        return $this->hasMany(Reservation::class);
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function getCoverAttribute(){
        return $this->morphMany(Image::class, 'imageable')->where('type', 'cover')->first();
    }

 
    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }

}
