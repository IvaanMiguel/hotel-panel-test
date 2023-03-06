<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        	///////habitaciones Hotel 1
            $room = new Room();
            $room->name = "Habitacion Sencilla";
            $room->description = "Habitación ejecutiva equipada para el viajero de negocios, con bellas vistas a la ciudad desde su amplio ventanal, para el confort que necesita. Consta de una cama King Size, cómodo escritorio, portamaletas, Kit de cafetera y amplio closet.";
            $room->max_people = 2;
            $room->cover = "hotel_malecon_sencilla_2.jpg";
            $room->slug = "estandar-sencilla";
            $room->hotel_id = 1;
            $room->type_id = 1;
            $room->save();
    
            //imagenes de la habitacion
            $room->images()->create([
                'url' => 'hotel_malecon_sencilla_1.jpg'
            ]);

            $room->images()->create([
                'url' => 'hotel_malecon_sencilla_2.jpg'
            ]);
      

    
            $room = new Room();
            $room->name = "Habitacion Doble";
            $room->description = "Habitación sugerida para el viajero de negocios que aprovecha su estancia para incluir a su familia. Equipada con dos camas, practico escritorio y balcón desde donde logrará apreciar la bella vista a la ciudad.";
            $room->max_people = 4;
            $room->cover = "hotel_malecon_doble_1.jpg";
            $room->slug = "estandar-doble";
            $room->hotel_id = 1;
            $room->type_id = 2;
            $room->save();
    
            //imagenes de la habitacion
            $room->images()->create([
                'url' => 'hotel_malecon_doble_1.jpg'
            ]);

            $room->images()->create([
                'url' => 'hotel_malecon_doble_2.jpg'
            ]); 
            
    
            $room->images()->create([
                'url' => 'hotel_malecon_doble_3.jpg'
            ]); 
    
    
            $room = new Room();
            $room->name = "Jr Suite";
            $room->description = "Amplia y cómoda habitación con hermosa vista desde su balcón y hacia la tranquilidad de nuestra bahía de la Paz, con sus hermosos atardeceres. Cuenta con 2 camas matrimoniales o 1 cama King Size, mini bar, cómoda, amplio escritorio y closet.";
            $room->max_people = 2;
            $room->cover = "hotel_malecon_jr_suite_2.jpg";
            $room->slug = "jr-suite";
            $room->hotel_id = 1;
            $room->type_id = 3;
            $room->save();
    
            //imagenes de la habitacion

            $room->images()->create([
                'url' => 'hotel_malecon_jr_suite_1.jpg'
            ]); 
           
            $room->images()->create([
                'url' => 'hotel_malecon_jr_suite_2.jpg'
            ]); 
    
            $room->images()->create([
                'url' => 'hotel_malecon_jr_suite_3.jpg'
            ]); 
    
            $room->images()->create([
                'url' => 'hotel_malecon_jr_suite_4.jpg'
            ]); 
    
            ///////habitaciones Hotel 2
            $room = new Room();
            $room->name = "Master Suite";
            $room->description = "Habitación ideal para el descanso y relax de las parejas que gustan de la vista dominante y profunda del mar. Cualquier atardecer robará suspiros en este tipo de habitación, la cual cuenta con una amplia terraza, minibar, escritorio y encantadoras amenidades para su completa estadía.";
            $room->max_people = 6;
            $room->cover = "hotel_malecon_master_1.jpg";
            $room->slug = "master-suite";
            $room->hotel_id = 1;
            $room->type_id = 4;
            $room->save();

            $room->images()->create([
                'url' => 'hotel_malecon_master_1.jpg'
            ]); 
    
            $room->images()->create([
                'url' => 'hotel_malecon_1.jpg'
            ]); 
            
            $room->images()->create([
                'url' => 'hotel_malecon_2.jpg'
            ]); 
            
            $room->images()->create([
                'url' => 'hotel_malecon_3.jpg'
            ]); 
            
            $room->images()->create([
                'url' => 'hotel_malecon_4.jpg'
            ]); 
            $room->images()->create([
                'url' => 'hotel_malecon_5.jpg'
            ]); 
            $room->images()->create([
                'url' => 'hotel_malecon_6.jpg'
            ]); 
            $room->images()->create([
                'url' => 'hotel_malecon_7.jpg'
            ]); 
            $room->images()->create([
                'url' => 'hotel_malecon_8.jpg'
            ]);

            $room->images()->create([
                'url' => 'hotel_malecon_8.jpg'
            ]);
            
            $room->images()->create([
                'url' => 'hotel_malecon_9.jpg'
            ]);
            
            $room->images()->create([
                'url' => 'hotel_malecon_10.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_malecon_11.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_malecon_12.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_malecon_13.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_malecon_14.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_malecon_15.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_malecon_16.jpg'
       ]);
       $room->images()->create([
                'url' => 'hotel_malecon_17.jpg'
       ]);
       $room->images()->create([
                'url' => 'hotel_malecon_18.jpg'
       ]);
       $room->images()->create([
                'url' => 'hotel_malecon_19.jpg'
       ]);
       $room->images()->create([
                'url' => 'hotel_malecon_20.jpg'
       ]);
       $room->images()->create([
                'url' => 'hotel_malecon_21.jpg'
       ]);
       $room->images()->create([
                'url' => 'hotel_malecon_22.jpg'
       ]);
       $room->images()->create([
                'url' => 'hotel_malecon_23.jpg'
       ]);
       $room->images()->create([
                'url' => 'hotel_malecon_24.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_25.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_26.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_27.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_28.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_29.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_30.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_31.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_32.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_33.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_34.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_35.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_36.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_37.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_38.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_39.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_40.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_41.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_42.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_43.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_44.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_45.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_46.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_47.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_48.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_49.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_50.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_51.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_52.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_53.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_54.jpg'
       ]);$room->images()->create([
                'url' => 'hotel_malecon_55.jpg'
       ]);
       $room->images()->create([
                'url' => 'hotel_malecon_56.jpg'
       ]);

  
     
    
            //Habitaciones de hotel centro
            $room = new Room();
            $room->name = "Habitacion Sencilla";
            $room->description = "Acogedora y amplia habitación estándar con 1 cama Queen, perfecta para parejas.";
            $room->max_people = 2;
            $room->cover = "hotel_centro_sencilla_3.jpg";
            $room->slug = "estandar-sencilla";
            $room->hotel_id = 2;
            $room->type_id = 1;
            $room->save();
    
            //imagenes de la habitacion

            $room->images()->create([
                'url' => 'hotel_centro_sencilla_1.jpg'
            ]);

            $room->images()->create([
                'url' => 'hotel_centro_sencilla_2.jpg'
            ]);

            
            $room->images()->create([
                'url' => 'hotel_centro_sencilla_3.jpg'
            ]);

            $room->images()->create([
                'url' => 'hotel_centro_sencilla_4.jpg'
            ]);
    
            $room = new Room();
            $room->name = "Habitacion Doble";
            $room->description = "Cómoda habitación estándar, perfecta para hospedar familias. Equipada con 2 camas matrimoniales, baño privado con amenidades, además de contar con escritorio, lámpara, silla para el área de trabajo y un sillón personal.";
            $room->max_people = 4;
            $room->cover = "hotel_centro_doble_1.jpg";
            $room->slug = "estandar-doble";
            $room->hotel_id = 2;
            $room->type_id = 2;
            $room->save();
    
            //imagenes de la habitacion

            
            $room->images()->create([
                'url' => 'hotel_centro_doble_1.jpg'
            ]);

            $room->images()->create([
                'url' => 'hotel_centro_doble_2.jpg'
            ]);
       
            ///////habitaciones Hotel 2
    
            ///////habitaciones Hotel 3
            $room = new Room();
            $room->name = "Jr Suite";
            $room->description = "Exclusiva suite que le hará probar las ventajas de un hospedaje superior, al incluir modernas pero cómodas amenidades. Equipada con una cama king, sala de estar con sofá cama, cocineta equipada, comedor y baño privado con amenidades.";
            $room->max_people = 2;
            $room->cover = "hotel_centro_jr_suite_1.jpg";
            $room->slug = "jr-suite";
            $room->hotel_id = 2;
            $room->type_id = 3;
            $room->save();
    
            //imagenes de la habitacion
        

            $room->images()->create([
                'url' => 'hotel_centro_jr_suite_1.jpg'
            ]);
    
            $room = new Room();
            $room->name = "Master Suite";
            $room->description = "Amplia habitación, ideal para una estancia grupal o familiar. Elija su Master Suite y disfrute de dos habitaciones que incluyen una cama King y 2 camas matrimoniales, para alojar fácilmente a 6 personas. Cuenta con entrada independiente por habitación.";
            $room->max_people = 6;
            $room->cover = "hotel_centro_master_2.jpg";
            $room->slug = "master-suite";
            $room->hotel_id = 2;
            $room->type_id = 4;
            $room->save();
    
            //imagenes de la habitacion
         
            $room->images()->create([
                'url' => 'hotel_centro_master_1.jpg'
            ]);

            $room->images()->create([
                'url' => 'hotel_centro_master_2.jpg'
            ]);
            $room = new Room();
            $room->name = "Jr Suite Love";
            $room->description = "Con la distinción de un amplio espacio romántico, equipada con una cama King Size , sala de estancia y Jacuzzi.";
            $room->max_people = 2;
            $room->cover = "hotel_centro_love_1.jpg";
            $room->slug = "jr-suite-love";
            $room->hotel_id = 2;
            $room->type_id = 5;
            $room->save();
    
            //imagenes de la habitacion

            $room->images()->create([
                'url' => 'hotel_centro_love_1.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_1.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_2.jpg'
            ]);
            
    
            $room->images()->create([
                'url' => 'hotel_centro_3.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_4.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_5.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_6.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_7.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_8.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_9.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_10.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_11.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_12.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_13.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_centro_14.jpg'
            ]);

    
            //Hotel cabo
            $room = new Room();
            $room->name = "EXPRESS Sencilla";
            $room->description = "Acogedora y amplia habitación estándar con 1 cama Queen, perfecta para parejas. Disfruta la mezcla entre diseño moderno y clásico, en un área libre de tabaco.";
            $room->max_people = 2;
            $room->cover = "hotel_cabo_sencilla_1.jpg";
            $room->slug = "express-sencilla";
            $room->hotel_id = 3;
            $room->type_id = 7;
            $room->save();

            $room->images()->create([
                'url' => 'hotel_cabo_sencilla_1.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_cabo_sencilla_2.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_cabo_sencilla_3.jpg'
            ]);
    
       
    
            $room = new Room();
            $room->name = "EXPRESS Doble";
            $room->description = "Relájate en nuestra excelente habitación Estándar con 2 camas individuales, cuenta con lo necesario para tu estancia perfecta. Disfruta la mezcla entre diseño moderno y clásico, en un área libre de tabaco.";
            $room->max_people = 2;
            $room->cover = "hotel_cabo_doble_3.jpg";
            $room->slug = "express-doble";
            $room->hotel_id = 3;
            $room->type_id = 6;
            $room->save();

            $room->images()->create([
                'url' => 'hotel_cabo_doble_1.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_cabo_doble_2.jpg'
            ]);
            $room->images()->create([
                'url' => 'hotel_cabo_doble_3.jpg'
            ]);
     
            $room = new Room();
            $room->name = "Suite Sencilla";
            $room->description = "Cómoda Suite de 45 metros cuadrados, ubicada en área remodelada del Hotel, perfecta para hospedar hasta 4 adultos, con acceso al piso de la suite por elevador.";
            $room->max_people = 4;
            $room->cover = "hotel_cabo_master_1.jpg";
            $room->slug = "suite-sencilla";
            $room->hotel_id = 3;
            $room->type_id = 8;
            $room->save();

            $room->images()->create([
                'url' => 'hotel_cabo_master_1.jpg'
            ]);


            $room = new Room();
            $room->name = "Suite Doble";
            $room->description = "Cómoda Suite de 45 metros cuadrados, ubicada en área remodelada del Hotel, acceso al piso de la suite por elevador.";
            $room->max_people = 2;
            $room->cover = "hotel_cabo_jr_suite_1.jpg";
            $room->slug = "suite-doble";
            $room->hotel_id = 3;
            $room->type_id = 9;
            $room->save();


            $room->images()->create([
                'url' => 'hotel_cabo_jr_suite_1.jpg'
            ]);

            $room->images()->create([
                'url' => 'hotel_cabo_1.jpg'
            ]);

            $room->images()->create([
                'url' => 'hotel_cabo_2.jpg'
            ]);
     
    
    
            $room->images()->create([
                'url' => 'hotel_cabo_3.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_4.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_5.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_6.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_7.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_8.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_9.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_10.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_11.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_12.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_13.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_14.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_15.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_16.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_17.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_18.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_19.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_20.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_21.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_22.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_23.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_24.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_25.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_26.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_27.jpg'
            ]);
$room->images()->create([
                'url' => 'hotel_cabo_28.jpg'
            ]);

            ///////habitaciones Hotel 3
        //
    }
}
