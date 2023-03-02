<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Hotel;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_es' => "(ES)".$this->faker->name,
            'name_en' => "(EN)".$this->faker->name,
            'name_fr' => "(FR)".$this->faker->name,
            'description_es' => "(ES)".$this->faker->text,
            'description_en' => "(EN)".$this->faker->text,
            'description_fr' => "(FR)".$this->faker->text,
            'url_en' => $this->faker->url."/EN",
            'url_fr' => $this->faker->url."/FR",
            'url_es' => $this->faker->url."/ES",
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'price' => rand(1,300),
            'hotel_id' => Hotel::all()->random()->id,
            'status' => 'activo'
        ];
    }
}
