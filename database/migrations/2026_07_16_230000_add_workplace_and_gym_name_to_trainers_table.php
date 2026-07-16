<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trainers', function (Blueprint $table) {
            if (!Schema::hasColumn('trainers', 'workplace')) {
                $table->string('workplace')->nullable()->after('state');
            }
            if (!Schema::hasColumn('trainers', 'gym_name')) {
                $table->string('gym_name')->nullable()->after('workplace');
            }
        });
    }

    public function down(): void
    {
        Schema::table('trainers', function (Blueprint $table) {
            if (Schema::hasColumn('trainers', 'gym_name')) {
                $table->dropColumn('gym_name');
            }
            if (Schema::hasColumn('trainers', 'workplace')) {
                $table->dropColumn('workplace');
            }
        });
    }
};
