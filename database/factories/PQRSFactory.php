<?php

namespace Database\Factories;

use App\Models\PQRS;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PQRS>
 */
class PQRSFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ranking' => fake()->randomElement([1, 2, 3, 4, 5, NULL]),
            'improvement_idea' => fake()->optional()->paragraph(),
            'type' => fake()->randomElement(['petition', 'complaint', 'claim', 'suggestion', 'improvement_idea', 'ranking']),
            'subject' => fake()->sentence(),
            'message' => fake()->realText(400),
        ];
    }
}
