<?php

use App\Http\Controllers\Api\Catalog\CategoryController;
use App\Http\Controllers\Api\Catalog\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('{product:slug}', [ProductController::class, 'show']);
});

Route::prefix('categories')->group(function () {

    Route::get('/', [CategoryController::class, 'index']);

    Route::get('{category:slug}', [CategoryController::class, 'show']);
});

Route::get('brands', [BrandController::class, 'index']);

Route::prefix('cart')->group(function () {

    Route::get('/', [CartController::class, 'show']);

    Route::post('items', [CartController::class, 'store']);

    Route::patch('items/{item}', [CartController::class, 'update']);

    Route::delete('items/{item}', [CartController::class, 'destroy']);

    Route::delete('/', [CartController::class, 'clear']);
});

Route::prefix('orders')->group(function () {

    Route::get('/', [OrderController::class, 'index']);

    Route::post('/', [OrderController::class, 'store']);

    Route::get('{order}', [OrderController::class, 'show']);
});