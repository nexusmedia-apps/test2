<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopifyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/orders', [ShopifyController::class, 'index']);
Route::post('/import', [ShopifyController::class, 'import']);
