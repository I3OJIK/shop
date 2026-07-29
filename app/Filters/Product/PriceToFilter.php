<?php

namespace App\Filters\Product\Filters;

use App\Filters\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class PriceToFilter implements Filter
{

    public function apply(Builder $query, mixed $maxPrice): Builder
    {
        $query = $query->where('price', '<=', $maxPrice);
        return $query;
    }
}