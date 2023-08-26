<?php

namespace Database\Seeders;

use App\Http\Controllers\Web\RoomController;
use App\Models\Image;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents('database/jsons/rooms.json'), true);

        foreach($data as $value){
            
            $room = Room::create([
                'name' => $value['name'],
                'description' => $value['description'],
                'max_people' => $value['max_people'],
                'hotel_id' => $value['hotel_id'],
                'type_id' => $value['type_id'],
                'slug' => $value['slug'],
                
            ]);

            if(array_key_exists('cover', $value)){
                $image = Image::create([
                    'url' => $value['cover'],
                    'imageable_type' => 'App\Models\Room',
                    'imageable_id' => $room->id,
                    'type' => 'cover'
                ]);

                error_log('cover');
            }


            if(array_key_exists('images', $value)){
              
                foreach($value['images'] as $image){

                    $image =  Image::create([
                        'url' => $image,
                        'imageable_type' => 'App\Models\Room',
                        'imageable_id' => $room->id
                    ]);
                }
            }
        }
    }
}
 