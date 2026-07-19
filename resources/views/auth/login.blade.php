@extends('layouts.auth')

@section('title', 'Login Admin - SIPESA')

@section('content')

    <div class="card auth-card border-0 animate-fadeIn">
        <div class="card-body p-0">

            <!-- HEADER BRANDING FORM -->
            <div class="mb-4">
                <h3 class="fw-bold text-dark mb-2" style="letter-spacing: -0.02em;">
                    Login Admin
                </h3>
                <p class="text-muted small mb-0">
                    Silakan masukkan kredensial akun Anda untuk mengakses dashboard sistem administrasi.
                </p>
            </div>

            <!-- NOTIFIKASI ERROR VALIDASI -->
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-3 mb-4 small">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- BLOK FORM UTAMA -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Input Email -->
                <div class="mb-3.5">
                    <label class="form-label">Alamat Email</label>
                    <div class="input-group input-group-modern">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                            placeholder="nama@email.com" required autofocus autocomplete="username">
                    </div>
                </div>

                <!-- Input Password -->
                <div class="mb-3.5">
                    <label class="form-label">Kata Sandi</label>
                    <div class="input-group input-group-modern position-relative">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" class="form-control pe-5" id="password" name="password"
                            placeholder="••••••••" required autocomplete="current-password">

                        <!-- Toggler Posisi Tepat di Sisi Kanan Input -->
                        <button
                            class="position-absolute end-0 top-50 translate-middle-y border-0 bg-transparent pe-3 d-flex align-items-center"
                            type="button" id="togglePassword" style="z-index: 10; height: 100%;">
                            <i class="bi bi-eye" id="togglePasswordIcon" style="color: var(--slate-400);"></i>
                        </button>
                    </div>
                </div>

                <!-- Opsi Ingat Saya & Akses Lupa Password -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    {{--  <div class="form-check m-0 d-flex align-items-center gap-2">
                        <input class="form-check-input shadow-none custom-checkbox m-0" type="checkbox" id="rememberMe"
                            name="remember">
                        <label class="form-check-label text-secondary small fw-medium mt-0.5" for="rememberMe"
                            style="cursor: pointer; user-select: none;">
                            Ingat Saya
                        </label>
                    </div>  --}}
                    {{-- <a href="{{ route('password.request') }}" class="auth-link small">Lupa Password?</a> --}}
                </div>

                <!-- Kelompok Tombol Aksi Bawah -->
                <div class="d-flex flex-column gap-2.5">
                    <button type="submit"
                        class="btn btn-auth w-100 py-2.5 d-flex align-items-center justify-content-center gap-2 text-white shadow-sm transition-base">
                        <i class="bi bi-box-arrow-in-right fs-5"></i> Masuk ke Dashboard
                    </button>

                    <br>

                    <a href="{{ url('/') }}"
                        class="btn btn-light border text-secondary w-100 py-2.5 d-flex align-items-center justify-content-center gap-2 fw-medium rounded-3 shadow-none transition-base small">
                        <i class="bi bi-arrow-left-circle"></i> Kembali ke Halaman Utama
                    </a>
                </div>
            </form>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.getElementById('togglePassword');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            toggleButton.addEventListener('click', function() {
                // Proses toggle tipe input text / password
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');

                // Proses pertukaran ikon bootstrap
                toggleIcon.classList.toggle('bi-eye');
                toggleIcon.classList.toggle('bi-eye-slash');

                // Kembalikan fokus ke input password agar mempermudah user
                passwordInput.focus();
            });
        });
    </script>
@endpush
