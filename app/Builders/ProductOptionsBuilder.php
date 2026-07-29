<?php

namespace App\Builders;

use App\Data\Responses\Catalog\AvailableOptionData;
use App\Models\Product;
use Illuminate\Support\Collection;

/**
 * Получает доступные у товара атрибуты (которые относятся к вариантам)
 * и их значения
 */
class ProductOptionsBuilder
{
    public function build(Product $product): Collection
    {
        return $product->variants
            ->flatMap(fn ($variant) => $variant->attributes)
            ->groupBy('attribute_id')
            ->map(function ($attributes) {

                $attribute = $attributes->first()->attribute;

                return new AvailableOptionData(
                    attribute: $attribute->name,

                    values: $attributes
                        ->pluck('value.value')
                        ->unique()
                        ->values()
                        ->toArray()
                );

            })
            ->values();
    }
}