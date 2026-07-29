<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'sku' => fake()->unique()->bothify('SKU-########'),
            'price' => fake()->randomFloat(
                2,
                100,
                5000
            ),
            'stock' => fake()->numberBetween(
                0,
                500
            ),
            'is_active' => true,
        ];
    }
}