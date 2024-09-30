<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopifyController;

Route::get('/', function () {
    return view('orders');
});

Route::get('/orders', [ShopifyController::class, 'getOrders']);
Route::post('/import', [ShopifyController::class, 'import']);
