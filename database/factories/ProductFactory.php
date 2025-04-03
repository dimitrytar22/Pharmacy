<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(10),
            'price' => rand(10, 3000),
            'instruction' => $this->faker->text(500),
            'count' => rand(0, 1000),
            'category_id' => Category::all()->random(1)->first()->id,
            'image' => 'images/products/default.jpg',
        ];
    }
}
