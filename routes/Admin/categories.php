<?php

use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix'=>'categories','middleware' => ['auth:admin']], function () {
    Route::get('/', [CategoriesController::class, 'index'])->name('admin.categories.index');
    Route::get('/create', [CategoriesController::class, 'create'])->name('admin.categories.create');
    Route::get('/edit', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
    Route::post('/', [CategoriesController::class, 'store'])->name('admin.categories.store');
    Route::put('/{id}', [CategoriesController::class, 'update'])->name('admin.categories.update');
    Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('admin.categories.destroy');
});