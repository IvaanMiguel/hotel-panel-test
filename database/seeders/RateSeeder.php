<?php

namespace Database\Seeders;

use App\Models\Rate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rate::create([
            'name' => 'Standard Rate',
            'description' => 'Lorem Ipsum is simply dummy text of the  printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s',
        ]);

        Rate::create([
            'name' => 'Non-refundable',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting'
        ]);
    }
}
