<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdersDetailController;

Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'auth'
], function($router){
    Route::post('register', [AuthController::class, 'register'])->withoutMiddleware(['auth:api']);
    Route::post('login', [AuthController::class, 'login'])->withoutMiddleware(['auth:api']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('user', [AuthController::class, 'me']);
});
Route::apiResource('/items', ItemController::class);
Route::apiResource('/order', OrderController::class);
Route::apiResource('/details', OrdersDetailController::class);
Route::apiResource('/user', UserController::class);