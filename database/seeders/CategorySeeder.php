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

        $phones = Category::create([
            'name' => 'Смартфоны',
            'slug' => 'smartphones',
        ]);

        $phones->appendToNode($electronics)
            ->save();

        $iphone = Category::create([
            'name' => 'iPhone',
            'slug' => 'iphone',
        ]);

        $android = Category::create([
            'name' => 'Android',
            'slug' => 'android',
        ]);

        $iphone->appendToNode($phones)
            ->save();

        $android->appendToNode($phones)
            ->save();

        $laptops = Category::create([
            'name'=>'Ноутбуки',
            'slug'=>'laptops',
        ]);

        $laptops->appendToNode($electronics)
            ->save();
    }
}