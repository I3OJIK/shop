<?php

namespace App\Filters\Product;

use App\Filters\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

class SearchFilter implements Filter
{
    public function apply(Builder $query, mixed $searchTerm): Builder
    {
        return $query->where('name', 'LIKE', "%{$searchTerm}%");
    }
}