<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    public function rooms(){
        return $this->belongsToMany(Room::class);
    }

    public function rates(){
    	return $this->belongsToMany(Rate::class);
    }
}
