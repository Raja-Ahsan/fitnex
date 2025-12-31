<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Services\NotificationService;
use Carbon\Carbon;

class SendBookingReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bookings:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails for bookings scheduled in the next 24 hours';

    protected $notificationService;

    /**
     * Create a new command instance.
     */
    public function __construct(NotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Sending booking reminders...');

        // Get bookings scheduled for tomorrow (24 hours from now)
        $tomorrow = Carbon::now()->addDay();
        $startOfTomorrow = $tomorrow->copy()->startOfDay();
        $endOfTomorrow = $tomorrow->copy()->endOfDay();

        $bookings = Booking::whereHas('timeSlot', function ($query) use ($startOfTomorrow, $endOfTomorrow) {
            $query->whereBetween('slot_datetime', [$startOfTomorrow, $endOfTomorrow]);
        })
            ->whereIn('booking_status', ['confirmed', 'pending'])
            ->with(['user', 'trainer', 'timeSlot.availability'])
            ->get();

        $count = 0;

        foreach ($bookings as $booking) {
            try {
                $this->notificationService->sendBookingReminder($booking);
                $count++;
                $this->info("Sent reminder for booking #{$booking->id}");
            } catch (\Exception $e) {
                $this->error("Failed to send reminder for booking #{$booking->id}: " . $e->getMessage());
            }
        }

        $this->info("Sent {$count} reminder(s) successfully.");

        return Command::SUCCESS;
    }
}
