<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);
        
        return [
            'title' => $title,
            'description' => fake()->paragraph(5),
            'location' => fake()->city() . ', ' . fake()->country(),
            'publication' => fake()->company() . ' Magazine',
            'image' => 'https://placehold.co/800x600',
            'slug' => \Illuminate\Support\Str::slug($title),
            'date' => fake()->date('Y-m-d'),
        ];
    }
}
