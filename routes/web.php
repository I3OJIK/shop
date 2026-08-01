<?php

use App\Data\Responses\Catalog\ProductCardData;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Catalog\CatalogService;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelData\PaginatedDataCollection;

Route::get('/', function () {
dd(1);
    $products = Product::query()
        ->with([
            'brand',
            'category',
            'images',

        'variants.attributes.attribute',
        'variants.attributes.value',
        ])
        ->withMin('variants', 'price')
        ->paginate(20);
    // dd($products);
    $data = ProductCardData::collect($products, PaginatedDataCollection::class);
    return response()->json($data);
});

Route::get('products', [Controller::class,'index']);