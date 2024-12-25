<?php

namespace Database\Factories;

use App\Models\owners;
use App\Models\pets;
use App\Models\Vet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class invoicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'pet_id' => pets::factory(), // Create a related pet
            // 'vet_id' => Vet::factory(), // Create a related pet 
            'owner_id' => owners::factory(),
            'appointment_id' => null,
            'amount' => $this->faker->randomFloat(2, 50, 500),
            'status' => $this->faker->randomElement(['unpaid', 'paid']),
        ];
    }
}
