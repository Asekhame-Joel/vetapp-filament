<?php

namespace Database\Factories;

use App\Models\pets;
use App\Models\Vet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class appointmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pet_id' => pets::factory(), // Create a related pet
            'vet_id' => Vet::factory(), // Create a related pet 
            'appointment_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'notes' => $this->faker->sentence(),
        ];
    }
}
