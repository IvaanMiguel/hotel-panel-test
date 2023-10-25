<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = Setting::create([
            "google_recaptcha_public_key" => "6LcZPMwoAAAAAJlOQnGX760nTZxzbiANRdM57KZD",
            "google_recaptcha_private_key" => "6LcZPMwoAAAAAL8TYy7iY5d0EG5iJ4uXvXUw1f5W",
            "google_recaptcha" => true,
            "production_stripe_private_key" => "demo",
            "production_stripe_public_key" => "demo",
            "test_stripe_private_key" => "sk_test_51Gy3elHwK1JeYAVej9CEULpKUMjyUxOnVlmyWBR448axlWhxZNamRsl6hFMblWP8jXwepc8ZARIz7BBeSoq4dvrI00ARsPzXaj",
            "test_stripe_public_key" =>"pk_test_51Gy3elHwK1JeYAVen3EHRew1E0L5RvwDg5vzMH26I41PCrUQ3FCFRCXOzFkC2OsTdvgg8euqbBlG5DRkkJqO1lFz00YhrwRbOS",
            "production" => false,
            "email" => "sevenCrown@mail.com",
            "usd_value" => "16.84",
            "eur_value" => "19.65"
        ]);
    }
}
