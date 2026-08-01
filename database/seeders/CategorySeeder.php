<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $electronics = Category::create([
            'name' => 'Электроника',
            'slug' => 'electronics',
        ]);


        $phones = $electronics->children()->create([
            'name' => 'Смартфоны',
            'slug' => 'smartphones',
        ]);


        $phones->children()->createMany([
            [
                'name' => 'iPhone',
                'slug' => 'iphone',
            ],
            [
                'name' => 'Android',
                'slug' => 'android',
            ],
        ]);


        $electronics->children()->create([
            'name' => 'Ноутбуки',
            'slug' => 'laptops',
        ]);
        Category::fixTree();
    }
}