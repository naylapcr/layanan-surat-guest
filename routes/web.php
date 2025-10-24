<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisSuratController;

Route::get('/', function () {
    return view('guest.dashboard');
})->name('home');

// Route untuk CRUD Warga
Route::resource('warga', WargaController::class);

// Route untuk CRUD Jenis Surat - PASTIKAN INI ADA
Route::resource('jenis-surat', JenisSuratController::class);

// Route lainnya...
Route::prefix('surat')->group(function () {
    Route::get('/', [GuestController::class, 'index'])->name('surat.guest.index');
    Route::post('/tracking', [GuestController::class, 'track'])->name('surat.guest.track');
});

Route::get('/auth', [AuthController::class, 'index'])->name('auth.index');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/login', [AuthController::class, 'index'])->name('login');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/tracking', [GuestController::class, 'tracking'])
    ->name('guest.tracking');
