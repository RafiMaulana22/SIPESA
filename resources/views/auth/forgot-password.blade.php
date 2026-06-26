@extends('layouts.auth')

@section('title', 'Lupa Password - SIPESA')

@section('content')

    <div class="card auth-card border-0">
        <div class="card-body p-0">

            <div class="mb-4">
                <div class="text-center mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                        style="width: 64px; height: 64px;">
                        <i class="bi bi-envelope-lock text-primary fs-3"></i>
                    </div>
                </div>

                <h3 class="fw-bold text-dark text-center mb-2" style="letter-spacing: -0.02em;">
                    Lupa Password
                </h3>
                <p class="text-muted small text-center mb-0 mx-auto" style="max-width: 360px;">
                    Masukkan alamat email terdaftar Anda. Sistem akan mengirimkan tautan verifikasi untuk mengatur ulang
                    kata sandi.
                </p>
            </div>

            <form method="POST" action="#">
                @csrf

                <div class="mb-4">
                    <label class="form-label">Alamat Email Sistem</label>
                    <div class="input-group input-group-modern">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" class="form-control" name="email" placeholder="nama@email.com" required
                            autocomplete="email" autofocus>
                    </div>
                </div>

                <button type="submit"
                    class="btn btn-auth w-100 py-2.5 d-flex align-items-center justify-content-center gap-2 mb-3">
                    <i class="bi bi-send-fill small"></i> Kirim Link Reset Password
                </button>
            </form>

            <div class="text-center mt-3">
                <a href="/login"
                    class="auth-link small d-inline-flex align-items-center gap-1.5 text-decoration-none fw-medium">
                    <i class="bi bi-arrow-left"></i> Kembali ke Login
                </a>
            </div>

        </div>
    </div>

@endsection
