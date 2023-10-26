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
        'room_id',
        'status'
    ];

    public function rates(){
        return $this->belongsToMany(Rate::class)->withPivot(['price']);
    }

    public function room(){
        return $this->belongsTo(Room::class);
    }
}
