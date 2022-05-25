<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;



Route::post('/logout',[AuthController::class, 'logout']);
