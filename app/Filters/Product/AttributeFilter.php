<?php

namespace App\Filters\Product;

use App\Filters\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class AttributeFilter implements Filter
{
    public function apply(Builder $query, mixed $value): Builder
    {
        // $value = ['size' => ['M', 'L']]
        foreach ($value as $attributeSlug => $attributeValue) {
            $query->whereHas('variants.attributes', function ($q) use ($attributeSlug, $attributeValue) {
                $q->whereHas('attribute', function ($q) use ($attributeSlug) {
                    $q->where('slug', $attributeSlug);
                });
                $q->whereIn('value', $attributeValue);
            });
        }
        return $query;
    }
}