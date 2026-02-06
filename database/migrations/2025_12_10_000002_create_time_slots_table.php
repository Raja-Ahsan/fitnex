<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * This table stores auto-generated individual time slots based on trainer availability.
     * Slots are generated for the next 30-60 days.
     */
    public function up(): void
    {
        Schema::create('time_slots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained('trainers')->onDelete('cascade');
            $table->foreignId('availability_id')->nullable()->constrained('availabilities')->onDelete('set null');
            $table->dateTime('slot_datetime');
            $table->boolean('is_booked')->default(false);
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->timestamps();

            // Indexes for fast queries
            $table->index(['trainer_id', 'slot_datetime']);
            $table->index(['trainer_id', 'is_booked']);
            $table->index('slot_datetime');

            // Unique constraint to prevent duplicate slots
            $table->unique(['trainer_id', 'slot_datetime']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('time_slots');
    }
};
