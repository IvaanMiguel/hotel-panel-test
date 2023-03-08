<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('cards:remove')
        ->appendOutputTo(storage_path('logs/cards_remove.log'))->dailyAt('05:00')->withoutOverlapping();


        $schedule->command('questionnaires:email')
        ->appendOutputTo(storage_path('logs/questionnaires_email.log'))->dailyAt('06:00')->withoutOverlapping();


        $schedule->command('contact:archive')
        ->appendOutputTo(storage_path('logs/update_contact.log'))->dailyAt('03:00')->withoutOverlapping();

        $schedule->command('inactive:events')
        ->appendOutputTo(storage_path('logs/inactive_events.log'))->dailyAt('05:00')->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
