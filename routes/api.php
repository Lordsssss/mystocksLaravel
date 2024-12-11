<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use Illuminate\Http\Request;

// Authentication (default Laravel Auth controllers with Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return auth()->user();
    });

    // Stock routes
    Route::get('/stocks', [StockController::class, 'index']); // List all stocks
    Route::get('/stocks/{id}', [StockController::class, 'show']); // Show specific stock details
    Route::post('/stocks', [StockController::class, 'store']); // Add a new stock
    Route::put('/stocks/{id}', [StockController::class, 'update']); // Update an existing stock
    Route::delete('/stocks/{id}', [StockController::class, 'destroy']); // Delete a stock

    // Search stocks
    Route::get('/search-stocks', [StockController::class, 'searchStocks']);
});

// Authentication routes for login, register, and logout
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);


use App\Http\Controllers\PortfolioController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/sell-stock', [PortfolioController::class, 'sellStock']);
    Route::post('/update-stock-image-url', [PortfolioController::class, 'updateImageUrl']);
    Route::get('/owned-stocks', [PortfolioController::class, 'getOwnedStocks']);
    Route::post('/buy-stock', [PortfolioController::class, 'buyStock']);
});