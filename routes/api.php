<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StockController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index']);
        Route::get('/product/{id}', [ProductController::class, 'show']);
        Route::post('/product', [ProductController::class, 'store']);
        Route::put('/product/{id}', [ProductController::class, 'update']);
        Route::delete('/product/{id}', [ProductController::class, 'destroy']);
    });

    Route::prefix('branches')->group(function () {
        Route::get('/', [BranchController::class, 'index']);
        Route::get('/branch/{id}', [BranchController::class, 'show']);
        Route::post('/branch', [BranchController::class, 'store']);
        Route::put('/branch/{id}', [BranchController::class, 'update']);
        Route::delete('/branch/{id}', [BranchController::class, 'destroy']);
    });

    Route::prefix('stocks')->group(function () {
        Route::get('/', [StockController::class, 'index']);
        Route::get('/stock/{id}', [StockController::class, 'show']);
        Route::post('/stock', [StockController::class, 'store']);
        Route::put('/stock/{id}', [StockController::class, 'update']);
        Route::delete('/stock/{id}', [StockController::class, 'destroy']);
        //Route::get('/get-all-stock-transfers', [StockController::class, 'getAllStockTransfer']);
    });

    Route::prefix('purchases')->group(function () {
        Route::get('/buy-product/{id}', [PurchaseController::class, 'buyProduct']);
    });

});
