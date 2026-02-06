<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * 
     * Stores Google OAuth tokens for each trainer.
     * Tokens are encrypted for security.
     */
    public function up(): void
    {
        Schema::create('trainer_google_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trainer_id')->unique()->constrained('trainers')->onDelete('cascade');
            $table->text('access_token'); // Will be encrypted
            $table->text('refresh_token'); // Will be encrypted
            $table->string('calendar_id')->nullable();
            $table->timestamp('token_expiry')->nullable();
            $table->boolean('is_connected')->default(true);
            $table->timestamps();

            // Index
            $table->index('is_connected');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainer_google_accounts');
    }
};
