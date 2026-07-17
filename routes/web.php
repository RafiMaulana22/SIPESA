<?php

use App\Http\Controllers\Admin\ArsipSuratController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JenisSuratController;
use App\Http\Controllers\Admin\JenisSuratController as AdminJenisSuratController;
use App\Http\Controllers\Admin\KategoriSuratController;
use App\Http\Controllers\Admin\ManajemenUserController;
use App\Http\Controllers\Admin\PendudukController;
use App\Http\Controllers\Admin\PengajuanSuratController;
use App\Http\Controllers\Admin\PersyaratanSuratController;
use App\Http\Controllers\Admin\TemplateSuratController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Landing\BeritaController;
use App\Http\Controllers\Landing\HomeController;
use App\Http\Controllers\Landing\LayananController;
use App\Http\Controllers\Landing\PengajuanSuratController as LandingPengajuanSuratController;
use App\Http\Controllers\Landing\ProfilController;
use App\Models\Admin\PersyaratanSuratModel;
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

    // Landing Pengajuan Surat
    Route::post('/validasi-nik', [LandingPengajuanSuratController::class, 'validasiNik'])->name('landing.validasi-nik');
    Route::post('/form-pengajuan', [LandingPengajuanSuratController::class, 'formPengajuan'])->name('landing.form-pengajuan');
    Route::get('/form-pengajuan/{id}', [LandingPengajuanSuratController::class, 'getPersyaratan'])->name('landing.get-persyaratan');
    Route::post('/cek-status', [LandingPengajuanSuratController::class, 'cekStatus'])->name('landing.cek-status');
    Route::get('/pengajuan-surat/form/{nik}', [LandingPengajuanSuratController::class, 'form'])->name('landing.form');
    Route::get('/kategori/{kategori}/jenis-surat', [LandingPengajuanSuratController::class, 'getJenisSurat'])->name('landing.kategori.jenis');

    // Auth Login
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    // Auth Forgot Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('auth.forgot-password');

    // Auth Reset Password
    Route::get('/reset-password', [ResetPasswordController::class, 'index'])->name('auth.reset-password');
});

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //penduduk
    Route::resource('penduduk', PendudukController::class);
    Route::post('/penduduk/import', [PendudukController::class, 'import'])->name('penduduk.import');

    //KATEGORI SURAT
    Route::resource('kategori-surat', KategoriSuratController::class);

    //jenis surat
    Route::resource('jenis-surat', JenisSuratController::class);

    // Persyratan Surat
    Route::get('/persyaratan-surat/{id}', [PersyaratanSuratController::class, 'index'])->name('persyaratan-surat.index');
    Route::post('/persyaratan-surat/{id}', [PersyaratanSuratController::class, 'store'])->name('persyaratan-surat.store');
    Route::put('/persyaratan-surat/{id}', [PersyaratanSuratController::class, 'update'])->name('persyaratan-surat.update');
    Route::delete('/persyaratan-surat/{id}', [PersyaratanSuratController::class, 'destroy'])->name('persyaratan-surat.destroy');

    //template surat
    Route::resource('template-surat', TemplateSuratController::class);

    // Pengajuan Surat
    Route::get('/pengajuan-surat', [PengajuanSuratController::class, 'index'])->name('pengajuan-surat.index');
    Route::get('/pengajuan-surat/proses/{id}', [PengajuanSuratController::class, 'proses'])->name('pengajuan-surat.proses');
    Route::put('/pengajuan-surat/mulai-proses/{id}', [PengajuanSuratController::class, 'mulaiProses'])->name('pengajuan-surat.mulai-proses');
    Route::post('/pengajuan-surat/proses/{id}/setujui', [PengajuanSuratController::class, 'setujui'])->name('pengajuan-surat.setujui');
    Route::post('/pengajuan-surat/proses/{id}/tolak', [PengajuanSuratController::class, 'tolak'])->name('pengajuan-surat.tolak');
    Route::put('/pengajuan-surat/proses/lampiran/{id}/valid', [PengajuanSuratController::class, 'validLampiran'])->name('pengajuan-surat.lampiran.valid');
    Route::put('/pengajuan-surat/proses/lampiran/{id}/tolak', [PengajuanSuratController::class, 'tolakLampiran'])->name('pengajuan-surat.lampiran.tolak');
    Route::get('/pengajuan-surat/detail/{id}', [PengajuanSuratController::class, 'detail'])->name('pengajuan-surat.detail');
    Route::get('/pengajuan-surat/{id}/preview', [PengajuanSuratController::class, 'preview'])->name('pengajuan-surat.preview');
    Route::get('/pengajuan-surat/{id}/download', [PengajuanSuratController::class, 'download'])->name('pengajuan-surat.download');

    // Arsip Digital
    Route::get('/arsip-digital', [ArsipSuratController::class, 'index'])->name('arsip-digital.index');

    // Manajemen User
    Route::get('/manajemen-user', [ManajemenUserController::class, 'index'])->name('manajemen-user.index');
    Route::post('/manajemen-user', [ManajemenUserController::class, 'store'])->name('manajemen-user.store');
    Route::put('/manajemen-user/{id}', [ManajemenUserController::class, 'update'])->name('manajemen-user.update');
    Route::delete('/manajemen-user/{id}', [ManajemenUserController::class, 'destroy'])->name('manajemen-user.destroy');

    // Auth Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
