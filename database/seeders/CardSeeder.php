<?php

namespace Database\Seeders;

use App\Models\Card;
use App\Models\Client;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use function Laravel\Prompts\error;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $client_ids = Client::pluck('id')->toArray()
        $types = Card::$types;
        $reservations = Reservation::where('status', 'confirmada')->get();

        error_log(json_encode($reservations));
        foreach($reservations as $reservation){
           error_log( json_encode($reservation));

          Card::create([
            'name_card' => fake()->name,
            'number' => fake()->uuid(),
            'exp_year' => Carbon::now()->addYears(rand(1,3))->year,
            'cvv' => fake()->uuid(),
            'exp_month' => Carbon::now()->addMonth(rand(2,6))->month,
            'type_card' => array_rand($types),
            'client_id' => $reservation->client_id,
            'reservation_id' => $reservation->id
          ]);
        }
    }
}
