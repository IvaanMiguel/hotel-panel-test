<?php

namespace App\Console\Commands;

use App\Models\Card;
use App\Services\CardService;
use Illuminate\Console\Command;

class DisableCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:disable-cards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambia los datos de la tarjeta de las reservaciones no pendientes por datos ficticios';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //obtener las reservacions qen donde el checkout haya pasado hace un mes

        $date = date("Y-m-d",strtotime(now()."- 1 month"));

        // return $date;
        $cards = Card::whereHas('reservation', function($q) use ($date) { 
            $q->where('check_out', '<=', $date);
        })->get();
    
        (new CardService)->disable($cards);
    }
}
