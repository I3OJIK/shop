<?php

namespace App\Filters\Pipeline;

use App\Filters\Contracts\Filter;
use Illuminate\Database\Eloquent\Builder;

final readonly class FilterPipeline
{
    /**
     * @param array<int, array{filter: Filter, value: mixed}> $filters
     */
    public function apply(Builder $query, array $filters,): Builder
    {
        foreach ($filters as $item) {
            if(filled($item['value']))
            {
                $query = $item['filter']->apply(
                    $query,
                    $item['value'],
                );
            }
        }
        return $query;
    }
}