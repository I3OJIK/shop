<?php

namespace App\Filters\Product;

use App\Filters\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter implements Filter
{
    public function apply(Builder $query, mixed $value): Builder
    {
        return $query->whereHas(
            'category',
            fn (Builder $query) => $query->where(
                'slug',
                $value,
            ),
        );
    }
}