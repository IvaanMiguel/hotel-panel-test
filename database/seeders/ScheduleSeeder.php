<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $data = json_decode(file_get_contents('database/jsons/schedules.json'), true);

        foreach($data as $value){

            $schedule = Schedule::create([
                'date' => $value['date'],
                'stock' => $value['stock'],
                'reserved' => $value['reserved'],
                'room_id' => $value['room_id'],
            ]);
        }
        
    }
}
