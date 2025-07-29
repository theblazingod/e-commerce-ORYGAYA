<?php

namespace Database\Factories;

use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductCategoryFactory extends Factory
{

    protected $model = ProductCategory::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name,
            "slug" => $this->faker->slug,
            "description" => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(640, 480, 'No image', false, null, true),
        ];
    }
}
