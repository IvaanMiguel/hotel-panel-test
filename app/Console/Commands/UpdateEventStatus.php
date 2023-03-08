<?php

namespace App\Console\Commands;

use App\Http\Controllers\EventController;
use Illuminate\Console\Command;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inactive:events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pone inactivos los eventos con mas de una semana de antiguedad';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        EventController::update_status('inactivo');
    }
}
