<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comment' => fake()->sentence(),
            'news_id' => fake()->biasedNumberBetween(1, 100),
            'user_id' => fake()->biasedNumberBetween(1, 100)
        ];
    }
}
