<?php

namespace Database\Seeders;

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

                $room = $rate->rooms()->find($schedule->room);
               
                $reservation = Reservation::create([
                    'code' => strtoupper(uniqid()),
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
                    'status' => fake()->randomElement(['confirmada', 'pendiente', 'cancelada', 'inconclusa']),
                    'origin' => 'organico'
                ]); 
            }
        }
    
         
        /* 
        $reservation = new Reservation();
        $reservation->code = "RES20200827";
        $reservation->nights_reserved = 3;
        $reservation->amount_of_people = 2;
        $reservation->check_in = "2020-10-24";
        $reservation->check_out = "2020-10-27";
        $reservation->comments = "Lorem Ipsum is simply dummy text of the  printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
        $reservation->payment_confirmation = "20";
        $reservation->amount = 1000;
        $reservation->room_id = 1;
        $reservation->rate_id = 1;
        $reservation->client_id = 1;
        $reservation->billing = true;
        $reservation->save();

        $reservation = new Reservation();
        $reservation->code = "RES20200817";
        $reservation->nights_reserved = 1;
        $reservation->amount_of_people = 2;
        $reservation->check_in = "2020-09-24";
        $reservation->check_out = "2020-10-25";
        $reservation->comments = "Lorem Ipsum is simply dummy text of the  printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
        $reservation->payment_confirmation = "20";
        $reservation->amount = 1000;
        $reservation->room_id = 4;
        $reservation->rate_id = 2;
        $reservation->client_id = 3;
        $reservation->billing = true;
        $reservation->save();

        $reservation = new Reservation();
        $reservation->code = "RES20200830";
        $reservation->nights_reserved = 2;
        $reservation->amount_of_people = 2;
        $reservation->check_in = "2020-10-24";
        $reservation->check_out = "2020-10-26";
        $reservation->comments = "Lorem Ipsum is simply dummy text of the  printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
        $reservation->payment_confirmation = "20";
        $reservation->amount = 1000;
        $reservation->room_id = 8;
        $reservation->rate_id = 1;
        $reservation->client_id = 4;
        $reservation->save();

        $reservation = new Reservation();
        $reservation->code = "RES20200828";
        $reservation->nights_reserved = 4;
        $reservation->amount_of_people = 4;
        $reservation->check_in = "2020-10-24";
        $reservation->check_out = "2020-10-28";
        $reservation->comments = "Lorem Ipsum is simply dummy text of the  printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
        $reservation->payment_confirmation = "20";
        $reservation->amount = 1000;
        $reservation->room_id = 2;
        $reservation->rate_id = 2;
        $reservation->client_id = 2;
        $reservation->billing = true;
        $reservation->status = "confirmada";
        $reservation->save();

        $reservation = new Reservation();
        $reservation->code = "RES20200821";
        $reservation->nights_reserved = 4;
        $reservation->amount_of_people = 3;
        $reservation->check_in = "2020-10-24";
        $reservation->check_out = "2020-10-28";
        $reservation->comments = "Lorem Ipsum is simply dummy text of the  printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.";
        $reservation->payment_confirmation = "20";
        $reservation->amount = 1000;
        $reservation->room_id = 9;
        $reservation->rate_id = 1;
        $reservation->client_id = 3;
        $reservation->billing = true;
        $reservation->status = "cancelada";
        $reservation->save();
 */
    }
}
