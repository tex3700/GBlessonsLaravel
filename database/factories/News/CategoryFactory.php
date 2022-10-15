<?php

namespace Database\Factories\News;

use App\Models\News\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['title' => "string", 'slug' => "string"])]
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'slug' => fake()->sentence(4),
        ];
    }
}
