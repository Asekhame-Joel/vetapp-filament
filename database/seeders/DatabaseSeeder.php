<?php

namespace Database\Seeders;

use App\Models\appointments;
use App\Models\invoices;
use App\Models\medical_records;
use App\Models\owners;
use App\Models\pets;
use Illuminate\Database\Seeder;
use App\Models\Vet;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(5)->create(); // Seed 5 users
        $owners = owners::factory(10)->create(); // Seed 10 owners
        $vets = Vet::factory(5)->create(); // Seed 5 vets
        
        // Seed pets
        $owners->each(function ($owner) use ($vets) {
            pets::factory(3)->create([
                'owner_id' => $owner->id,
                'vet_id' => $vets->random()->id,
            ]);
        });

        // Seed appointments and invoices
        pets::all()->each(function ($pet) {
            $appointment = appointments::factory()->create([
                'appointment_date' => now()->addDays(rand(1, 30)),
            ]);
            invoices::factory()->create([
                'owner_id' => $pet->owner_id,
                'appointment_id' => $appointment->id,
                'amount' => rand(100, 500),
                'status' => 'unpaid',
            ]);
        });

        // Seed medical records
        pets::all()->each(function ($pet) {
            medical_records::factory(2)->create([
                'condition' => 'Healthy',
                'treatment' => 'Routine check-up',
                'recorded_at' => now(),
            ]);
        });
    }
}

