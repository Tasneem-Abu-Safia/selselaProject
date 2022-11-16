<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Web\Dashboard\LocalizationController;
use App\Http\Controllers\Web\UserManagement\RoleController;
use App\Http\Controllers\Web\UserManagement\UserController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::post('lang', [LocalizationController::class, 'setLang']);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    Route::post('product-main-image', [ProductController::class,'mainImage'])->name('productMainImage');
    Route::get('product-active/{product_id}', [ProductController::class,'deActive'])->name('productDeActive');
    Route::get('product-deActive/{product_id}', [ProductController::class,'active'])->name('productActive');


});




