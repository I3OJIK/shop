<?php

namespace App\Services\Catalog;

use App\Data\Requests\Catalog\ProductIndexData;
use App\Data\Responses\Catalog\CatalogProductData;
use App\Data\Responses\Catalog\CategoryData;
use App\Data\Responses\Catalog\ProductDetailsData;
use App\Data\Responses\Category\CategoryPageData;
use App\Data\Responses\Shared\BreadcrumbData;
use App\Data\Responses\Shared\CategoryTreeData;
use App\Filters\Product\ProductFilter;
use App\Models\Category;
use App\Models\Product;
use Spatie\LaravelData\PaginatedDataCollection;

class CatalogService
{
    public function __construct(
        private ProductFilter $productFilter,
    ) {}

    /**
     * Получить список всех товаров с фильтрацией и пагинацией
     */
    public function getProducts(ProductIndexData $data): PaginatedDataCollection
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

    public function getPtoductDetails(Product $product): ProductDetailsData
    {
        $product->loadDetailsRelations();

        return ProductDetailsData::fromModel($product);
    }

    /**
     * Получить страницу категории с товарами
     * Включает информацию о категории, хлебные крошки, дочерние категории и товары
     */
    public function getCategoryPage(Category $category, ProductIndexData $data): CategoryPageData
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

            children: CategoryData::collect(
                $category->children
            )->all(),

            products: CatalogProductData::collect(
                $query,
                PaginatedDataCollection::class
            ),
        );
    }

    /**
     * Получить дерево категорий.
     */
    public function getCategoriesTree()
    {
        return CategoryTreeData::collect(
            Category::defaultOrder()
                ->get()
                ->toTree()
        );
    }
}
