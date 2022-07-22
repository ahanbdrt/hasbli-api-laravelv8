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
 * route resource tenant
*/
Route::apiResource('/tenant', App\Http\Controllers\Api\TenantController::class);
Route::apiResource('/user', App\Http\Controllers\Api\UserController::class);
Route::apiResource('/jenis_barang_tenant', App\Http\Controllers\Api\JenisBarangTenantController::class);
Route::apiResource('/product', App\Http\Controllers\Api\ProductController::class);
Route::apiResource('/transaksi', App\Http\Controllers\Api\TransaksiController::class);
Route::apiResource('/penjualan', App\Http\Controllers\Api\PenjualanController::class);