<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AuthController;

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


