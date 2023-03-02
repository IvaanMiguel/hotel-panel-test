<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
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
            'url_es' => $this->faker->url."/ES",
            'url_en' => $this->faker->url."/EN",
            'url_fr' => $this->faker->url."/FR"
        ];
    }
}
