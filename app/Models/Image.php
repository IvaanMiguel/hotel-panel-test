<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public function hotels(){
        return $this->morphedByMany(Hotel::class, 'imageable');
    }

    public function rooms(){
        return $this->morphedByMany(Room::class, 'imageable');
    }
}
