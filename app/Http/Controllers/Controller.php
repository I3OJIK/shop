<?php

namespace App\Http\Controllers;

use App\Data\Requests\Catalog\ProductIndexData;
use App\Services\Catalog\CatalogService;
use Spatie\LaravelData\PaginatedDataCollection;

class Controller
{
    public function __construct(
        private CatalogService $catalogService
    )
    {}

    public function index(ProductIndexData $data): PaginatedDataCollection
    {
        return $this->catalogService->index($data);
    }
}
