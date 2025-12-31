<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Trainer;
use App\Services\SlotGenerationService;

class GenerateTimeSlots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slots:generate {--trainer_id= : Generate slots for specific trainer} {--days=60 : Number of days to generate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate time slots for trainers based on their availability';

    protected $slotService;

    /**
     * Create a new command instance.
     */
    public function __construct(SlotGenerationService $slotService)
    {
        parent::__construct();
        $this->slotService = $slotService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $trainerId = $this->option('trainer_id');
        $days = $this->option('days');

        $this->info('Generating time slots...');

        if ($trainerId) {
            // Generate for specific trainer
            $trainer = Trainer::find($trainerId);

            if (!$trainer) {
                $this->error("Trainer with ID {$trainerId} not found.");
                return Command::FAILURE;
            }

            $count = $this->slotService->generateSlotsForTrainer($trainerId, $days);
            $this->info("Generated {$count} slots for trainer: {$trainer->name}");
        } else {
            // Generate for all active trainers
            $trainers = Trainer::where('status', 1)->get();
            $totalCount = 0;

            foreach ($trainers as $trainer) {
                $count = $this->slotService->generateSlotsForTrainer($trainer->id, $days);
                $totalCount += $count;
                $this->info("Generated {$count} slots for trainer: {$trainer->name}");
            }

            $this->info("Total slots generated: {$totalCount}");
        }

        return Command::SUCCESS;
    }
}
