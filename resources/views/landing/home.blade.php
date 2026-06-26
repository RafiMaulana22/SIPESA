@extends('layouts.landing')

@section('title', 'SIPESA - Sistem Pelayanan Surat Desa')

@section('content')
    <section class="hero-section py-5 position-relative overflow-hidden">
        <div class="container">
            <div class="row align-items-center min-vh-75 g-5">
                <div class="col-lg-6">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-medium mb-3">
                        <i class="bi bi-cpu me-1"></i> Pelayanan Surat Digital Desa
                    </span>

                    <h1 class="fw-bold display-5 text-dark mb-3" style="letter-spacing: -0.02em; line-height: 1.2;">
                        Sistem Pelayanan Surat Desa <span class="text-primary">Payudan-Dungdang</span>
                    </h1>

                    <p class="text-muted fs-5 mb-4" style="line-height: 1.6;">
                        Ajukan surat secara online dengan validasi NIK yang aman, antrian sistem FIFO yang transparan, serta
                        arsip digital terintegrasi untuk efisiensi layanan mandiri.
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <button
                            class="btn btn-primary btn-lg rounded-pill px-4 py-3 text-white fw-medium shadow-sm transition-base"
                            data-bs-toggle="modal" data-bs-target="#ajukanSuratModal">
                            <i class="bi bi-file-earmark-plus-fill me-2"></i> Ajukan Surat
                        </button>

                        <button
                            class="btn btn-outline-primary btn-lg rounded-pill px-4 py-3 fw-medium shadow-sm transition-base"
                            data-bs-toggle="modal" data-bs-target="#cekStatusModal">
                            <i class="bi bi-search me-2"></i> Cek Status
                        </button>
                    </div>
                </div>

                <div class="col-lg-6 text-center">
                    <div class="position-relative d-inline-block">
                        <img src="https://placehold.co/600x450" class="img-fluid rounded-4 shadow-lg border border-light"
                            alt="Hero SIPESA">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light-section border-y">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-lg-3">
                    <div class="card card-stat h-100 border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 text-center">
                            <div class="stat-icon bg-primary bg-opacity-10 text-primary mx-auto mb-3">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <h2 class="fw-bold text-dark mb-1">5.240</h2>
                            <p class="text-muted small mb-0">Jumlah Penduduk</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card card-stat h-100 border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 text-center">
                            <div class="stat-icon bg-success bg-opacity-10 text-success mx-auto mb-3">
                                <i class="bi bi-file-earmark-text-fill"></i>
                            </div>
                            <h2 class="fw-bold text-dark mb-1">12</h2>
                            <p class="text-muted small mb-0">Jenis Layanan Surat</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card card-stat h-100 border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 text-center">
                            <div class="stat-icon bg-warning bg-opacity-10 text-warning-emphasis mx-auto mb-3">
                                <i class="bi bi-hourglass-split"></i>
                            </div>
                            <h2 class="fw-bold text-dark mb-1">245</h2>
                            <p class="text-muted small mb-0">Surat Diproses</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div class="card card-stat h-100 border-0 shadow-sm rounded-4">
                        <div class="card-body p-4 text-center">
                            <div class="stat-icon bg-danger bg-opacity-10 text-danger mx-auto mb-3">
                                <i class="bi bi-check-circle-fill"></i>
                            </div>
                            <h2 class="fw-bold text-dark mb-1">1.235</h2>
                            <p class="text-muted small mb-0">Surat Selesai</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-3">
            <div class="text-center max-w-xl mx-auto mb-5">
                <h2 class="fw-bold text-dark section-title">Layanan Surat Elektronik</h2>
                <p class="text-muted section-subtitle mx-auto" style="max-width: 500px;">
                    Pilih jenis berkas surat yang ingin Anda ajukan secara mandiri melalui platform digital.
                </p>
            </div>

            <div class="row g-4">
                @foreach (['Surat Keterangan Domisili', 'Surat Keterangan Usaha', 'Surat Keterangan Tidak Mampu', 'Surat Pengantar SKCK', 'Surat Keterangan Kelahiran', 'Surat Keterangan Kematian'] as $surat)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-interactive h-100 border-0 shadow-sm rounded-4 p-3">
                            <div class="card-body d-flex flex-column align-items-start">
                                <div class="icon-shape bg-primary bg-opacity-10 text-primary rounded-3 p-3 mb-4">
                                    <i class="bi bi-file-earmark-text fs-3"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">{{ $surat }}</h5>
                                <p class="text-muted small mb-4" style="line-height: 1.5;">
                                    Pengurusan permohonan dokumen administrasi secara digital, transparan, dan dapat
                                    dipantau berkala.
                                </p>
                                <button class="btn btn-link text-primary p-0 fw-semibold mt-auto text-decoration-none small"
                                    data-bs-toggle="modal" data-bs-target="#ajukanSuratModal">
                                    Ajukan Sekarang <i class="bi bi-arrow-right ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5 bg-light-section border-y">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark section-title">Alur Mudah Pengajuan Surat</h2>
                <p class="text-muted section-subtitle mx-auto" style="max-width: 500px;">
                    Ikuti empat langkah ringkas untuk menyelesaikan kebutuhan administrasi kependudukan Anda.
                </p>
            </div>

            <div class="row g-4 text-center justify-content-center">
                <div class="col-sm-6 col-lg-3">
                    <div class="p-3">
                        <div class="step-number bg-white text-primary shadow-sm mx-auto mb-3">1</div>
                        <h6 class="fw-bold text-dark mb-2">Input NIK</h6>
                        <p class="text-muted small px-lg-3">Masukkan nomor kartu penduduk resmi untuk verifikasi data awal.
                        </p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="p-3">
                        <div class="step-number bg-white text-primary shadow-sm mx-auto mb-3">2</div>
                        <h6 class="fw-bold text-dark mb-2">Validasi Data</h6>
                        <p class="text-muted small px-lg-3">Sistem mencocokkan data Anda dengan database kependudukan desa.
                        </p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="p-3">
                        <div class="step-number bg-white text-primary shadow-sm mx-auto mb-3">3</div>
                        <h6 class="fw-bold text-dark mb-2">Ajukan Berkas</h6>
                        <p class="text-muted small px-lg-3">Isi formulir kelengkapan dan unggah berkas persyaratan wajib.
                        </p>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="p-3">
                        <div class="step-number bg-white text-primary shadow-sm mx-auto mb-3">4</div>
                        <h6 class="fw-bold text-dark mb-2">Proses FIFO</h6>
                        <p class="text-muted small px-lg-3">Permohonan diverifikasi oleh operator desa sesuai urutan
                            antrean.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark section-title">Kabar & Berita Desa</h2>
                <p class="text-muted section-subtitle mx-auto" style="max-width: 500px;">
                    Simak informasi terhangat seputar kegiatan publik dan program kerja Desa Payudan-Dungdang.
                </p>
            </div>

            <div class="row g-4">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden card-interactive">
                            <div class="position-relative overflow-hidden" style="height: 220px;">
                                <img src="https://placehold.co/600x350" class="w-100 h-100 object-fit-cover"
                                    alt="Gambar Berita">
                            </div>
                            <div class="card-body p-4">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-calendar4-event text-primary small"></i>
                                    <small class="text-muted">24 Juni 2026</small>
                                </div>
                                <h5 class="fw-bold text-dark line-clamp-2 mb-2">
                                    <a href="#" class="text-dark text-decoration-none link-primary-hover">Judul
                                        Publikasi Agenda Berita Desa {{ $i }}</a>
                                </h5>
                                <p class="text-muted small mb-0" style="line-height: 1.5;">
                                    Penjelasan ringkas poin berita teraktual yang disajikan secara akurat dan informatif
                                    kepada warga desa...
                                </p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

@endsection
