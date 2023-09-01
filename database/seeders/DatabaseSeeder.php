<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TypeSeeder::class, 
            PermissionSeeder::class, 
            UserSeeder::class,
            CountrySeeder::class,
            ClientSeeder::class,
            HotelSeeder::class,
            RoomSeeder::class,
            SettingSeeder::class,
            ContactSeeder::class,
            CardSeeder::class
        ]);

    }
}
