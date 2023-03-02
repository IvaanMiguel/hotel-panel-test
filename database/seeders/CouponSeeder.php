<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // descuento en porcentaje(aplicable en Standart Rate)
          $coupon = new Coupon();
          $coupon->name = "Cupon de prueba porcentaje";
          $coupon->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
          $coupon->code = "CODEPORCEN";
          $coupon->amount = 20;
          $coupon->price_per_night = null;
          $coupon->is_percentage = true;
          $coupon->exchange = "MXN";
          $coupon->min_nights = 2;
          $coupon->min_amount = 500;
          $coupon->limit_uses = 30;
          $coupon->start_date = "2021/04/01";
          $coupon->end_date = "2021/06/01";
          $coupon->hotel_id = 1;
          $coupon->rate_id = 1;
          $coupon->status = "activo";
          $coupon->save();
  
          $coupon->types()->attach([1,3], [
              'created_at' => now(),
              'updated_at' => now()
          ]);
  
          // descuento en monto(Aplicable en Non-redundable)
          $coupon = new Coupon();
          $coupon->name = "Cupon de prueba monto";
          $coupon->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
          $coupon->code = "CODEMONTO";
          $coupon->amount = 800;
          $coupon->price_per_night = null;
          $coupon->is_percentage = false;
          $coupon->exchange = "MXN";
          $coupon->min_nights = 2;
          $coupon->min_amount = 500;
          $coupon->limit_uses = 30;
          $coupon->start_date = "2021/04/01";
          $coupon->end_date = "2021/06/01";
          $coupon->hotel_id = 2;
          $coupon->rate_id = 2;
          $coupon->status = "activo";
          $coupon->save();
  
          $coupon->types()->attach([2,4], [
              'created_at' => now(),
              'updated_at' => now()
          ]);
  
          // descuento rate
          $coupon = new Coupon();
          $coupon->name = "Cupon de prueba rate";
          $coupon->description = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
          $coupon->code = "CODERATE";
          $coupon->amount = null;
          $coupon->price_per_night = 1000;
          $coupon->is_percentage = null;
          $coupon->exchange = "MXN";
          $coupon->min_nights = null;
          $coupon->min_amount = null;
          $coupon->limit_uses = 30;
          $coupon->start_date = "2021/04/01";
          $coupon->end_date = "2021/06/01";
          $coupon->hotel_id = null;
          $coupon->rate_id = null;
          $coupon->status = "activo";
          $coupon->save();
    }
}
