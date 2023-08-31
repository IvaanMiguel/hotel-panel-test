<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = Contact::$status;
        return [
            'message' => fake()->text,
            'response' => '',
            'hotel_id' => rand(1,2),
            'client_id' => rand(1,2),
            'status' => $status[rand(0,2)]
        ];
    }
}
