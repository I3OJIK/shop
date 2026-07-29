<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductAttributeSeeder extends Seeder
{
    public function run(): void
    {
        //выбор атрибутов только для продуктов
        $productAttributes = Attribute::where('is_variant', false)
        ->with('values')
        ->get();

        Product::query()->each(function (Product $product) use ($productAttributes) {

            foreach ($productAttributes as $attribute) {
                $product->attributes()->create([
                    'attribute_id' => $attribute->id,
                    'attribute_value_id' => $attribute->values->random()->id,
                ]);
            }
        });
    }
}
