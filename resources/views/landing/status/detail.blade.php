@extends('layouts.landing')

@section('title', 'Detail Pengajuan Surat - SIPESA')

@section('content')
    <section class="py-5 bg-light-section min-vh-100 border-bottom">
        <div class="container">

            <!-- BREADCRUMB NAVIGATION -->
            <nav class="mb-4" aria-label="Navigasi Halaman">
                <ol class="breadcrumb mb-0 small bg-transparent p-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-decoration-none">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('landing.riwayat', $pengajuan->penduduk->nik) }}" class="text-decoration-none">
                            Riwayat Pengajuan
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-dark" aria-current="page">
                        Detail Pengajuan
                    </li>
                </ol>
            </nav>

            <div class="row g-4">

                <!-- KOLOM KIRI: INFORMASI UTAMA & PERSYARATAN (col-lg-8) -->
                <div class="col-lg-8">

                    <!-- Kartu Detail Utama Surat -->
                    <div class="card bg-white border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <span
                                class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-2 fw-medium small mb-3">
                                <i class="bi bi-file-earmark-text"></i> Informasi Lembar Permohonan
                            </span>

                            <h4 class="fw-bold text-dark mb-1" style="letter-spacing: -0.02em;">
                                {{ $pengajuan->jenisSurat->nama_surat }}
                            </h4>
                            <p class="text-muted small mb-4">
                                Kode Unik Pelacakan : <span
                                    class="text-primary font-monospace fw-bold">{{ $pengajuan->kode_pengajuan }}</span>
                            </p>

                            <div class="row g-4 border-top pt-4">
                                <div class="col-sm-6">
                                    <small class="text-muted d-block mb-1 fw-medium">Nomor Urut Antrean FIFO</small>
                                    <span
                                        class="badge bg-slate-100 text-slate-700 px-2.5 py-1.5 rounded-2 fw-bold font-monospace fs-6">
                                        #{{ sprintf('%03d', $pengajuan->nomor_antrian) }}
                                    </span>
                                </div>

                                <div class="col-sm-6">
                                    <small class="text-muted d-block mb-1 fw-medium">Tanggal Pengiriman Berkas</small>
                                    <strong class="text-dark d-block mt-1">
                                        {{ $pengajuan->tanggal_pengajuan->translatedFormat('d F Y, H:i') }} WIB
                                    </strong>
                                </div>

                                <div class="col-12">
                                    <small class="text-muted d-block mb-2 fw-medium">Maksud / Keperluan Penggunaan
                                        Surat</small>
                                    <div class="p-3 bg-light rounded-3 border text-secondary small lh-base">
                                        {{ $pengajuan->keperluan }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu Pemantauan Berkas Lampiran Warga -->
                    <div class="card bg-white border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-3" style="letter-spacing: -0.01em;">
                                Verifikasi Kelengkapan Persyaratan
                            </h5>
                            <p class="text-muted small mb-4">Status pemeriksaan berkas fisik digital Anda oleh petugas
                                administrasi desa.</p>

                            <div class="d-flex flex-column gap-3">
                                @foreach ($pengajuan->lampiran as $lampiran)
                                    <div
                                        class="p-3 rounded-4 border bg-white d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-light text-secondary rounded-3 p-2.5 d-flex align-items-center justify-content-center"
                                                style="width: 44px; height: 44px;">
                                                <i class="bi bi-file-earmark-check fs-4"></i>
                                            </div>
                                            <div>
                                                <strong
                                                    class="text-dark small d-block">{{ $lampiran->persyaratan->nama_persyaratan }}</strong>
                                                <span class="text-muted font-monospace d-block mt-0.5"
                                                    style="font-size: 0.75rem;">
                                                    <i class="bi bi-paperclip"></i>
                                                    {{ $lampiran->nama_file ?? 'dokumen_lampiran.pdf' }}
                                                </span>
                                            </div>
                                        </div>

                                        <div>
                                            @switch($lampiran->status)
                                                @case('menunggu')
                                                    <span
                                                        class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1.5 rounded-2 fw-medium small">Menunggu
                                                        Validasi</span>
                                                @break

                                                @case('diproses')
                                                    <span
                                                        class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1.5 rounded-2 fw-medium small">Sedang
                                                        Ditinjau</span>
                                                @break

                                                @case('valid')
                                                @case('selesai')
                                                    <span
                                                        class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium small"><i
                                                            class="bi bi-check2"></i> Berkas Valid</span>
                                                @break

                                                @case('ditolak')
                                                    <span
                                                        class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium small">Berkas
                                                        Ditolak</span>
                                                @break
                                            @endswitch
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>

                <!-- KOLOM KANAN: STATUS UTAMA & IDENTITAS (col-lg-4) -->
                <div class="col-lg-4">

                    <!-- Kartu Status Utama Alur Kerja -->
                    <div class="card bg-white border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-3" style="letter-spacing: -0.01em;">
                                Status Alur Berkas
                            </h5>

                            <div class="mb-4">
                                @switch($pengajuan->status)
                                    @case('menunggu')
                                        <span
                                            class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-3 py-2 rounded-3 fw-bold fs-6 w-100 text-center">
                                            Menunggu Antrean
                                        </span>
                                    @break

                                    @case('diproses')
                                        <span
                                            class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-3 py-2 rounded-3 fw-bold fs-6 w-100 text-center">
                                            Sedang Diproses
                                        </span>
                                    @break

                                    @case('selesai')
                                        <span
                                            class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-3 fw-bold fs-6 w-100 text-center">
                                            Selesai & Diarsipkan
                                        </span>
                                    @break

                                    @case('ditolak')
                                        <span
                                            class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-3 fw-bold fs-6 w-100 text-center">
                                            Permohonan Ditolak
                                        </span>
                                    @break
                                @endswitch
                            </div>

                            <div class="p-3 rounded-3 border bg-light-section">
                                <label class="text-muted d-block mb-1 fw-medium" style="font-size: 0.75rem;">
                                    <i class="bi bi-chat-right-text text-primary me-1"></i> Catatan/Alasan Operator Desa:
                                </label>
                                <span class="text-dark-emphasis lh-base d-block mt-1 small">
                                    {{ $pengajuan->catatan_admin ?? 'Tidak ada catatan tambahan dari petugas balai desa untuk saat ini.' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Kartu Informasi Ringkas Pemohon -->
                    <div class="card bg-white border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold text-dark mb-3" style="letter-spacing: -0.01em;">
                                Identitas Pemohon
                            </h5>

                            <div class="d-flex flex-column gap-2.5 small">
                                <div>
                                    <span class="text-muted d-block mb-0.5" style="font-size: 0.75rem;">Nama Sesuai
                                        KTP</span>
                                    <span class="text-dark fw-bold">{{ $pengajuan->penduduk->nama }}</span>
                                </div>
                                <hr class="my-1 opacity-5">
                                <div>
                                    <span class="text-muted d-block mb-0.5" style="font-size: 0.75rem;">Nomor NIK
                                        (Kependudukan)</span>
                                    <span
                                        class="text-dark fw-semibold font-monospace">{{ $pengajuan->penduduk->nik }}</span>
                                </div>
                                <hr class="my-1 opacity-5">
                                <div>
                                    <span class="text-muted d-block mb-0.5" style="font-size: 0.75rem;">Dusun Alamat
                                        Rumah</span>
                                    <span class="text-secondary">{{ $pengajuan->penduduk->alamat }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PANEL ACTION BUTTONS -->
                    <div class="d-flex flex-column gap-2">
                        @if ($pengajuan->status == 'selesai')
                            <a href="{{ route('landing.download', $pengajuan->id) }}"
                                class="btn btn-success text-white w-100 rounded-3 py-2.5 fw-medium shadow-sm transition-base d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-download"></i> Unduh Dokumen Surat
                            </a>
                        @endif

                        <a href="{{ route('landing.riwayat', $pengajuan->penduduk->nik) }}"
                            class="btn btn-outline-primary bg-white w-100 rounded-3 py-2.5 fw-medium shadow-none transition-base d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-arrow-left"></i> Kembali ke Riwayat
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
