<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponData extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'price_per_night',
        'is_percentage',
        'min_nights',
        'exchange',
        'min_amount',
        'start_date',
        'end_date',
        'coupon_id',
        'status'
    ];

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
}

