<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class VariantAttributeSeeder extends Seeder
{
    public function run(): void
    {
        //выбор атрибутов только для вариантов
        $productAttributes = Attribute::where('is_variant', true)
        ->with('values')
        ->get();

        ProductVariant::query()->each(function (ProductVariant $variant) use ($productAttributes) {

            foreach ($productAttributes as $attribute) {
                $variant->attributes()->create([
                    'attribute_id' => $attribute->id,
                    'attribute_value_id' => $attribute->values->random()->id,
                ]);
            }
        });
    }
}
