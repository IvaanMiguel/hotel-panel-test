<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Coupon;
use App\Models\FacturationData;
use Database\Factories\CommentFactory;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $this->call([HotelSeeder::class,
                    UserSeeder::class,
                    CountrySeeder::class,
                    ClientSeeder::class,
                    ContactSeeder::class,
                    BlogSeeder::class,
                    TagSeeder::class,
                    EventSeeder::class,
                    TypeSeeder::class,
                    RoomSeeder::class,
                    RateSeeder::class,
                    ScheduleSeeder::class,
                    PromotionSeeder::class,
                    QuestionnaireSeeder::class,
                    ReservationSeeder::class,
                    FacturationDataSeeder::class,
                    SettingsSeeder::class,
                    CommentSeeder::class,
                    CouponSeeder::class,
                    QuestionSeeder::class,
                    OptionSeeder::class,
                    AdditionSeeder::class,
                    ActivitySeeder::class,
                    RoleSeeder::class
                ]);
    }
}
