<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vet>
 */
class VetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
            'name' => $this->faker->name(),
            'specialization' => $this->faker->randomElement(['Surgery', 'Dentistry', 'Dermatology', 'Internal Medicine']),
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
