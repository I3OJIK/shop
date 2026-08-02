<?php

namespace App\Services\Catalog;

use App\Data\Requests\Catalog\ProductIndexData;
use App\Data\Responses\Catalog\CatalogProductData;
use App\Data\Responses\Catalog\CategoryData;
use App\Data\Responses\Category\CategoryPageData;
use App\Data\Responses\Shared\BreadcrumbData;
use App\Data\Responses\Shared\CategoryTreeItemData;
use App\Filters\Product\ProductFilter;
use App\Models\Category;
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

        return CatalogProductData::collect($products, PaginatedDataCollection::class);
    }

    // public function show(string $slug): ProductDetailsData {}

    public function category(Category $category, ProductIndexData $data): CategoryPageData 
    {
        $categoryIds = Category::descendantsAndSelf($category->id)->pluck('id');

        $query = Product::query()
            ->active()
            ->withCatalogRelations()
            ->whereIn('category_id', $categoryIds);
    
        $query = $this->productFilter->apply($query, $data);
    
        $query = $query->paginate(
            perPage: $data->per_page,
            page: $data->page,
        );
    
        return new CategoryPageData(
    
            category: CategoryData::fromModel(
                $category
            ),
    
            breadcrumbs: BreadcrumbData::collect(
                Category::defaultOrder()
                    ->ancestorsAndSelf($category->id)
            )->all(),
    
            children: CategoryTreeItemData::collect(
                $category->children
            )->all(),
    
            products: CatalogProductData::collect(
                $query,
                PaginatedDataCollection::class
            ),
        );
    }
}
