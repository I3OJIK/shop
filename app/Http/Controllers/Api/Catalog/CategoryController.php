<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Catalog;

use App\Data\Requests\Catalog\ProductIndexData;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Catalog\CatalogService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function __construct(
        private readonly CatalogService $catalogService,
    ) {
    }

    public function show(
        Category $category,
        ProductIndexData $data,
    ): JsonResponse {
        return response()->json(
            $this->catalogService->category(
                $category,
                $data,
            )
        );
    }
}