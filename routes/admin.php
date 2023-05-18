<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainCategoriesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SubCategoriesController;
use Illuminate\Support\Facades\Route;

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

//    define('PAGINATION_COUNT',50);

Route::controller(DashboardController::class)->group(function (){
    Route::get('/',function (){return 'sdf';})->name('admin.dashboard');
});

    Route::controller(MainCategoriesController::class)->prefix('main_categories')->group(function () {
        Route::get('/','index') -> name('admin.maincategories');
        Route::get('create','create') -> name('admin.maincategories.create');
        Route::post('store','store') -> name('admin.maincategories.store');

        Route::get('edit/{id}','edit') -> name('admin.maincategories.edit');
        Route::post('update/{id}','update') -> name('admin.maincategories.update');
        Route::get('delete/{id}','destroy') -> name('admin.maincategories.delete');
        Route::get('changeStatus/{id}','changeStatus') -> name('admin.maincategories.status');
        Route::get('showVendors/{id}','showVendors') -> name('admin.maincategories.show_vendors');

    });
    ################################## sub categories routes ######################################
    Route::controller(SubCategoriesController::class)->prefix('sub_categories   ')->group(function () {
        Route::get('/', 'index')->name('admin.subcategories');
        Route::get('create', 'create')->name('admin.subcategories.create');
        Route::post('store', 'store')->name('admin.subcategories.store');
        Route::get('edit/{id}', 'edit')->name('admin.subcategories.edit');
        Route::post('update/{id}', 'update')->name('admin.subcategories.update');
        Route::get('update/{id}', 'destroy')->name('admin.subcategories.delete');
        Route::get('delete/{id}', 'changeStatus')->name('admin.subcategories.status');
        Route::get('showVendors/{id}','showVendors') -> name('admin.subcategories.show_vendors');

    });

    ######################### Begin Products Routes ########################
    Route::controller(ProductsController::class)->prefix('products')->group(function () {
        Route::get('/','index') -> name('admin.products');
        Route::get('create','create') -> name('admin.products.create');
        Route::post('store','store') -> name('admin.products.store');

        Route::get('edit/{id}','edit') -> name('admin.products.edit');
        Route::post('update/{id}','update') -> name('admin.products.update');
        Route::get('delete/{id}','destroy') -> name('admin.products.delete');
        Route::get('changeStatus/{id}','changeStatus') -> name('admin.products.status');

    });


Route::get('es',function (){
    return view('auth.register');
});


