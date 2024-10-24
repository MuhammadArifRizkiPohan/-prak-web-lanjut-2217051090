<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; // Pastikan Anda mengimpor UserController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome');
});
Route::get('/profile', [UserController::class, 'profile'])->name('profile');

// Rute untuk menampilkan formulir pembuatan pengguna
Route::get('/user/create', [UserController::class, 'create']);

// Rute untuk menyimpan data pengguna (POST request)
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

// Rute untuk menampilkan profil pengguna
Route::get('/user/profile', [UserController::class, 'profile']);