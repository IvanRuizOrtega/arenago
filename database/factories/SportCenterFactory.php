<?php

namespace Database\Factories;

use App\Models\SportCenter;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SportCenter>
 */
class SportCenterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'lat' => fake()->latitude(),
            'long' => fake()->longitude(),
            'working_days' => NULL,
            'is_public' => fake()->boolean()
        ];
    }
}
