<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Contact;
use App\Models\Hotel;
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
        $hotel_ids = Hotel::pluck('id');
        $client_ids = Client::pluck('id');
        return [
            'message' => fake()->text,
            'response' => '',
            'hotel_id' => $hotel_ids->random(),
            'client_id' => $client_ids->random(),
            'status' => array_rand($status)
        ];
    }
}
