<?php

namespace Database\Factories;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['revision','aceptado','archivado'];

    return [
        'name' => $this->faker->name,
        'email' => $this->faker->unique()->safeEmail,
        'message' => $this->faker->text,
        'hotel_id' => Hotel::all()->random()->id,
        'status' => $status[rand(0,2)]
    ];
    }
}
