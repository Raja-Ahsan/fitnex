<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * ZIP for in-person matching. Nullable so existing trainer rows stay valid.
     */
    public function up(): void
    {
        Schema::table('trainers', function (Blueprint $table) {
            if (! Schema::hasColumn('trainers', 'zip_code')) {
                $table->string('zip_code', 20)->nullable()->after('state');
            }
        });

        Schema::table('trainers', function (Blueprint $table) {
            if (! Schema::hasIndex('trainers', 'trainers_status_index')) {
                $table->index('status');
            }
            if (! Schema::hasIndex('trainers', 'trainers_city_index')) {
                $table->index('city');
            }
            if (! Schema::hasIndex('trainers', 'trainers_state_index')) {
                $table->index('state');
            }
        });
    }

    public function down(): void
    {
        Schema::table('trainers', function (Blueprint $table) {
            if (Schema::hasIndex('trainers', 'trainers_status_index')) {
                $table->dropIndex('trainers_status_index');
            }
            if (Schema::hasIndex('trainers', 'trainers_city_index')) {
                $table->dropIndex('trainers_city_index');
            }
            if (Schema::hasIndex('trainers', 'trainers_state_index')) {
                $table->dropIndex('trainers_state_index');
            }
            if (Schema::hasColumn('trainers', 'zip_code')) {
                $table->dropColumn('zip_code');
            }
        });
    }
};
