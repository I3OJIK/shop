<?php

namespace App\Http\Controllers\Api\Catalog;

use App\Data\Requests\Catalog\ProductIndexData;
use App\Http\Controllers\Controller;
use App\Services\Catalog\CatalogService;
use Spatie\LaravelData\PaginatedDataCollection;

class ProductController extends Controller
{
    public function __construct(
        private CatalogService $catalogService
    ) {}

    public function index(ProductIndexData $data): PaginatedDataCollection
    {
        return $this->catalogService->getProducts($data);
    }
}
