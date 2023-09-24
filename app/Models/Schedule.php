<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'stock',
        'reserved',
        'room_id'
    ];

    public function rates(){
        return $this->belongsToMany(Rate::class);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }
}
