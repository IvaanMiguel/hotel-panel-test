<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = json_decode(file_get_contents("database/jsons/countries.json"), true);

        foreach ($jsonData as $value) {
        	
        	$country = new Country();
        	$country->name = $value['name'];
        	$country->code = $value['code'];

        	$country->save();
    }
}
}
