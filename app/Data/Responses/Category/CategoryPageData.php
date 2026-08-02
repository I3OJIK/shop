<?php

namespace App\Data\Responses\Category;

use App\Data\Responses\Catalog\CatalogProductData;
use App\Data\Responses\Catalog\CategoryData;
use App\Data\Responses\Shared\BreadcrumbData;
use App\Data\Responses\Shared\CategoryTreeData;
use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\LaravelData\Data;

#[OA\Schema]
class CategoryPageData extends Data
{
    /**
     * @param array<int, BreadcrumbData> $breadcrumbs
     * @param array<int, CategoryTreeData> $children
     */
    public function __construct(

        public CategoryData $category,

        #[DataCollectionOf(BreadcrumbData::class)]
        public array $breadcrumbs,

        #[DataCollectionOf(CategoryTreeData::class)]
        public array $children,

        #[DataCollectionOf(CatalogProductData::class)]
        public PaginatedDataCollection $products,
    ) {
    }
}