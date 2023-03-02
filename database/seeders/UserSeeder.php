<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         /*USUARIOS REALES*/
         $user = new User();
         $user->name = "Rivera Guadalupe";
         $user->email = "grivera@hotelsevencrown.com";
         $user->password = bcrypt("d2#jyi@rah%sEd");
         $user->role_id = 1;
         $user->status = true;
         $user->save();
 
         $user = new User();
         $user->name = "Ventas centro";
         $user->email = "ventascentro@hotelsevencrown.com";
         $user->password = bcrypt("y#4XW7p4&L*H");
         $user->role_id = 3;
         $user->hotel_id = 2;
         $user->status = true;
         $user->save();
 
         $user = new User();
         $user->name = "Reservaciones centro";
         $user->email = "reservacionescentro@hotelsevencrown.com";
         $user->password = bcrypt("EBvvW*ZyDz3M");
         $user->role_id = 3;
         $user->hotel_id = 2;
         $user->status = true;
         $user->save();
 
         $user = new User();
         $user->name = "Ventas malecon";
         $user->email = "ventasmalecon@hotelsevencrown.com";
         $user->password = bcrypt("@Z@rKiD4FT^m");
         $user->role_id = 3;
         $user->hotel_id = 1;
         $user->status = true;
         $user->save(); 
 
         $user = new User();
         $user->name = "Ventas cabo";
         $user->email = "ventascabo@hotelsevencrown.com";
         $user->password = bcrypt("NxY^H0Q@ebZj");
         $user->role_id = 3;
         $user->hotel_id = 3;
         $user->status = true;
         $user->save(); 
         
         /*USUARIOS REALES*/ 
 
         $user = new User();
         $user->name = "Jonathan Giovanni";
         $user->email = "jsoto@hotelsevencrown.com";
         $user->password = bcrypt("pWD4L&X4te8s%Ny0");
         $user->role_id = 1;
         $user->status = true;
         $user->save(); 
 
         $user = new User();
         $user->name = "Api";
         $user->email = "service@hotelsevencrown.com";
         $user->password = bcrypt("V&RVYxt7hiv^EF*fhpZY");
         $user->role_id = 4;
         $user->status = true;
         $user->save();
 
         $user = new User();
         $user->name = "Reservaciones Malecón";
         $user->email = "reservacionesmalecon@hotelsevencrown.com";
         $user->password = bcrypt("Du#W!z&2vVFOM&H");
         $user->role_id = 3;
         $user->hotel_id = 1;
         $user->status = true;
         $user->save();
 
         $user = new User();
         $user->name = "Recepción Cabo";
         $user->email = "recepcioncabo@hotelsevencrown.com";
         $user->password = bcrypt("xtF18kSu@!#Ggk0");
         $user->role_id = 3;
         $user->hotel_id = 3;
         $user->status = true;
         $user->save();
 
         $user = new User();
         $user->name = "Publicaciones blogs";
         $user->email = "publicaciones@hotelsevencrown.com";
         $user->password = bcrypt("Stf58kSu-!yGgk2");
         $user->role_id = 5; 
         $user->status = true;
         $user->save(); 
 
         $user = new User();
         $user->name = "Rivera Guadalupe";
         $user->email = "director@hotelsevencrown.com";
         $user->password = bcrypt("d2#jyi@rah%sEd");
         $user->role_id = 6;
         $user->status = true;
         $user->save();
 
         $user = new User();
         $user->name = "Capturas Cabo";
         $user->email = "ventas@pjsmarketingmexico.com";
         $user->password = bcrypt("Stf58kSu-!yGgk2");
         $user->role_id = 7;
         $user->hotel_id = 3;
         $user->status = true;
         $user->save();
    }
}
