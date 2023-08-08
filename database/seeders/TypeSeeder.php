<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $values = json_decode(file_get_contents('database/jsons/types.json'), true);

        foreach($values as $type){
            Type::Create([
                'name' => $type['name']
            ]);
        }
    }
}
