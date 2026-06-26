@extends('layouts.landing')

@section('title', 'Berita Desa - SIPESA')

@section('content')

    <!-- HERO BANNER -->
    <section class="bg-primary text-white py-5 position-relative overflow-hidden">
        <div class="container py-4 text-center position-relative z-1">
            <h1 class="fw-bold display-5 mb-3" style="letter-spacing: -0.02em;">
                Berita Desa & Pengumuman
            </h1>
            <p class="fs-5 opacity-90 mx-auto" style="max-width: 620px; font-weight: 300; line-height: 1.5;">
                Informasi teraktual mengenai kegiatan kemasyarakatan, rilis kebijakan pemerintah, dan kabar publik Desa
                Payudan-Dungdang.
            </p>
        </div>
    </section>

    <!-- BERITA UTAMA -->
    <section class="py-5 bg-white">
        <div class="container py-3">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="https://placehold.co/800x500"
                            class="img-fluid rounded-4 shadow-lg border border-light card-interactive" alt="Berita Utama">
                    </div>
                </div>

                <div class="col-lg-6">
                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-medium mb-3">
                        <i class="bi bi-pin-angle-fill me-1"></i> Sorotan Utama
                    </span>
                    <h2 class="fw-bold text-dark section-title mb-3" style="line-height: 1.3;">
                        Peluncuran SIPESA Sebagai Layanan Digital Terpadu Desa
                    </h2>
                    <p class="text-muted mb-4 lh-lg">
                        Pemerintah Desa Payudan-Dungdang resmi mengimplementasikan Sistem Pelayanan Surat Desa (SIPESA).
                        Platform ini hadir guna memangkas birokrasi, mengoptimalkan transparansi antrean FIFO, dan
                        mempermudah warga mengurus dokumen administrasi kependudukan dari mana saja.
                    </p>
                    <button class="btn btn-primary rounded-3 px-4 py-2.5 fw-medium shadow-sm transition-base">
                        Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- SEARCH BAR -->
    <section class="py-4 bg-light-section border-y">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="input-group search-box-modern shadow-sm">
                        <span class="input-group-text bg-white border-end-0 ps-3">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 py-2.5 shadow-none"
                            placeholder="Masukkan kata kunci judul berita...">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- LIST ARTIKEL BERITA -->
    <section class="py-5 bg-white">
        <div class="container py-2">
            <div class="row g-4">
                @php
                    $beritas = [
                        [
                            'judul' => 'Musyawarah Perencanaan Desa Tahun 2026',
                            'kategori' => 'Pemerintahan',
                            'tanggal' => '24 Juni 2026',
                        ],
                        [
                            'judul' => 'Optimalisasi Pelayanan Surat Kini Jauh Lebih Cepat',
                            'kategori' => 'Pelayanan',
                            'tanggal' => '20 Juni 2026',
                        ],
                        [
                            'judul' => 'Agenda Kerja Bakti Masal Membersihkan Lingkungan Dusun',
                            'kategori' => 'Kegiatan',
                            'tanggal' => '18 Juni 2026',
                        ],
                        [
                            'judul' => 'Penyaluran Program Bantuan Sosial Tahap Ke-II',
                            'kategori' => 'Sosial',
                            'tanggal' => '15 Juni 2026',
                        ],
                        [
                            'judul' => 'Persiapan Rangkaian Perlombaan Kemerdekaan Desa',
                            'kategori' => 'Event',
                            'tanggal' => '12 Juni 2026',
                        ],
                        [
                            'judul' => 'Pelaksanaan Kegiatan Rutin Posyandu Balita',
                            'kategori' => 'Kesehatan',
                            'tanggal' => '10 Juni 2026',
                        ],
                    ];
                @endphp

                @foreach ($beritas as $berita)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-interactive h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                            <div class="position-relative overflow-hidden" style="height: 200px;">
                                <img src="https://placehold.co/600x350" class="w-100 h-100 object-fit-cover"
                                    alt="Cover Berita">
                            </div>

                            <div class="card-body p-4">
                                <span
                                    class="badge bg-primary bg-opacity-10 text-primary px-2.5 py-1.5 rounded-2 fw-medium mb-3"
                                    style="font-size: 0.75rem;">
                                    {{ $berita['kategori'] }}
                                </span>
                                <h5 class="fw-bold text-dark line-clamp-2 mb-2"
                                    style="font-size: 1.15rem; line-height: 1.4;">
                                    {{ $berita['judul'] }}
                                </h5>
                                <p class="text-muted small m-0 lh-base">
                                    Rangkuman deskripsi singkat rilis berita teraktual yang disajikan secara informatif dan
                                    lugas bagi segenap masyarakat luas...
                                </p>
                            </div>

                            <div class="card-footer bg-white border-0 px-4 pb-4 pt-0">
                                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                                    <small class="text-muted d-flex align-items-center gap-1.5">
                                        <i class="bi bi-calendar4-event text-primary"></i>
                                        {{ $berita['tanggal'] }}
                                    </small>
                                    <a href="#"
                                        class="text-decoration-none small fw-semibold link-primary-hover d-flex align-items-center gap-1">
                                        Selengkapnya <i class="bi bi-chevron-right style-icon-small"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PAGINATION NAVIGATION -->
    <section class="pb-5 bg-white">
        <div class="container">
            <nav aria-label="Navigasi Halaman Berita">
                <ul class="pagination pagination-modern justify-content-center gap-1.5 m-0">
                    <li class="page-item disabled">
                        <a class="page-link rounded-3 px-3 py-2" href="#" tabindex="-1" aria-disabled="true">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link rounded-3 px-3.5 py-2" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link rounded-3 px-3.5 py-2" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link rounded-3 px-3.5 py-2" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link rounded-3 px-3 py-2" href="#">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

@endsection
