<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\owners; // Use your existing model name

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ownersFactory extends Factory
{
    /**
     * Define the model's default state.

     *
     * @return array<string, mixed>
     */
     protected $model = owners::class; // Explicitly map the factory to the 'owners' model
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
        ];
    }
}
