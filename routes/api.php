<?php

use App\Http\Controllers\AuthController;
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

    Route::controller(AuthController::class)->group(function () {
        Route::post('login','login');
        Route::post('register', 'register');
        Route::post('send-verify-code','sendVerifyCode');
        Route::post('verify-code','verifyCode');
        Route::post('reset-password','resetPassword');
    });
    Route::middleware(['jwt.verify'])->group(function () {
        Route::controller(AuthController::class)->group(function (){
            Route::post('logout', 'logout');
            Route::post('refresh', 'refresh');
            Route::get('user-profile', 'userProfile');
        });
        Route::controller(StoreController::class)->group(function (){
            Route::get('home', 'home');
            Route::get('main-categories', 'mainCategories');
            Route::get('main-category/{id}',  'mainCategory');
            Route::get('sub-category/{id}',  'subCategory');
            Route::get('products', 'products');
            Route::get('product/{id}', 'product');
        });
});


