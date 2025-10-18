<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisSuratController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::prefix('surat')->group(function () {
    Route::get('/', [GuestController::class, 'index'])->name('surat.guest.index');
    Route::post('/tracking', [GuestController::class, 'track'])->name('surat.guest.track');
});

Route::get('/auth', [authController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [authController::class, 'login'])->name('auth.login');
Route::get('/login', [authController::class, 'index'])->name('login');

Route::get('dashboard', [DashboardController::class, 'index']) -> name('dashboard');

// Route untuk CRUD Warga
Route::resource('warga', WargaController::class);

// Route untuk CRUD Jenis Surat
Route::resource('jenis-surat', JenisSuratController::class);
