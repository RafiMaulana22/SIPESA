@extends('layouts.auth')

@section('title', 'Login Admin - SIPESA')

@section('content')

    <div class="card auth-card border-0">
        <div class="card-body p-0">

            <div class="mb-4">
                <h3 class="fw-bold text-dark mb-2" style="letter-spacing: -0.02em;">
                    Login Admin
                </h3>
                <p class="text-muted small mb-0">
                    Silakan masukkan kredensial akun Anda untuk mengakses dashboard sistem.
                </p>
            </div>

            <form method="POST" action="#">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Alamat Email</label>
                    <div class="input-group input-group-modern">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" class="form-control" name="email" placeholder="nama@email.com" required
                            autocomplete="username">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kata Sandi</label>
                    <div class="input-group input-group-modern">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" class="form-control" name="password" placeholder="••••••••" required
                            autocomplete="current-password">
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check m-0">
                        <input class="form-check-input shadow-none custom-checkbox" type="checkbox" id="rememberMe"
                            name="remember">
                        <label class="form-check-label text-secondary small fw-medium mt-0.5" for="rememberMe"
                            style="cursor: pointer;">
                            Ingat Saya
                        </label>
                    </div>
                    <a href="/forgot-password" class="auth-link small">Lupa Password?</a>
                </div>

                <button type="submit"
                    class="btn btn-auth w-100 py-2.5 d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-box-arrow-in-right fs-5"></i> Masuk ke Dashboard
                </button>

            </form>

        </div>
    </div>

@endsection
