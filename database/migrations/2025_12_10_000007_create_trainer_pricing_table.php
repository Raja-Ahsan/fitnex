<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Stores pricing per trainer per session duration.
     * Allows different prices for 30, 45, and 60 minute sessions.
     */
    public function up(): void
    {
        Schema::create('trainer_pricing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->constrained('trainers')->onDelete('cascade');
            $table->enum('session_duration', ['30', '45', '60'])->comment('Duration in minutes');
            $table->decimal('price', 10, 2);
            $table->string('currency', 3)->default('USD');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Unique constraint: one price per trainer per duration
            $table->unique(['trainer_id', 'session_duration']);

            // Indexes
            $table->index(['trainer_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainer_pricing');
    }
};
