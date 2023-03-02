<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = new Type(); 
        $type->name = "Habitacion Sencilla";
        $type->save();

        //max_people por hotel
        $type->hotels()->attach(1,['max_people' => 2, 'base_people' => 2]);
        $type->hotels()->attach(2,['max_people' => 2, 'base_people' => 2]);


        $type = new Type(); 
        $type->name = "Habitacion Doble";
        $type->save();

        //max_people por hotel
        $type->hotels()->attach(1,['max_people' => 4, 'base_people' => 2]);
        $type->hotels()->attach(2,['max_people' => 4, 'base_people' => 2]);

        $type = new Type(); 
        $type->name = "Jr Suite";
        $type->save();

        //max_people por hotel
        $type->hotels()->attach(1,['max_people' => 3, 'base_people' => 2]);
        $type->hotels()->attach(2,['max_people' => 3, 'base_people' => 2]);
        //$type->hotels()->attach(3,['max_people' => 3, 'base_people' => 2]);

        $type = new Type(); 
        $type->name = "Master Suite";
        $type->save();

        //max_people por hotel
        $type->hotels()->attach(1,['max_people' => 2, 'base_people' => 4]);
        $type->hotels()->attach(2,['max_people' => 6, 'base_people' => 4]);
        //$type->hotels()->attach(3,['max_people' => 4, 'base_people' => 4]);

        $type = new Type(); 
        $type->name = "Jr Suite Love";
        $type->save();

        //max_people por hotel
        $type->hotels()->attach(2,['max_people' => 2, 'base_people' => 2]);

        $type = new Type(); 
        $type->name = "EXPRESS Doble";
        $type->save();

        //max_people por hotel
        $type->hotels()->attach(3,['max_people' => 2, 'base_people' => 2]);

        $type = new Type(); 
        $type->name = "EXPRESS Sencilla";
        $type->save();

        //max_people por hotel
        $type->hotels()->attach(3,['max_people' => 2, 'base_people' => 2]);

        $type = new Type(); 
        $type->name = "Suite Sencilla";
        $type->save();

        //max_people por hotel
        $type->hotels()->attach(3,['max_people' => 2, 'base_people' => 2]);

        $type = new Type(); 
        $type->name = "Suite Doble";
        $type->save();

        //max_people por hotel
        $type->hotels()->attach(3,['max_people' => 2, 'base_people' => 2]);

    }
}
