<?php

namespace Database\Seeders;

use App\Models\Rate;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $start = Carbon::now();
        $end = Carbon::now()->addMonths(1);
        $room_ids = Room::pluck('id')->toArray();
        $rates = Rate::get();

        
        for($start ; $start <= $end; $start->addDays(1)){
         
            foreach($room_ids as $room_id){
                $schedule = Schedule::create([
                    'date' => $start,
                    'stock' => random_int(1,10),
                    'reserved' => false,
                    'room_id' => $room_id
                ]);

                foreach($rates as $rate){
                    
                    $schedule->rates()->attach($rate, [
                        'price' => 4000,
                        'updated_at' => now(),
                        'created_at' => now()
                    ]);
                }
            }
        }
    }
}
