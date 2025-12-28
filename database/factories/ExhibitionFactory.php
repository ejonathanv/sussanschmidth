<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exhibition>
 */
class ExhibitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'year' => (string) fake()->numberBetween(1990, now()->year),
            'title' => fake()->sentence(4),
            'subtitle' => fake()->optional()->sentence(3),
            'description' => fake()->optional()->paragraph(4),
            'description_two' => fake()->optional()->paragraph(3),
            'place' => fake()->optional()->company() . ' Gallery',
            'location' => fake()->city() . ', ' . fake()->country(),
            'category' => fake()->optional()->randomElement(['Solo', 'Group', 'International', 'Local']),
        ];
    }
}
