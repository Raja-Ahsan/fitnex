<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('central_google_accounts')) {
            Schema::create('central_google_accounts', function (Blueprint $table) {
                $table->id();
                $table->string('google_email')->nullable();
                $table->text('access_token')->nullable();
                $table->text('refresh_token')->nullable();
                $table->string('calendar_id')->nullable();
                $table->timestamp('token_expiry')->nullable();
                $table->boolean('is_connected')->default(false);
                $table->foreignId('connected_by')->nullable()->constrained('users')->nullOnDelete();
                $table->timestamps();
            });
        }

        if (!Schema::hasColumn('appointments', 'central_google_event_id')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->string('central_google_event_id')->nullable()->after('google_calendar_event_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('appointments', 'central_google_event_id')) {
            Schema::table('appointments', function (Blueprint $table) {
                $table->dropColumn('central_google_event_id');
            });
        }

        Schema::dropIfExists('central_google_accounts');
    }
};
