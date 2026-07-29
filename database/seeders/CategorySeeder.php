<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [

            'Electronics' => [
                'Smartphones',
                'Laptops',
                'Tablets',
                'Monitors',
            ],

            'Clothing' => [
                'Men',
                'Women',
                'Kids',
            ],

            'Home' => [
                'Furniture',
                'Kitchen',
                'Lighting',
            ],

        ];

        foreach ($categories as $parentName => $children) {
            $parent = Category::create([
                'name' => $parentName,
                'slug' => Str::slug($parentName),
            ]);

            foreach ($children as $child) {
                Category::create([
                    'parent_id' => $parent->id,
                    'name' => $child,
                    'slug' => Str::slug($child),
                ]);
            }
        }
    }
}