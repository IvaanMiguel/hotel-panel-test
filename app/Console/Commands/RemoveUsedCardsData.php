<?php

namespace App\Console\Commands;

use App\Http\Controllers\ReservationController;
use Illuminate\Console\Command;

class RemoveUsedCardsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cards:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Elimina la informacion de tarjetas usadas hace 1 mes';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        ReservationController::encrypt_cards();
    }
}
