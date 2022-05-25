<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\User\Web\UserWebAuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware'=>'guest:admin'], function() {
    Route::get('admin/login', [AdminAuthController::class, 'loginView'])->name('admin.loginView');
    Route::post('admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
});

Route::group(['middleware'=>'guest'], function() {
    Route::get('user/login', [UserWebAuthController::class, 'loginView'])->name('user.loginView');
    Route::post('user/login', [UserWebAuthController::class, 'login'])->name('user.login');
});
