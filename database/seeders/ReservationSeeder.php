<?php

namespace Database\Seeders;

use App\Models\BillingData;
use App\Models\Client;
use App\Models\Rate;
use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Process\FakeProcessResult;

use function Laravel\Prompts\error;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $rates = Rate::get();
        $client = Client::pluck('id');
        foreach($rates as $rate){
    
            $schedules = $rate->schedules()->take(4)->inRandomOrder()->get();
            
            foreach($schedules as $schedule){

                $status = fake()->randomElement(['confirmada', 'pendiente', 'cancelada', 'inconclusa']);
                $room = $rate->rooms()->find($schedule->room);

                if($schedule->stock == 1){
                    $schedule->update(['stock' => $schedule->stock -1, 'reserved' => true]);
                }
               
                $reservation = Reservation::create([
                    'code' => $status != 'pendiente' ? strtoupper(uniqid()) : null,
                    'nights_reserved' => 1,
                    'amount_of_people' => $schedule->room->max_people,
                    'check_in' => $schedule->date,
                    'check_out' => date('Y-m-d', strtotime($schedule->date . ' + 1 days')),
                    'comments' => fake()->text(30),
                    'payment_confirmation' => 20,
                    'amount' => $room->pivot->default_price,
                    'room_id' => $schedule->room->id,
                    'rate_id' => $rate->id,
                    'client_id' => $client->random(),
                    'billing' => fake()->randomElement([true, false]),
                    'status' => $status,
                    'origin' => 'organico'
                ]);
            }
        }

    }
}
