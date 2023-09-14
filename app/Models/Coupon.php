<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
 
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'code',
        'uses_count',
        'limit_uses',
        'hotel_id',
    ];

    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }

     public function images(){
        return $this->morphOne(Image::class, 'imageable');
    } 

    public function coupon_data(){
        return $this->hasMany(CouponData::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class);
    }
}
