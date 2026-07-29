<?php

namespace App\Filters\Product\Filters;

use App\Filters\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class BrandFilter implements Filter
{
    public function apply(Builder $query ,mixed $value): Builder
    {
        return $query->whereHas(
            'brand',
            fn (Builder $query) => $query->where(
                'slug',
                $value,
            ),
        );
    }
}