<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('invoices:send-payment-reminders')->dailyAt('09:00');
        $schedule->command('exchange-rates:fetch')->dailyAt('06:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        if (is_dir(__DIR__.'/Commands')) {
            $this->load(__DIR__.'/Commands');
        }

        require base_path('routes/console.php');
    }
}
