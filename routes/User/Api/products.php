<?php

use App\Http\Controllers\User\Api\ProductsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'products'], function() {
    Route::get('/', [ProductsController::class, 'index'])->name('products.api.index');
});