@extends('layouts.auth')

@section('title', 'Atur Ulang Password - SIPESA')

@section('content')

    <div class="card auth-card border-0">
        <div class="card-body p-0">

            <div class="mb-4">
                <div class="text-center mb-3">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                        style="width: 64px; height: 64px;">
                        <i class="bi bi-shield-lock text-primary fs-3"></i>
                    </div>
                </div>

                <h3 class="fw-bold text-dark text-center mb-2" style="letter-spacing: -0.02em;">
                    Atur Ulang Password
                </h3>
                <p class="text-muted small text-center mb-0 mx-auto" style="max-width: 360px;">
                    Silakan masukkan kata sandi baru yang kuat untuk memulihkan akses keamanan akun Anda.
                </p>
            </div>

            <form method="POST" action="#">
                @csrf

                <input type="hidden" name="token" value="{{ request()->token }}">

                <div class="mb-3">
                    <label class="form-label">Alamat Email</label>
                    <div class="input-group input-group-modern opacity-75">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" class="form-control bg-light" name="email" value="{{ request()->email }}"
                            placeholder="nama@email.com" readonly>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kata Sandi Baru</label>
                    <div class="input-group input-group-modern">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" class="form-control" name="password" placeholder="Minimal 8 karakter"
                            required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Konfirmasi Kata Sandi</label>
                    <div class="input-group input-group-modern">
                        <span class="input-group-text">
                            <i class="bi bi-lock-fill"></i>
                        </span>
                        <input type="password" class="form-control" name="password_confirmation"
                            placeholder="Ulangi kata sandi baru" required>
                    </div>
                </div>

                <button type="submit"
                    class="btn btn-auth w-100 py-2.5 d-flex align-items-center justify-content-center gap-2 mb-3">
                    <i class="bi bi-check-circle-fill small"></i> Simpan Password Baru
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
