<?php

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
Route::get('products/all-product',[ProductController::class,'getProduct']);
Route::post('products/add-product',[ProductController::class,'addProduct']);
Route::get('products/all-product/{id}',[ProductController::class,'getproductID']);
Route::delete('products/delete-product/{id}',[ProductController::class,'DeleteProduct']);
Route::put("products/product-update/{id}",[ProductController::class,'UpdateProduct']);