<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = json_decode(file_get_contents("database/jsons/schedules.json"), true);

        $data_schedules = [];

        foreach ($jsonData as $value) {
            
            $data_schedules[] = [
                'id' => $value['id'],
                'date' => $value['date'],
                'stock' => $value['stock'],
                'reserved' => $value['reserved'],
                'type_id' => $value['type_id'],
                'hotel_id' => $value['hotel_id'],
                'status' => $value['status'],
                'created_at' => $value['created_at'],
                'updated_at' => $value['updated_at']
            ];
            
        }

        $chunks = array_chunk($data_schedules, 4000);

        foreach ($chunks as $chunk) {
            Schedule::insert($chunk);
        }
        /////////////////////////////////////////////////////////////////
        $jsonData = json_decode(file_get_contents("database/jsons/rate_schedule.json"), true);

        $data = [];

        foreach ($jsonData as $value) {

            $data[] = [
                'id' => $value['id'],
                'price' => $value['price'],
                'rate_id' => $value['rate_id'],
                'schedule_id' => $value['schedule_id'],
                'created_at' => $value['created_at'],
                'updated_at' => $value['updated_at'],
            ];
            
        }

        $chunks = array_chunk($data, 5000);

        foreach ($chunks as $chunk) {
            DB::table('rate_schedule')->insert($chunk);
        }
        //
    }
}
