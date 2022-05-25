<?php

use App\Http\Controllers\User\Web\ProductsController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'products'], function() {
    Route::get('/', [ProductsController::class, 'index'])->name('user.products.web.index');
});