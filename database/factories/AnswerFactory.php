<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // $contact_ids = Contact::select('id')->inRandomOrder()->take;
        return [
            'text' => fake()->text,
            // 'contact_id' => $contact_ids->ran
        ];
    }
}
