<?php

use App\Http\Controllers\Admin\ArsipSuratController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JenisSuratController;
use App\Http\Controllers\Admin\JenisSuratController as AdminJenisSuratController;
use App\Http\Controllers\Admin\KategoriSuratController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\PengajuanSuratController;
use App\Http\Controllers\Admin\TemplateSuratController;
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

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//penduduk
Route::resource('penduduk', PendudukController::class);

//KATEGORI SURAT
Route::resource('kategori-surat', KategoriSuratController::class);

//jenis surat
Route::resource('jenis-surat', JenisSuratController::class);

//template surat
Route::resource('template-surat', TemplateSuratController::class);

// Pengajuan Surat
Route::get('/pengajuan-surat', [PengajuanSuratController::class, 'index'])->name('pengajuan-surat.index');
Route::get('/pengajuan-surat/proses/{id}', [PengajuanSuratController::class, 'proses'])->name('pengajuan-surat.proses');
Route::post('/pengajuan-surat/proses/{id}/setujui', [PengajuanSuratController::class, 'setujui'])->name('pengajuan-surat.setujui');
Route::post('/pengajuan-surat/proses/{id}/tolak', [PengajuanSuratController::class, 'tolak'])->name('pengajuan-surat.tolak');

// Arsip Digital
Route::get('/arsip-digital', [ArsipSuratController::class, 'index'])->name('arsip-digital.index');
