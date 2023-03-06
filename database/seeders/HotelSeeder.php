<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\HotelImage;
use App\Models\Image;

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
        $hotel->cover = "malecon.jpg";
        $hotel->email = "malecon@hotelsevencrown.com";
        $hotel->url_address = "https://www.google.com/maps/place/Hotel+Seven+Crown+Malecon/@24.160121,-110.318524,13z/data=!4m8!3m7!1s0x0:0x3735b8b52a3aad42!5m2!4m1!1i2!8m2!3d24.160121!4d-110.318524?hl=es-419";
        $hotel->slug = "la-paz-malecon";
        $hotel->save();

        //imagenes del hotel

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_1.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_2.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_3.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_4.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_5.jpg"
        ]);
 
        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_6.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_7.jpg"
        ]);
 
        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_8.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_9.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_10.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_11.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_12.jpg"
        ]);

    
        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_13.jpg"
        ]);
    
        
        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_14.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_15.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_16.jpg"
        ]);
     
        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_17.jpg"
        ]);
        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_18.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_19.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_20.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_21.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_22.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_23.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_malecon_instalaciones_24.jpg"
        ]);

        $hotel = new Hotel();
        $hotel->name = "Centro Histórico";
        $hotel->address = "Calle Revolución de 1910 esq. Hidalgo Colonia Centro C.P. 23000";
        $hotel->phone_number = "612 122 3747";
        $hotel->cover = "centro.jpg";
        $hotel->email = "centro@hotelsevencrown.com";
        $hotel->url_address = "https://www.google.com/maps/place/Hotel+Seven+Crown+Centro+Hist%C3%B3rico/@24.163868,-110.311284,15z/data=!4m8!3m7!1s0x0:0x2f7a09208904dde3!5m2!4m1!1i2!8m2!3d24.163868!4d-110.311284?hl=es-419";
        $hotel->slug = "la-paz-centro-historico";
        $hotel->save();

        //imagenes del hotel

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_1.jpg"
        ]);
     

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_2.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_3.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_4.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_5.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_6.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_7.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_8.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_9.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_10.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_11.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_12.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_13.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_14.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_15.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_16.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_17.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_18.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_centro_instalaciones_19.jpg"
        ]);

        $hotel = new Hotel();
        $hotel->name = "Cabos San Lucas";
        $hotel->address = "Blvd. Lázaro Cárdenas S/N esq. 16 de Septiembre, C.P. 23410, zona centro.";
        $hotel->phone_number = "624 143 7787";
        $hotel->cover = "loscabos.jpg";
        $hotel->email = "cabo@hotelsevencrown.com";
        $hotel->url_address = "https://www.google.com/maps/place/Seven+Crown+Express+%26+Suites/@22.891821,-109.908665,15z/data=!4m8!3m7!1s0x0:0x2c173a638e12b3c0!5m2!4m1!1i2!8m2!3d22.8918213!4d-109.9086646?hl=es-419";
        $hotel->slug = "cabo-san-lucas-express-suites";
        $hotel->save();

        //imagenes del hotel
        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_1.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_2.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_3.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_4.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_5.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_6.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_7.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_8.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_9.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_10.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_11.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_12.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_13.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_14.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_15.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_16.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_17.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_18.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_19.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_20.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_21.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_22.jpg"
        ]);

        $hotel->images()->create([
            'url' => "hotel_cabo_instalaciones_23.jpg"
        ]);
    }
}
