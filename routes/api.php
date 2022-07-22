<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/**
 * route resource posts
 */
Route::apiResource('/tenant', App\Http\Controllers\Api\TenantController::class);
Route::apiResource('/posts', App\Http\Controllers\Api\PostController::class);
Route::apiResource('/product', App\Http\Controllers\Api\ProductController::class);
Route::apiResource('/penjualan', App\Http\Controllers\Api\PenjualanController::class);
Route::apiResource('/detail', App\Http\Controllers\Api\DetailController::class);
