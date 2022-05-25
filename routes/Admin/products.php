<?php

use App\Http\Controllers\Admin\ProductsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'products'], function() {
    Route::get('/', [ProductsController::class, 'index'])->name('admin.products.index');
    Route::get('/create', [ProductsController::class, 'create'])->name('admin.products.create');
    Route::post('/', [ProductsController::class, 'store'])->name('admin.products.store');
});