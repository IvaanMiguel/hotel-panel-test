<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
