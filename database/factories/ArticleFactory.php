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
        // $categoryID = $this->faker->boolean() ? null : $this->faker->randomElement(['1', '2', '3', '4', '5', null]);
        $categoryID = $this->faker->randomElement(['1', '2', '3', '4', '5', null]);

        return [
            'title' => $this->faker->sentence(),
            'body' => $this->faker->paragraphs(50, true),
            'category_id' => $categoryID,
            'description' => $this->faker->sentence(20),
            'thumbnail' => $this->faker->imageUrl(600, 400, true)
        ];
    }
}
