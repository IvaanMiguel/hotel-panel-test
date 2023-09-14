<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\CouponData;
use App\Models\Hotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $coupon = Coupon::create([
            'name' => 'NO C',
            'description' => 'Cupon del dia del trapeador ',
            'code' => 'TR-9067025573',
          
            'uses_count' => 0,
            'limit_uses' => 100,
            'hotel_id' => Hotel::pluck('id')->random(1)->get(0),
            
        ]);
 
        $coupon_data = CouponData::create([
            'amount' => 5000,
            'price_per_night' => 500,
            'is_percentage' => false,
            'min_nights' => 4,
            'exchange' => '131313',
            'min_amount' => 200,
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now()->addDays(3),
            'coupon_id' => $coupon->id,
            'status' => 'Activo',
        ]);

        $coupon->types()->attach([2]);
    }



}
