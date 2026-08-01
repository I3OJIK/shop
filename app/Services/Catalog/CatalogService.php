<?php

namespace App\Services\Catalog;

use App\Data\Requests\Catalog\ProductIndexData;
use App\Data\Responses\Catalog\ProductCardData;
use App\Filters\Product\ProductFilter;
use App\Models\Product;
use Spatie\LaravelData\PaginatedDataCollection;

class CatalogService
{
    public function __construct(
        private ProductFilter $productFilter,
    ) {}

    public function index(ProductIndexData $data): PaginatedDataCollection
    {
        $query = Product::query()
            ->active()
            ->withCatalogRelations()
            ->withMin('variants', 'price');

        $query = $this->productFilter->apply(
            $query,
            $data,
        );

        $products = $query->paginate(
            perPage: $data->per_page,
            page: $data->page,
        );

        return ProductCardData::collect($products, PaginatedDataCollection::class);
    }

    // public function show(string $slug): ProductDetailsData {}
}
