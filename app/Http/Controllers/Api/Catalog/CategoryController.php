<?php

namespace App\Http\Controllers\Api\Catalog;

use App\Data\Requests\Catalog\ProductIndexData;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Catalog\CatalogService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(
        private CatalogService $catalogService,
    ) {}

    public function index(): JsonResponse
    {
        return response()->json($this->catalogService->getCategoriesTree());
    }

    public function show(Category $category, ProductIndexData $data): JsonResponse
    {
        return response()->json($this->catalogService->getCategoryPage($category, $data));
    }
}
