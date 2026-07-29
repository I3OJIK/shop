<?php

namespace App\Filters\Product;

use App\Data\Requests\Catalog\ProductIndexData;
use App\Filters\Pipeline\FilterPipeline;
use App\Filters\Product\Filters\AttributeFilter;
use App\Filters\Product\Filters\BrandFilter;
use App\Filters\Product\Filters\CategoryFilter;
use App\Filters\Product\Filters\PriceFromFilter;
use App\Filters\Product\Filters\PriceToFilter;
use App\Filters\Product\Filters\SearchFilter;
use App\Filters\Product\Filters\SortFilter;
use Illuminate\Database\Eloquent\Builder;

final readonly class ProductFilter
{
    public function __construct(
        private FilterPipeline $pipeline,

        private SearchFilter $searchFilter,
        private BrandFilter $brandFilter,
        private CategoryFilter $categoryFilter,
        private PriceFromFilter $priceFromFilter,
        private PriceToFilter $priceToFilter,
        private AttributeFilter $attributeFilter,
        private SortFilter $sortFilter,
    ) {
    }

    public function apply(Builder $query, ProductIndexData $data): Builder
    {
        return $this->pipeline->apply(
            $query,
            [
                [
                    'filter' => $this->searchFilter,
                    'value' => $data->search,
                ],
                [
                    'filter' => $this->brandFilter,
                    'value' => $data->brand,
                ],
                [
                    'filter' => $this->categoryFilter,
                    'value' => $data->category,
                ],
                [
                    'filter' => $this->priceFromFilter,
                    'value' => $data->price_from,
                ],
                [
                    'filter' => $this->priceToFilter,
                    'value' => $data->price_to,
                ],
                [
                    'filter' => $this->attributeFilter,
                    'value' => $data->attributes,
                ],
                [
                    'filter' => $this->sortFilter,
                    'value' => $data->sort,
                ],
            ],
        );
    }
}