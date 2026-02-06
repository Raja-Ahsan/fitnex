<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Enhanced booking system table with payment and Google Calendar integration.
     * This extends/replaces the existing appointments table with more features.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('trainer_id')->constrained('trainers')->onDelete('cascade');
            $table->foreignId('time_slot_id')->constrained('time_slots')->onDelete('cascade');

            // Pricing
            $table->decimal('price', 10, 2);
            $table->string('currency', 3)->default('USD');

            // Payment tracking
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->string('stripe_payment_intent')->nullable();
            $table->string('stripe_session_id')->nullable();

            // Booking status
            $table->enum('booking_status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');

            // Google Calendar integration
            $table->string('google_event_id')->nullable();

            // Additional info
            $table->text('notes')->nullable();

            // Cancellation tracking
            $table->timestamp('cancelled_at')->nullable();
            $table->foreignId('cancelled_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('cancellation_reason')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index(['user_id', 'booking_status']);
            $table->index(['trainer_id', 'booking_status']);
            $table->index('payment_status');
            $table->index('stripe_session_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
