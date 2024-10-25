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

// Rute untuk menampilkan profil pengguna
Route::get('/profile', [UserController::class, 'profile'])->name('profile');

// Rute untuk menampilkan formulir pembuatan pengguna
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');

// Rute untuk menyimpan data pengguna (POST request)
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

// Rute untuk menampilkan profil pengguna
Route::get('/user/profile', [UserController::class, 'profile']);

// Rute untuk menampilkan daftar pengguna
Route::get('/users', [UserController::class, 'index'])->name('user.list');
// Rute untuk menampilkan formulir edit pengguna
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
// Rute untuk menghapus pengguna
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::resource('users', UserController::class);
