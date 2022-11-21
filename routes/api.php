<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
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



Route::get('products', [ProductApiController::class, 'index'])->middleware('setLocale');;
Route::get('products/{product_id}', [ProductApiController::class, 'show']);
Route::get('filter', [ProductApiController::class, 'filter']);

Route::get('/categories', function () {

    return response()->json([
        'status' => true ,
        'response_message' => 'Done Successfully',
        'data' => CategoryResource::collection(Category::whereNull('parent_id')->get()),
    ]);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'registerUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);
