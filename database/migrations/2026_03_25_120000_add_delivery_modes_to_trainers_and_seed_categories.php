<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Session delivery filter for trainer discovery (comma-separated: online,in_person).
     * Null = not specified (shown for both online and in-person filters).
     *
     * Safe for existing data: ADD COLUMN nullable only — no TRUNCATE, no row deletes.
     * Existing trainer rows keep all columns; delivery_modes starts as NULL for each.
     */
    public function up(): void
    {
        if (! Schema::hasColumn('trainers', 'delivery_modes')) {
            Schema::table('trainers', function (Blueprint $table) {
                $table->string('delivery_modes')->nullable();
            });
        }

        $now = now();
        $rows = [
            [
                'created_by' => 1,
                'parent_id' => null,
                'title' => 'Weight loss coach',
                'slug' => 'weight-loss-coach',
                'image' => null,
                'description' => null,
                'status' => '1',
                'deleted_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'created_by' => 1,
                'parent_id' => null,
                'title' => 'Strength coach',
                'slug' => 'strength-coach',
                'image' => null,
                'description' => null,
                'status' => '1',
                'deleted_at' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($rows as $row) {
            $exists = DB::table('categories')->where('slug', $row['slug'])->exists();
            if (!$exists) {
                DB::table('categories')->insert($row);
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('trainers', 'delivery_modes')) {
            Schema::table('trainers', function (Blueprint $table) {
                $table->dropColumn('delivery_modes');
            });
        }

        // Do not delete category rows here — trainers may already reference these slugs.
    }
};
