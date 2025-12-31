<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Trainer;
use App\Models\Availability;
use App\Models\TrainerPricing;
use App\Models\Booking;
use App\Models\TimeSlot;
use App\Services\SlotGenerationService;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class BookingModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Seeding Booking Module Demo Data...');

        // Create roles if they don't exist
        $this->createRoles();

        // Create demo users
        $admin = $this->createAdminUser();
        $trainers = $this->createTrainers();
        $customers = $this->createCustomers();

        // Create trainer availability
        $this->createAvailability($trainers);

        // Create trainer pricing
        $this->createPricing($trainers);

        // Generate time slots
        $this->generateSlots($trainers);

        // Create demo bookings
        $this->createBookings($trainers, $customers);

        $this->command->info('Booking Module Demo Data Seeded Successfully!');
    }

    protected function createRoles()
    {
        $roles = ['admin', 'trainer', 'customer'];

        foreach ($roles as $roleName) {
            if (!Role::where('name', $roleName)->exists()) {
                Role::create(['name' => $roleName]);
                $this->command->info("Created role: {$roleName}");
            }
        }
    }

    protected function createAdminUser()
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@fitnex.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'phone' => '1234567890',
            ]
        );

        if (!$admin->hasRole('admin')) {
            $admin->assignRole('admin');
        }

        $this->command->info('Created admin user: admin@fitnex.com / password');
        return $admin;
    }

    protected function createTrainers()
    {
        $trainers = [];
        $trainerData = [
            [
                'name' => 'John Smith',
                'email' => 'john.trainer@fitnex.com',
                'designation' => 'Certified Personal Trainer',
                'description' => 'Specialized in strength training and weight loss with 10+ years of experience.',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.trainer@fitnex.com',
                'designation' => 'Yoga & Pilates Instructor',
                'description' => 'Expert in yoga, pilates, and flexibility training. Certified instructor since 2015.',
            ],
            [
                'name' => 'Mike Davis',
                'email' => 'mike.trainer@fitnex.com',
                'designation' => 'CrossFit Coach',
                'description' => 'High-intensity interval training and CrossFit specialist. Former athlete.',
            ],
        ];

        foreach ($trainerData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'phone' => '555' . rand(1000000, 9999999),
                ]
            );

            if (!$user->hasRole('trainer')) {
                $user->assignRole('trainer');
            }

            $trainer = Trainer::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'designation' => $data['designation'],
                    'description' => $data['description'],
                    'price' => rand(50, 100),
                    'status' => 1,
                    'created_by' => $user->id,
                ]
            );

            $trainers[] = $trainer;
            $this->command->info("Created trainer: {$data['name']} ({$data['email']})");
        }

        return $trainers;
    }

    protected function createCustomers()
    {
        $customers = [];
        $customerData = [
            ['name' => 'Alice Brown', 'email' => 'alice@example.com'],
            ['name' => 'Bob Wilson', 'email' => 'bob@example.com'],
            ['name' => 'Carol Martinez', 'email' => 'carol@example.com'],
        ];

        foreach ($customerData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'phone' => '555' . rand(1000000, 9999999),
                ]
            );

            if (!$user->hasRole('customer')) {
                $user->assignRole('customer');
            }

            $customers[] = $user;
            $this->command->info("Created customer: {$data['name']} ({$data['email']})");
        }

        return $customers;
    }

    protected function createAvailability($trainers)
    {
        foreach ($trainers as $trainer) {
            // Monday to Friday, 9 AM to 5 PM
            for ($day = 1; $day <= 5; $day++) {
                Availability::firstOrCreate(
                    [
                        'trainer_id' => $trainer->id,
                        'day_of_week' => $day,
                    ],
                    [
                        'start_time' => '09:00',
                        'end_time' => '17:00',
                        'session_duration' => 60,
                        'is_active' => true,
                    ]
                );
            }

            $this->command->info("Created availability for trainer: {$trainer->name}");
        }
    }

    protected function createPricing($trainers)
    {
        $durations = [30, 45, 60];
        $basePrices = [30 => 30, 45 => 45, 60 => 60];

        foreach ($trainers as $trainer) {
            foreach ($durations as $duration) {
                TrainerPricing::firstOrCreate(
                    [
                        'trainer_id' => $trainer->id,
                        'session_duration' => $duration,
                    ],
                    [
                        'price' => $basePrices[$duration] + rand(0, 20),
                        'currency' => 'USD',
                        'is_active' => true,
                    ]
                );
            }

            $this->command->info("Created pricing for trainer: {$trainer->name}");
        }
    }

    protected function generateSlots($trainers)
    {
        $slotService = app(SlotGenerationService::class);

        foreach ($trainers as $trainer) {
            $count = $slotService->generateSlotsForTrainer($trainer->id, 30);
            $this->command->info("Generated {$count} slots for trainer: {$trainer->name}");
        }
    }

    protected function createBookings($trainers, $customers)
    {
        // Create a few demo bookings
        foreach ($trainers as $index => $trainer) {
            if (isset($customers[$index])) {
                $customer = $customers[$index];

                // Get an available slot
                $slot = TimeSlot::forTrainer($trainer->id)
                    ->available()
                    ->future()
                    ->first();

                if ($slot) {
                    $booking = Booking::create([
                        'user_id' => $customer->id,
                        'trainer_id' => $trainer->id,
                        'time_slot_id' => $slot->id,
                        'price' => 60.00,
                        'currency' => 'USD',
                        'payment_status' => 'paid',
                        'booking_status' => 'confirmed',
                        'notes' => 'Demo booking for testing',
                    ]);

                    $slot->update([
                        'is_booked' => true,
                        'booking_id' => $booking->id,
                    ]);

                    $this->command->info("Created demo booking: Customer {$customer->name} with Trainer {$trainer->name}");
                }
            }
        }
    }
}
