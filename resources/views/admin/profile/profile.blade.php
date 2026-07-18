@extends('admin.components.template_admin')

@section('content')
    <!-- HEADER UTAMA -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold  mb-1" style="letter-spacing: -0.02em;">
                Profil Akun
            </h3>
            <p class="text-muted small mb-0">
                Kelola informasi data pribadi dan konfigurasi kata sandi pengaman akun administrator Anda.
            </p>
        </div>
    </div>

    <!-- NOTIFIKASI SYSTEM -->
    @if (session('success'))
        <div
            class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 small d-flex align-items-center gap-2">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div
            class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 small d-flex align-items-center gap-2">
            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
            <div>
                <strong>Gagal!</strong> {{ session('error') }}
            </div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">

        <!-- SISI KIRI: RINGKASAN KARTU PROFIL (col-lg-4) -->
        <div class="col-lg-4">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100">
                <div class="card-body text-center py-5">

                    @php
                        $nama = auth()->user()->name;
                        $inisial = collect(explode(' ', trim($nama)))
                            ->map(fn($item) => strtoupper(substr($item, 0, 1)))
                            ->take(2)
                            ->implode('');
                    @endphp

                    <!-- Avatar Inisial Bulat Elegan -->
                    <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm mb-3"
                        style="width: 110px; height: 120px; font-size: 38px; font-weight: 700; background: linear-gradient(135deg, #4f46e5, #2563eb);">
                        {{ $inisial }}
                    </div>

                    <h4 class="fw-bold  mb-2" style="letter-spacing: -0.01em;">
                        {{ auth()->user()->name }}
                    </h4>

                    <div class="mb-4">
                        <span
                            class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10 px-3 py-1.5 rounded-2 fw-semibold small">
                            <i class="bi bi-shield-lock me-1"></i>
                            {{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}
                        </span>
                    </div>

                    <hr class="opacity-5 my-4">

                    <!-- Detail Identitas Singkat -->
                    <div class="text-start px-2">
                        <div class="mb-3.5">
                            <small class="text-muted d-block mb-1 fw-medium">Alamat Email Sistem</small>
                            <div class=" fw-semibold d-flex align-items-center gap-2">
                                <i class="bi bi-envelope text-muted"></i> {{ auth()->user()->email }}
                            </div>
                        </div>

                        <div class="mb-3.5">
                            <small class="text-muted d-block mb-1 fw-medium">Tanggal Bergabung</small>
                            <div class=" fw-semibold d-flex align-items-center gap-2">
                                <i class="bi bi-calendar3 text-muted"></i>
                                {{ auth()->user()->created_at->translatedFormat('d F Y') }}
                            </div>
                        </div>

                        <div>
                            <small class="text-muted d-block mb-1 fw-medium">Status Hak Akses</small>
                            <div class="mt-1">
                                <span
                                    class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                    Akun Aktif
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- SISI KANAN: FORM UPDATE DATA & PASSWORD (col-lg-8) -->
        <div class="col-lg-8">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white p-4 border-0 pb-0">
                    <h5 class="fw-bold  mb-0" style="letter-spacing: -0.01em;">
                        Informasi Detail Akun
                    </h5>
                </div>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body p-4">

                        <!-- Baris Isian Profil Utama -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Nama Lengkap Pengguna</label>
                                <input type="text" class="form-control search-box-modern py-2.5 bg-white border"
                                    name="name" value="{{ old('name', auth()->user()->name) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Alamat Email Aktif</label>
                                <input type="email" class="form-control search-box-modern py-2.5 bg-white border"
                                    name="email" value="{{ old('email', auth()->user()->email) }}" required>
                            </div>
                        </div>

                        <hr class="opacity-5 my-4">

                        <!-- Judul Seksi Ganti Kata Sandi -->
                        <div class="mb-3">
                            <h6 class="fw-bold  m-0" style="letter-spacing: -0.01em;">
                                <i class="bi bi-key text-primary me-1"></i> Perbarui Kata Sandi Akun
                            </h6>
                            <small class="text-muted d-block mt-0.5">Kosongkan seluruh isian kolom password di bawah ini
                                jika tidak ingin mengubahnya.</small>
                        </div>

                        <!-- Baris Isian Password -->
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-medium  small mb-2">Password Saat Ini</label>
                                <input type="password" class="form-control search-box-modern py-2.5 bg-white border"
                                    name="current_password" placeholder="Masukkan sandi lama">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-medium  small mb-2">Password Baru</label>
                                <input type="password" class="form-control search-box-modern py-2.5 bg-white border"
                                    name="password" placeholder="Min. 8 karakter kustom">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-medium  small mb-2">Konfirmasi Password
                                    Baru</label>
                                <input type="password" class="form-control search-box-modern py-2.5 bg-white border"
                                    name="password_confirmation" placeholder="Ulangi sandi baru kustom">
                            </div>
                        </div>

                    </div>

                    <!-- Footer Aksi Kerja Form -->
                    <div class="card-footer bg-white border-0 p-4 pt-0 text-end">
                        <button type="submit"
                            class="btn btn-primary rounded-3 px-4 py-2.5 fw-medium shadow-none transition-base d-inline-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill small"></i> Simpan Perubahan Profil
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </div>
@endsection
