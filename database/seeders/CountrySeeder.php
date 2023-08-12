<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = json_decode(file_get_contents('database/jsons/countries.json'), true);

        foreach($values as $country){
            $country_model = Country::create([
                'name' => $country['name'],
                'code' => $country['code'],
            ]);
        }
    }
}
