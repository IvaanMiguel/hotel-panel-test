<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings;
class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $setting = new Settings();
        $setting->google_recaptcha_public_key = "6Lfi4noaAAAAAJNaei8RfLECHcdzwm6m_4HOGFaF";
        $setting->google_recaptcha_private_key = "6Lfi4noaAAAAAEo7FTjxsWUkJBpQxaAi6b7r05jZ";

        //claves de producción
        $setting->production_stripe_private_key = "demo";
        $setting->production_stripe_public_key = "demo";

        //claves de demo
        $setting->test_stripe_private_key = "sk_test_51Gy3elHwK1JeYAVej9CEULpKUMjyUxOnVlmyWBR448axlWhxZNamRsl6hFMblWP8jXwepc8ZARIz7BBeSoq4dvrI00ARsPzXaj";
        $setting->test_stripe_public_key = "pk_test_51Gy3elHwK1JeYAVen3EHRew1E0L5RvwDg5vzMH26I41PCrUQ3FCFRCXOzFkC2OsTdvgg8euqbBlG5DRkkJqO1lFz00YhrwRbOS";

        //si esta en false toma los valores demo
        $setting->production = false;


        $setting->email = "sevenCrown@gmail.com";

        $setting->save();
    }
}
