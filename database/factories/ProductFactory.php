<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->unique()->words(rand(2, 4), true);

        return [
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'category_id' => Category::query()->whereNotNull('parent_id')->inRandomOrder()->value('id'),
            'name' => Str::title($name),
            'slug' => Str::slug($name),
            'description' => fake()->paragraphs(3, true),
            'is_active' => true,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {
            /**
             * После создания создает дополнительно для товара три варианта 
             * товара и 4 фото
             */
            ProductVariant::factory()
                ->count(3)
                ->for($product)
                ->create();

            ProductImage::factory()
                ->count(4)
                ->for($product)
                ->create();
        });
    }
}
