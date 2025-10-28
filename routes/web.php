<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisSuratController;

Route::get('/', function () {
    return view('pages.guest.auth.dashboard');
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

// Routes untuk User Management
Route::resource('user', UserController::class);

Route::get('/login', [AuthController::class, 'index'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/verify-password', [AuthController::class, 'verifyPassword'])->name('verify.password');

Route::get('/login', [AuthController::class, 'index'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('guest.login-form');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('guest.register-form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Routes untuk data warga
Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');
Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
Route::get('/warga/{warga}/edit', [WargaController::class, 'edit'])->name('warga.edit');
Route::put('/warga/{warga}', [WargaController::class, 'update'])->name('warga.update');
Route::delete('/warga/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');

Route::get('/about', function () {
    return view('pages.guest.auth.about');
})->name('about');
