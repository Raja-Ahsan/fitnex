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
        // Send booking reminders daily at 9 AM
        $schedule->command('bookings:send-reminders')
            ->dailyAt('09:00')
            ->withoutOverlapping()
            ->onOneServer();

        // Generate time slots daily at midnight
        $schedule->command('slots:generate')
            ->daily()
            ->withoutOverlapping()
            ->onOneServer();

        // Cleanup expired slots weekly
        $schedule->call(function () {
            \App\Models\TimeSlot::where('slot_datetime', '<', now()->subDays(7))
                ->where('is_booked', false)
                ->delete();
        })->weekly();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
