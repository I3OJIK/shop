<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AttributeSeeder extends Seeder
{
    public function run(): void
    {
        $attributes = [
            'Color' => [
                'is_variant' => true,
                'values' => [
                    'Black',
                    'White',
                    'Blue',
                    'Silver',
                ],
            ],

            'Storage' => [
                'is_variant' => true,
                'values' => [
                    '128GB',
                    '256GB',
                    '512GB',
                    '1TB',
                ],
            ],

            'RAM' => [
                'is_variant' => true,
                'values' => [
                    '8GB',
                    '16GB',
                    '32GB',
                ],
            ],

            'Material' => [
                'is_variant' => false,
                'values' => [
                    'Plastic',
                    'Aluminium',
                    'Glass',
                ],
            ],

        ];

        foreach ($attributes as $name => $data) {
            $attribute = Attribute::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'is_variant' => $data['is_variant'],
            ]);

            foreach ($data['values'] as $value) {
                AttributeValue::create([
                    'attribute_id' => $attribute->id,
                    'value' => $value,
                    'slug' => Str::slug($value),
                ]);
            }
        }
    }
}