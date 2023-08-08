<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory, softDeletes;

    public function coupons(){
        return $this->hasMany(Coupon::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
