<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'         => fake()->realText(50),
            'content'       => fake()->realTextBetween(500, 1000),
            'user_id'       => fake()->numberBetween(1, 3),
            'author'        => fake()->name(),
            'category_id'   => fake()->numberBetween(1, 10),
            'tags'          => implode(', ', fake()->randomElements(['Electronics', 'Books', 'Films', 'Sports', 'Fashion', 'Music', 'News'], 3)),
            'published_on'  => fake()->dateTimeBetween('2025-01-01', '2026-04-1'),
            'is_published'  => 1,
        ];
    }
}
