<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController; // Pastikan huruf besar U disesuaikan dengan nama file controller
use App\Http\Controllers\GuestController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\PermohonanSuratController;

// --- ROUTE PUBLIK (Bisa diakses tanpa login) ---
Route::get('/', function () {
    return redirect()->route('login');
});

// Login & Register
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

// Tracking Surat
Route::get('/tracking', [GuestController::class, 'tracking'])->name('guest.tracking');
Route::post('/surat/tracking', [GuestController::class, 'track'])->name('surat.guest.track');


// --- ROUTE ADMIN PANEL (Wajib Login) ---
Route::middleware(['checkislogin'])->group(function () {

    // 1. Dashboard (Semua role yang login bisa masuk)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Manajemen User (HANYA SUPER ADMIN)
    // Staff dan Guest akan kena 403 Forbidden jika mencoba masuk sini
    Route::middleware(['checkrole:super_admin'])->group(function () {
        Route::resource('user', UserController::class);
    });

    // ----------------------------------------------------------------------------------
    // 3. GROUP TULIS DATA (Create, Edit, Update, Destroy)
    // ATURAN: Diletakkan DI ATAS agar route '/create' dibaca duluan sebelum '/{id}'
    // AKSES: Hanya Super Admin dan Staff. Guest DIBLOKIR.
    // ----------------------------------------------------------------------------------
    Route::middleware(['checkrole:super_admin,staff'])->group(function () {
        // CRUD Warga (Write)
        Route::get('/warga/create', [WargaController::class, 'create'])->name('warga.create');
        Route::post('/warga', [WargaController::class, 'store'])->name('warga.store');
        Route::get('/warga/{warga}/edit', [WargaController::class, 'edit'])->name('warga.edit');
        Route::put('/warga/{warga}', [WargaController::class, 'update'])->name('warga.update');
        Route::delete('/warga/{warga}', [WargaController::class, 'destroy'])->name('warga.destroy');

        // CRUD Jenis Surat (Write)
        Route::get('/jenis-surat/create', [JenisSuratController::class, 'create'])->name('jenis-surat.create');
        Route::post('/jenis-surat', [JenisSuratController::class, 'store'])->name('jenis-surat.store');
        Route::get('/jenis-surat/{jenis_surat}/edit', [JenisSuratController::class, 'edit'])->name('jenis-surat.edit');
        Route::put('/jenis-surat/{jenis_surat}', [JenisSuratController::class, 'update'])->name('jenis-surat.update');
        Route::delete('/jenis-surat/{jenis_surat}', [JenisSuratController::class, 'destroy'])->name('jenis-surat.destroy');

        // CRUD Permohonan Surat (Write)
        Route::get('/permohonan-surat/create', [PermohonanSuratController::class, 'create'])->name('permohonan-surat.create');
        Route::post('/permohonan-surat', [PermohonanSuratController::class, 'store'])->name('permohonan-surat.store');
        Route::get('/permohonan-surat/{permohonan_surat}/edit', [PermohonanSuratController::class, 'edit'])->name('permohonan-surat.edit');
        Route::put('/permohonan-surat/{permohonan_surat}', [PermohonanSuratController::class, 'update'])->name('permohonan-surat.update');
        Route::delete('/permohonan-surat/{permohonan_surat}', [PermohonanSuratController::class, 'destroy'])->name('permohonan-surat.destroy');
        Route::delete('/permohonan-surat/file/{id}', [PermohonanSuratController::class, 'deleteFile'])->name('permohonan-surat.delete-file');
    });

    // ----------------------------------------------------------------------------------
    // 4. GROUP BACA DATA (Index & Show)
    // ATURAN: Diletakkan DI BAWAH sebagai "catch-all" (penangkap terakhir)
    // AKSES: Super Admin, Staff, DAN Guest.
    // ----------------------------------------------------------------------------------
    Route::middleware(['checkrole:super_admin,staff,guest'])->group(function () {
        // Warga (Read Only)
        Route::get('/warga', [WargaController::class, 'index'])->name('warga.index');

        // Jenis Surat (Read Only)
        Route::get('/jenis-surat', [JenisSuratController::class, 'index'])->name('jenis-surat.index');

        // Permohonan Surat (Read Only)
        Route::get('/permohonan-surat', [PermohonanSuratController::class, 'index'])->name('permohonan-surat.index');

        // Route detail ({id}) diletakkan paling akhir di grup ini
        Route::get('/permohonan-surat/{permohonan_surat}', [PermohonanSuratController::class, 'show'])->name('permohonan-surat.show');
    });

});
