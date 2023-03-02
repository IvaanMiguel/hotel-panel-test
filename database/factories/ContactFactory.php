<?php

namespace Database\Factories;

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
        $status = ['pendiente','importante','archivado','atendido'];
        return [
            'message' => $this->faker -> text,
            'response' => '',
            'hotel_id' => rand(1, 3),
            'client_id' => rand(1, 4),
            'status' => $status[rand(0,3)]
        ];
    }
}
