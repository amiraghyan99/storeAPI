<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//    JWT Authentication
    Route::prefix('auth')
        ->controller(AuthController::class)
        ->group(function () {
            Route::post('login', 'login')->name('login');
            Route::post('register', 'register')->name('register');
            Route::post('logout', 'logout')->name('logout');
            Route::post('refresh', 'refresh')->name('refresh');
            Route::post('profile', 'profile')->name('profile');
        });

//    Store
    Route::apiResource('stores', StoreController::class);

//        ->middleware('auth');
    Route::apiResource('stores.products', ProductController::class);

//    Route::apiResource('stores.products', ProductController::class);
