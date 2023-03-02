<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rate;
class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rate = new Rate();
        $rate->name = "Standard Rate";
        $rate->description = "Lorem Ipsum is simply dummy text of the  printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
        $rate->extra_per_person = 330;
        $rate->default_price = 1500;
        //$rate->hotel_id = 1;
        //$rate->type_id = 1;
        $rate->save();

        $rate = new Rate();
        $rate->name = "Non-refundable";
        $rate->description = "Lorem Ipsum is simply dummy text of the  printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
        $rate->extra_per_person = 330;
        $rate->default_price = 1300;
        //$rate->hotel_id = 1;
        //$rate->type_id = 2;
        $rate->save();
    }
}
