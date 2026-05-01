<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'blog_id' => fake()->numberBetween(1, 20),
            'username' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'website' => fake()->url(),
            'body' => fake()->realTextBetween(100, 300),
        ];
    }
}
