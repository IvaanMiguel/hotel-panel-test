<?php

namespace Database\Seeders;

use App\Models\Filable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\File;
class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = File::create([
            'name' => uniqid().fake()->randomElement(['.pdf', '.ico', '.svg', '.doc'])
        ]);

        $num_filables = random_int(1, 10);

        for($i = 0; $i < $num_filables; $i++){
            $rand_model = fake()->randomElement(['App\Models\User', 'App\Models\Hotel', 'App\Models\Room']);
            $model = $rand_model::inRandomOrder()->first();
            // error_log($model::class);
             $m = Filable::create([
                'file_id' => $file->id,
                'filable_type' => $rand_model,
                'filable_id' => $model->id
            ]); 
            // error_log(json_encode($m));
        }



        $file = File::create([
            'name' => uniqid().fake()->randomElement(['.pdf', '.ico', '.svg', '.doc'])
        ]);

        $num_filables = random_int(1, 10);

        for($i = 0; $i < $num_filables; $i++){
            $rand_model = fake()->randomElement(['App\Models\User', 'App\Models\Hotel', 'App\Models\Room']);
            $model = $rand_model::inRandomOrder()->first();
            // error_log($model::class);
             $m = Filable::create([
                'file_id' => $file->id,
                'filable_type' => $rand_model,
                'filable_id' => $model->id
            ]); 
            // error_log(json_encode($m));
        } 


        $file = File::create([
            'name' => uniqid().fake()->randomElement(['.pdf', '.ico', '.svg', '.doc'])
        ]);

        $num_filables = random_int(1, 10);

        for($i = 0; $i < $num_filables; $i++){
            $rand_model = fake()->randomElement(['App\Models\User', 'App\Models\Hotel', 'App\Models\Room']);
            $model = $rand_model::inRandomOrder()->first();
            // error_log($model::class);
             $m = Filable::create([
                'file_id' => $file->id,
                'filable_type' => $rand_model,
                'filable_id' => $model->id
            ]); 
            // error_log(json_encode($m));
        } 
    }
}
