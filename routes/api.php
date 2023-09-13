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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/get_penjualan_harian', [App\Http\Controllers\AjaxController::class, 'get_penjualan_harian']);
Route::post('/get_penjualan_produk', [App\Http\Controllers\AjaxController::class, 'get_penjualan_produk']);
Route::post('/get_penjualan_jam', [App\Http\Controllers\AjaxController::class, 'get_penjualan_jam']);
Route::post('/get_penjualan_tanggal', [App\Http\Controllers\AjaxController::class, 'get_penjualan_tanggal']);
Route::post('/get_barang', [App\Http\Controllers\AjaxController::class, 'get_barang']);
Route::post('/get_bahan', [App\Http\Controllers\AjaxController::class, 'get_bahan']);
Route::post('/save_bahan', [App\Http\Controllers\AjaxController::class, 'save_bahan']);
Route::post('/report', [App\Http\Controllers\AjaxController::class, 'report']);
