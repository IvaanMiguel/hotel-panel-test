<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {    
        $hotel = new Hotel();
        $hotel->name = "Malecón";
        $hotel->address = "Malecón: Alvaro Obregon esq. Lerdo de Tejada, Colonia Centro C.P 23000";
        $hotel->phone_number = "612 128 7787";
        // $hotel->cover = "malecon.jpg";
        $hotel->email = "malecon@hotelsevencrown.com";
        $hotel->url_address = "https://www.google.com/maps/place/Hotel+Seven+Crown+Malecon/@24.160121,-110.318524,13z/data=!4m8!3m7!1s0x0:0x3735b8b52a3aad42!5m2!4m1!1i2!8m2!3d24.160121!4d-110.318524?hl=es-419";
        $hotel->slug = "la-paz-malecon";
        $hotel->save();


        $image = Image::create([
            'url' => 'hotel_malecon_instalaciones_1.jpg',
            'imageable_type' => 'App\Models\Hotel',
            'imageable_id' => $hotel->id
        ]);

        // cover 
        $image = Image::create([
            'url' => 'hotel_malecon_instalaciones_2.jpg',
            'imageable_type' => 'App\Models\Hotel',
            'imageable_id' => $hotel->id,
            'type' => 'cover'
        ]);
        // $hotel->images()->attach($image);

        
        $hotel = new Hotel();
        $hotel->name = "Centro Histórico";
        $hotel->address = "Calle Revolución de 1910 esq. Hidalgo Colonia Centro C.P. 23000";
        $hotel->phone_number = "612 122 3747";
        // $hotel->cover = "centro.jpg";
        $hotel->email = "centro@hotelsevencrown.com";
        $hotel->url_address = "https://www.google.com/maps/place/Hotel+Seven+Crown+Centro+Hist%C3%B3rico/@24.163868,-110.311284,15z/data=!4m8!3m7!1s0x0:0x2f7a09208904dde3!5m2!4m1!1i2!8m2!3d24.163868!4d-110.311284?hl=es-419";
        $hotel->slug = "la-paz-centro-historico";
        $hotel->save();

        $image = Image::create([
            'url' => 'hotel_centro_instalaciones_1.jpg',
            'imageable_type' => 'App\Models\Hotel',
            'imageable_id' => $hotel->id
        ]);

        // $hotel->images()->attach($image);
    }
}
