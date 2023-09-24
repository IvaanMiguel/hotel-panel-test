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
            HotelSeeder::class,
            TypeSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            CountrySeeder::class,
            ClientSeeder::class,
            RoomSeeder::class,
            SettingSeeder::class,
            ContactSeeder::class,
            CardSeeder::class,
            CouponSeeder::class,
            ScheduleSeeder::class
        ]);

    }
}
