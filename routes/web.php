<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Landing\BeritaController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Landing\LayananController;
use App\Http\Controllers\Landing\ProfilController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    // Landing Home
    Route::get('/', [HomeController::class, 'index'])->name('landing.home');

    // Landing Profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('landing.profil');

    // Landing Layanan
    Route::get('/layanan', [LayananController::class, 'index'])->name('landing.layanan');

    // Landing Berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('landing.berita');

    // Auth Login
    Route::get('/login', [LoginController::class, 'index'])->name('auth.login');

    // Auth Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('auth.forgot-password');

    // Auth Reset Password
    Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('auth.reset-password');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('index');
