<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\product;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::prefix('product')->group(function(){
//     Route::get('/all-product',[ProductController::class,'getProduct']);
//     Route::post('/add-product',[ProductController::class,'addProduct']);
//     Route::get('/all-product/{id}',[ProductController::class,'getproductID']);
//     Route::delete('/delete-product/{id}',[ProductController::class,'DeleteProduct']);
//     Route::put("/product-update/{id}",[ProductController::class,'UpdateProduct']);
// });
Route::post('user/register',[AuthController::class,'register']);
Route::post('user/login',[AuthController::class,'login']);
Route::group(["middleware"=>"auth:api","prefix"=>"product"],function(){
    Route::get('/all-product',[ProductController::class,'getProduct']);
    Route::post('/add-product',[ProductController::class,'addProduct']);
    Route::get('/all-product/{id}',[ProductController::class,'getproductID']);
    Route::delete('/delete-product/{id}',[ProductController::class,'DeleteProduct']);
    Route::put("/product-update/{id}",[ProductController::class,'UpdateProduct']);
    Route::post("/user/logout",[AuthController::class,'logout']);
});