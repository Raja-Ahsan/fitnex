<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class MarkExistingMigrations extends Command
{
    protected $signature = 'migrate:mark-existing
                            {--dry-run : Show what would be marked without writing to the database}';

    protected $description = 'Mark pending create-* migrations as ran when their tables already exist (safe for live DBs with existing data)';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $files = glob(database_path('migrations/*.php')) ?: [];
        sort($files);

        $ran = DB::table('migrations')->pluck('migration')->all();
        $batch = ((int) DB::table('migrations')->max('batch')) + 1;
        $marked = 0;

        $this->info($dryRun ? 'Dry run — no changes will be saved.' : "Marking existing migrations into batch {$batch}...");
        $this->newLine();

        foreach ($files as $file) {
            $name = basename($file, '.php');

            if (in_array($name, $ran, true)) {
                continue;
            }

            $tables = $this->tablesForMigration($name);
            if ($tables === []) {
                continue;
            }

            $allExist = true;
            foreach ($tables as $table) {
                if (!Schema::hasTable($table)) {
                    $allExist = false;
                    break;
                }
            }

            if (!$allExist) {
                continue;
            }

            $this->line("  ✓ {$name}  (tables: " . implode(', ', $tables) . ')');

            if (!$dryRun) {
                DB::table('migrations')->insert([
                    'migration' => $name,
                    'batch' => $batch,
                ]);
            }

            $marked++;
        }

        $this->newLine();

        if ($marked === 0) {
            $this->warn('No pending create migrations matched existing tables.');
        } else {
            $this->info(($dryRun ? "Would mark {$marked}" : "Marked {$marked}") . ' migration(s).');
            if (!$dryRun) {
                $this->newLine();
                $this->comment('Next step on live:');
                $this->line('  php artisan migrate');
            }
        }

        return self::SUCCESS;
    }

    /**
     * @return array<int, string>
     */
    protected function tablesForMigration(string $name): array
    {
        // Spatie permission package creates several tables.
        if (str_contains($name, 'create_permission_tables')) {
            return ['permissions', 'roles'];
        }

        // Laravel notifications (either migration name)
        if (str_contains($name, 'create_notifications_table')) {
            return ['notifications'];
        }

        if (preg_match('/create_(.+)_table$/', $name, $matches)) {
            return [Str::snake($matches[1])];
        }

        return [];
    }
}
