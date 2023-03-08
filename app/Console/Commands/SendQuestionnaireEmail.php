<?php

namespace App\Console\Commands;

use App\Http\Controllers\QuestionnaireController;
use Illuminate\Console\Command;

class SendQuestionnaireEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'questionnaires:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia emails de encuesta (por reservacion) quienes no hayan respondido (solo 3 veces)';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        QuestionnaireController::process();
    }
}
