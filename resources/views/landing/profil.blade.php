@extends('layouts.landing')

@section('title', 'Profil Desa - SIPESA')

@section('content')

    <section class="bg-primary text-white py-5 position-relative overflow-hidden">
        <div class="container py-4 text-center position-relative z-1">
            <h1 class="fw-bold display-5 mb-3" style="letter-spacing: -0.02em;">
                Profil Desa Payudan-Dungdang
            </h1>
            <p class="fs-5 opacity-90 mx-auto" style="max-width: 600px; font-weight: 300; line-height: 1.5;">
                Mengenal lebih dekat struktur wilayah, visi misi, dan tata pamong Desa Payudan-Dungdang, Kecamatan
                Guluk-Guluk, Kabupaten Sumenep.
            </p>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-3">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="https://placehold.co/700x450"
                            class="img-fluid rounded-4 shadow-lg border border-light card-interactive" alt="Kawasan Desa">
                    </div>
                </div>

                <div class="col-lg-6">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-medium mb-3">
                        Sekilas Pandang
                    </span>
                    <h2 class="fw-bold text-dark section-title mb-4">
                        Tentang Desa
                    </h2>
                    <p class="text-muted mb-3" style="line-height: 1.7;">
                        Desa Payudan-Dungdang merupakan salah satu rumpun wilayah administrasi di Kabupaten Sumenep yang
                        terus berupaya mentransformasikan kualitas pelayanan publik kepada masyarakat melalui implementasi
                        pemanfaatan teknologi informasi terbarukan.
                    </p>
                    <p class="text-muted mb-0" style="line-height: 1.7;">
                        Dengan hadirnya platform SIPESA, ekosistem administrasi desa dialihkan menuju sistem digital
                        terpadu. Masyarakat kini dapat mengurus dokumen permohonan surat secara mandiri tanpa kendala jarak
                        dan waktu.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light-section border-y">
        <div class="container py-3">
            <div class="text-center max-w-xl mx-auto mb-4">
                <h2 class="fw-bold text-dark section-title">Sejarah Singkat</h2>
            </div>
            <div class="card border-0 shadow-sm rounded-4 p-4 p-lg-5 max-w-2xl mx-auto bg-white">
                <p class="text-muted m-0 text-center lh-lg" style="font-size: 1.05rem;">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore nostrum vero omnis asperiores,
                    officia, accusamus delectus quidem unde voluptate doloremque. Kebudayaan luhur gotong royong dan nilai
                    historis peninggalan leluhur senantiasa menjadi fondasi dasar peradaban masyarakat Payudan-Dungdang
                    dalam membangun desa mandiri yang sejahtera dari generasi ke generasi.
                </p>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-3">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card h-100 border-0 bg-light-section rounded-4 p-4 border border-light">
                        <div class="card-body">
                            <div
                                class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-3 p-3 mb-4">
                                <i class="bi bi-eye-fill fs-3"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-3" style="letter-spacing: -0.01em;">Visi Desa</h3>
                            <p class="text-muted fs-5 lh-base m-0">
                                "Menjadi desa yang maju, mandiri, transparan, serta memberikan pelayanan publik yang
                                berkualitas."
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card h-100 border-0 bg-light-section rounded-4 p-4 border border-light">
                        <div class="card-body">
                            <div
                                class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-3 p-3 mb-4">
                                <i class="bi bi-shield-check fs-3"></i>
                            </div>
                            <h3 class="fw-bold text-dark mb-3" style="letter-spacing: -0.01em;">Misi Kerja</h3>
                            <ul class="list-unstyled text-muted m-0">
                                <li class="d-flex align-items-start gap-3 mb-3">
                                    <i class="bi bi-check2-circle text-success fs-5 mt-0.5"></i>
                                    <span class="lh-base">Mentransformasikan tata kelola dan efisiensi mutu pelayanan publik
                                        bagi seluruh lapisan elemen masyarakat.</span>
                                </li>
                                <li class="d-flex align-items-start gap-3 mb-3">
                                    <i class="bi bi-check2-circle text-success fs-5 mt-0.5"></i>
                                    <span class="lh-base">Mengembangkan dan mengintegrasikan infrastruktur teknologi
                                        informasi berbasis desa digital.</span>
                                </li>
                                <li class="d-flex align-items-start gap-3 mb-3">
                                    <i class="bi bi-check2-circle text-success fs-5 mt-0.5"></i>
                                    <span class="lh-base">Membina dan menaikkan standar kapabilitas kualitas SDM internal
                                        aparatur maupun warga masyarakat.</span>
                                </li>
                                <li class="d-flex align-items-start gap-3">
                                    <i class="bi bi-check2-circle text-success fs-5 mt-0.5"></i>
                                    <span class="lh-base">Mendorong percepatan pembangunan daerah berkepanjangan yang
                                        merata, adil, aman, dan transparan.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light-section border-y">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark section-title">Struktur Organisasi</h2>
                <p class="text-muted section-subtitle mx-auto" style="max-width: 500px;">
                    Bagan jajaran struktural Aparatur Pemerintah Desa Payudan-Dungdang.
                </p>
            </div>

            <div class="text-center">
                <div class="card border-0 p-3 bg-white shadow-sm rounded-4 d-inline-block max-w-full">
                    <img src="https://placehold.co/1000x600" class="img-fluid rounded-3" alt="Bagan Organisasi Desa">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark section-title">Statistik Demografi</h2>
                <p class="text-muted section-subtitle mx-auto" style="max-width: 500px;">
                    Data persebaran dan cakupan wilayah administrasi kemasyarakatan.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-6 col-lg-3">
                    <div
                        class="card h-100 border-0 bg-light-section rounded-4 border border-light text-center p-3 card-stat">
                        <div class="card-body">
                            <h2 class="text-primary fw-bold display-6 mb-1">5.240</h2>
                            <p class="text-muted small m-0 fw-medium">Total Penduduk</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div
                        class="card h-100 border-0 bg-light-section rounded-4 border border-light text-center p-3 card-stat">
                        <div class="card-body">
                            <h2 class="text-success fw-bold display-6 mb-1">4</h2>
                            <p class="text-muted small m-0 fw-medium">Wilayah Dusun</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div
                        class="card h-100 border-0 bg-light-section rounded-4 border border-light text-center p-3 card-stat">
                        <div class="card-body">
                            <h2 class="text-warning fw-bold display-6 mb-1">12</h2>
                            <p class="text-muted small m-0 fw-medium">Lingkungan RT</p>
                        </div>
                    </div>
                </div>

                <div class="col-6 col-lg-3">
                    <div
                        class="card h-100 border-0 bg-light-section rounded-4 border border-light text-center p-3 card-stat">
                        <div class="card-body">
                            <h2 class="text-danger fw-bold display-6 mb-1">6</h2>
                            <p class="text-muted small m-0 fw-medium">Lingkungan RW</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light-section border-top">
        <div class="container py-3">
            <div class="text-center mb-4">
                <h2 class="fw-bold text-dark section-title">Lokasi Pemetaan Geografis</h2>
            </div>

            <div class="ratio ratio-21x9 rounded-4 overflow-hidden shadow-sm border border-light bg-white p-2">
                <iframe src="https://www.google.com/maps/embed?pb=" class="rounded-3" loading="lazy"
                    title="Peta Desa Payudan-Dungdang"></iframe>
            </div>
        </div>
    </section>

@endsection
