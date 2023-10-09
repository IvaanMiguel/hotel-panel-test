<?php

namespace Database\Seeders;

use App\Models\UsoCfdi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsoCfdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = json_decode(file_get_contents('database/jsons/usos_cfdis.json'), true);

        foreach($values as $item){
            $uso_cfdi = UsoCfdi::create([
                'key' => $item['key'],
                'description' => $item['description']
            ]);
        }
    }
}
