<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Activity;
class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activity = new Activity();
        $activity->name_es = "Tour a la Isla Espiritu Santo";
        $activity->description_es = "¿Le gustaría vivir una experiencia inolvidable?";

        $activity->name_en = "Tour to Espiritu Santo Island";
        $activity->description_en = "Would you like to live an unforgettable experience?";

        $activity->name_fr = "Visite de l'île d'Espiritu Santo";
        $activity->description_fr = "Vous souhaitez vivre une expérience inoubliable ?";

        $activity->cover = "cover.jpg";
        $activity->price_per_person = 800;
        $activity->max_people = 10;
        $activity->google_maps_url = "https://goo.gl/maps/RZjnnYceL17ASekH6";
        $activity->status = "activo";

        $activity->save();
        $activity->hotels()->attach([1,2,3]);

        $activity = new Activity();
        $activity->name_es = "Tour a playa Balandra";
        $activity->description_es = "La playa más famosa de La Paz";

        $activity->name_en = "Tour to Balandra Beach";
        $activity->description_en = "The most famous beach in La Paz";

        $activity->name_fr = "Visite de la plage de Balandra";
        $activity->description_fr = "La plage la plus célèbre de La Paz";

        $activity->cover = "cover.jpg";
        $activity->price_per_person = 400;
        $activity->max_people = 15;
        $activity->google_maps_url = "https://goo.gl/maps/2niGH93KTB8qGKyY9";
        $activity->status = "activo";

        $activity->save();
        $activity->hotels()->attach(1);

    }
}
