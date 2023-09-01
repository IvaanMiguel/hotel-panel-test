<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client_ids = Client::pluck('id')->toArray();
        $types = Card::$types;
        Card::create([
            'name_card' => fake()->name,
            'number' => fake()->uuid(),
            'exp_year' => Carbon::now()->addYears(rand(1,3))->year,
            'cvv' => fake()->uuid(),
            'exp_month' => Carbon::now()->addMonth(rand(2,6))->month,
            'type_card' => $types[rand(0, count($types)-1)],
            'client_id' => $client_ids[rand(0, count($client_ids)-1)]
        ]);

          Card::create([
            'name_card' => fake()->name,
            'number' => fake()->uuid(),
            'exp_year' => Carbon::now()->addYears(rand(1,3))->year,
            'cvv' => fake()->uuid(),
            'exp_month' => Carbon::now()->addMonth(rand(2,6))->month,
            'type_card' => $types[rand(0, count($types)-1)],
            'client_id' => $client_ids[rand(0, count($client_ids)-1)]
        ]);

          Card::create([
            'name_card' => fake()->name,
            'number' => fake()->uuid(),
            'exp_year' => Carbon::now()->addYears(rand(1,3))->year,
            'cvv' => fake()->uuid(),
            'exp_month' => Carbon::now()->addMonth(rand(2,6))->month,
            'type_card' => $types[rand(0, count($types)-1)],
            'client_id' => $client_ids[rand(0, count($client_ids)-1)]
        ]);

          Card::create([
            'name_card' => fake()->name,
            'number' => fake()->uuid(),
            'exp_year' => Carbon::now()->addYears(rand(1,3))->year,
            'cvv' => fake()->uuid(),
            'exp_month' => Carbon::now()->addMonth(rand(2,6))->month,
            'type_card' => $types[rand(0, count($types)-1)],
            'client_id' => $client_ids[rand(0, count($client_ids)-1)]
        ]);
    }
}
