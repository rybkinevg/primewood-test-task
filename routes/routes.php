<?php

declare(strict_types=1);

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\HomeController;
use Framework\Router\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/api/products', [ProductController::class, 'index']),
    Route::post('/api/products', [ProductController::class, 'store']),
];