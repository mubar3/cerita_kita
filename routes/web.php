<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ProfilController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login_page', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/barang', [HomeController::class, 'barang'])->name('barang');

    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/profil/password', [ProfilController::class, 'password']);
    Route::patch('/ganti-password/{profil}', [ProfilController::class, 'ganti_password']);
    Route::resource('umum', UmumController::class);

    // Roles
    Route::get('/roles/pilihan', [RolesController::class, 'pilihan']);
    Route::get('/roles/pilih/{roles}', [RolesController::class, 'pilih']);
    Route::post('/ajaxRoles', [RolesController::class, 'ajax']);
    Route::get('/roles/delete/{id}', [RolesController::class, 'delete']);
    Route::resource('roles', RolesController::class);
    
    Route::view('/403', '403');
});