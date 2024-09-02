<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleCategory>
 */
class VehicleCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(['Mini', 'Economy', 'Compact', 'Intermediate', 'Standard', 'Fullsize', 'Premium']),
            'price_per_day' => fake()->unique()->randomNumber(2, true)
        ];
    }
}
