<?php

namespace App\Console\Commands;

use App\Http\Controllers\ContactController;
use Illuminate\Console\Command;

class UpdateContactStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:archive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el estado de los contactos que tengan mas de 40 dias';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        ContactController::update_status('archivado');
    }
}
