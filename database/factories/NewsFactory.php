<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => Str::limit(fake()->paragraph(1), $limit = 90, $end = '...'),
            'text' => fake()->text(),
            'image_url' => fake()->imageUrl(640, 480, 'animals', true),
            'category_id' => fake()->biasedNumberBetween(1,3)
        ];
    }
}
