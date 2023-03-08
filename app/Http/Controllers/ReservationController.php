<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }

    public static function encrypt_cards(){
    
        echo("\n");
        echo "._____________."."\n";
        echo Carbon::now()->format('Y-m-d H:i:s').":"."\n";

        //obtener las reservacions qen donde el checkout haya pasado hace un mes
        $today = date('Y-m-d');
        $date = date("Y-m-d",strtotime($today."- 1 month"));

        $count = 0;
        $reservations = Reservation::where('check_out','<=',$date)
                        ->with('card')
                        ->get();

        if($reservations){

            //encriptar las tarjetas 
            foreach ($reservations as $reservation) {

                if(isset($reservation->card)){

                    $reservation->card->update([
                        'name_card' => '000000000',
                        'number' => '000000000',
                        'cvv' => '000000000',
                        'month' => '000000000',
                        'year' => '000000000',
                        'type' => '000000000',
                        'used' => true
                    ]);

                    $count++;

                }


            }

            echo "total de tarjetas removidas: ".$count." "."\n";

            echo Carbon::now()->format('Y-m-d H:i:s').":"."\n";
            echo "._____________."."\n";
            echo("\n");

        } 
    }
}
