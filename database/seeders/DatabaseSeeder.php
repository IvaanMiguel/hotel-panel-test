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
            RateSeeder::class,
            RoomSeeder::class,
            UsoCfdiSeeder::class,
            ReservationSeeder::class,
            BillingDataSeeder::class,
            SettingSeeder::class,
            ContactSeeder::class,
            AnswerSeeder::class,
            CardSeeder::class,
            CouponSeeder::class,
            ScheduleSeeder::class,
            FileSeeder::class
        ]);

    }
}
