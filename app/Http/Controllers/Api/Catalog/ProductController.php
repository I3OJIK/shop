<?php

namespace App\Http\Controllers\Api\Catalog;

use App\Data\Requests\Catalog\ProductIndexData;
use App\Data\Responses\Catalog\ProductDetailsData;
use App\Http\Controllers\Controller;
use App\Models\Product;
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

    public function show(Product $product): ProductDetailsData
    {
        if (!$product->is_active) {
            abort(404, 'Product not found');
        }

        return $this->catalogService->getPtoductDetails($product);
    }
}
