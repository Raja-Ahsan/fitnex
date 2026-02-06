<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * This table tracks all reschedule history for bookings.
     * Maintains audit trail of who rescheduled and when.
     */
    public function up(): void
    {
        Schema::create('booking_reschedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->foreignId('old_slot_id')->constrained('time_slots')->onDelete('cascade');
            $table->foreignId('new_slot_id')->constrained('time_slots')->onDelete('cascade');
            $table->foreignId('rescheduled_by')->constrained('users')->onDelete('cascade');
            $table->text('reason')->nullable();
            $table->decimal('price_difference', 10, 2)->nullable()->comment('Positive if customer owes more, negative if refund needed');
            $table->timestamps();

            // Indexes
            $table->index('booking_id');
            $table->index('rescheduled_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_reschedules');
    }
};
