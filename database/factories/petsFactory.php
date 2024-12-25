<?php

namespace Database\Factories;

use App\Models\owners;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class petsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'owner_id' => owners::factory(),
            'vet_id' => null,
            'name' => $this->faker->firstName(),
            'type' => $this->faker->randomElement(['Dog', 'Cat', 'Bird', 'Rabbit']),
            'age' => $this->faker->numberBetween(1, 15),
            'photo' => $this->faker->imageUrl(200, 200, 'animals', true, 'Pet Photo'),
        
        ];
    }
}
