<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Archive>
 */
class ArchiveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $year = fake()->numberBetween(1990, now()->year);
        $title = fake()->words(3, true);
        
        return [
            'archiveid' => 'ARCH-' . fake()->unique()->numberBetween(1000, 9999),
            'title' => ucwords($title),
            'description' => fake()->paragraph(3),
            'image' => 'https://placehold.co/1600x900',
            'category' => fake()->randomElement(['Painting', 'Sculpture', 'Drawing', 'Mixed Media', 'Photography']),
            'format' => fake()->randomElement(['Canvas', 'Paper', 'Wood', 'Metal', 'Digital']),
            'status' => fake()->randomElement(['active', 'archived', null]),
            'location' => fake()->city() . ', ' . fake()->country(),
            'year' => (string) $year,
            'height' => fake()->numberBetween(20, 200) . ' cm',
            'width' => fake()->numberBetween(20, 200) . ' cm',
            'slug' => \Illuminate\Support\Str::slug($title . '-' . $year),
            'length' => fake()->optional()->numberBetween(10, 100),
        ];
    }
}
