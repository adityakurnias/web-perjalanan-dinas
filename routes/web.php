<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SPPDController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BiayaController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // SPPD Routes
    Route::resource('sppd', SPPDController::class);
    Route::post('/sppd/{id}/approve', [SPPDController::class, 'approve'])->name('sppd.approve');
    Route::post('/sppd/{id}/reject', [SPPDController::class, 'reject'])->name('sppd.reject');

    // Laporan Routes
    Route::resource('laporan', LaporanController::class);
    Route::get('/laporan/{id}/export', [LaporanController::class, 'export'])->name('laporan.export');

    // Biaya Routes
    Route::resource('biaya', BiayaController::class);
    Route::post('/biaya/{id}/approve', [BiayaController::class, 'approve'])->name('biaya.approve');
    Route::post('/biaya/{id}/reject', [BiayaController::class, 'reject'])->name('biaya.reject');

    // Pegawai Routes (Admin only)
    Route::middleware('admin')->group(function () {
        Route::resource('pegawai', PegawaiController::class);
        Route::post('/pegawai/{id}/approve', [PegawaiController::class, 'approve'])->name('pegawai.approve');
        Route::post('/pegawai/{id}/reject', [PegawaiController::class, 'reject'])->name('pegawai.reject');

        // Anggaran Routes
        Route::resource('anggaran', AnggaranController::class);
    });

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/welcome', function () {
    return view('welcome');
});