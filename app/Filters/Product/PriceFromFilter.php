<?php

namespace App\Filters\Product;

use App\Filters\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class PriceFromFilter implements Filter
{

    public function apply(Builder $query, mixed $minPrice): Builder
    {
        $query = $query->where('price', '>=', $minPrice);
        return $query;
    }
}