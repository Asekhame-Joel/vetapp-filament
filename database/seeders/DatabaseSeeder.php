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
        // Seed vets and corresponding users
        $vets = Vet::factory(3)->create();
        foreach ($vets as $vet) {
            User::create([
                'name' => $vet->name,
                'email' => $vet->email,
                'password' => bcrypt('password'), // Corrected the Hash call
                'role' => 'vet',
                
            ]);
            
        }

        

        // Seed additional users
        User::factory(5)->create();
        // Seed owners
        $owners = owners::factory(5)->create();
        // Seed pets for each owner and assign random vets
        $owners->each(function ($owner) use ($vets) {
            pets::factory(5)->create([
                'owner_id' => $owner->id,
                'vet_id' => $vets->random()->id,
            ]);
        });

        // Seed appointments and invoices
        // pets::all()->each(function ($pet) {
            // $appointment = appointments::factory(5)->create([
            //     'pet_id' => $pet->id, // Assign the pet to the appointment
            //     'appointment_date' => now()->addDays(rand(1, 30)),
            // ]);

           
        // });

        // Seed medical records for each pet
        // pets::all()->each(function ($pet) {
        //     medical_records::factory(5)->create([
        //         'pet_id' => $pet->id, // Assign medical records to the pet
        //         'condition' => 'Healthy',
        //         'treatment' => 'Routine check-up',
        //         'recorded_at' => now(),
        //     ]);
        // });
        Pets::all()->each(function ($pet) {
            // Ensure each pet has an associated vet and appointment
            $vet = $pet->vet; // Retrieve associated vet
            $appointment = appointments::factory()->create([
                'pet_id' => $pet->id, // Associate appointment with this pet
                'vet_id' => $vet ? $vet->id : null, // Associate vet if available
                'appointment_date' => now()->addDays(rand(1, 30)),
            ]);
        
            medical_records::factory(2)->create([
                'pet_id' => $pet->id, // Associate medical record with this pet
                'vet_id' => $vet ? $vet->id : null, // Use the vet associated with the pet
                'appointment_id' => $appointment->id, // Associate medical record with this appointment
            ]);
            invoices::factory(5)->create([
                'owner_id' => $pet->owner_id,
                'appointment_id' => $appointment->id,
                'amount' => rand(100, 500),
                'status' => 'unpaid',
            ]);
        });

        
    }
}
