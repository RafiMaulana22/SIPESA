@extends('layouts.landing')

@section('title', 'Layanan Surat - SIPESA')

@section('content')

    <section class="bg-primary text-white py-5 position-relative overflow-hidden">
        <div class="container py-4 text-center position-relative z-1">
            <h1 class="fw-bold display-5 mb-3" style="letter-spacing: -0.02em;">
                Layanan Surat Elektronik
            </h1>
            <p class="fs-5 opacity-90 mx-auto" style="max-width: 620px; font-weight: 300; line-height: 1.5;">
                Informasi ragam jenis administrasi persuratan yang dapat Anda ajukan secara mandiri dan cepat melalui
                platform digital SIPESA.
            </p>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-3">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-medium mb-3">
                        Administrasi Modern
                    </span>
                    <h2 class="fw-bold text-dark section-title mb-4">
                        Pelayanan Administrasi Desa Terpadu
                    </h2>
                    <p class="text-muted mb-4 lh-lg">
                        SIPESA menyediakan infrastruktur pengurusan berkas kependudukan secara online. Warga tidak perlu
                        lagi meluangkan waktu untuk datang berulang kali ke kantor desa hanya untuk melakukan pendaftaran
                        berkas awal.
                    </p>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex gap-3">
                                <div
                                    class="bg-success bg-opacity-10 text-success rounded-3 p-2.5 d-flex align-items-center justify-content-center h-100 mt-1">
                                    <i class="bi bi-shield-check fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Validasi NIK Aman</h6>
                                    <p class="text-muted small m-0 lh-base">Verifikasi kecocokan identitas penduduk
                                        terintegrasi langsung sebelum berkas diproses.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="d-flex gap-3">
                                <div
                                    class="bg-warning bg-opacity-10 text-warning-emphasis rounded-3 p-2.5 d-flex align-items-center justify-content-center h-100 mt-1">
                                    <i class="bi bi-hourglass-split fs-5"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Sistem Antrean FIFO</h6>
                                    <p class="text-muted small m-0 lh-base">Seluruh permohonan masuk diproses adil dan
                                        transparan berdasarkan urutan waktu input warga.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 text-center">
                    <img src="https://placehold.co/500x350"
                        class="img-fluid rounded-4 shadow-lg border border-light card-interactive" alt="Simulasi Layanan">
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light-section border-y">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark section-title">Pilihan Jenis Layanan</h2>
                <p class="text-muted section-subtitle mx-auto" style="max-width: 500px;">
                    Silakan klik tombol pengajuan pada jenis surat yang sesuai dengan kebutuhan kependudukan Anda.
                </p>
            </div>

            <div class="row g-4">
                @php
                    $surats = [
                        ['nama' => 'Surat Keterangan Domisili', 'hari' => '1 Hari Kerja', 'icon' => 'bi-house'],
                        ['nama' => 'Surat Keterangan Usaha', 'hari' => '1 Hari Kerja', 'icon' => 'bi-shop'],
                        ['nama' => 'Surat Keterangan Tidak Mampu', 'hari' => '2 Hari Kerja', 'icon' => 'bi-wallet2'],
                        ['nama' => 'Surat Pengantar SKCK', 'hari' => '1 Hari Kerja', 'icon' => 'bi-shield-check'],
                        [
                            'nama' => 'Surat Keterangan Kelahiran',
                            'hari' => '2 Hari Kerja',
                            'icon' => 'bi-balloon-heart',
                        ],
                        ['nama' => 'Surat Keterangan Kematian', 'hari' => '2 Hari Kerja', 'icon' => 'bi-heartbreak'],
                    ];
                @endphp

                @foreach ($surats as $surat)
                    <div class="col-lg-4 col-md-6">
                        <div class="card card-interactive h-100 border-0 shadow-sm rounded-4 p-3 bg-white">
                            <div class="card-body d-flex flex-column align-items-start">
                                <div class="icon-shape bg-primary bg-opacity-10 text-primary rounded-3 p-3 mb-4">
                                    <i class="bi {{ $surat['icon'] }} fs-2"></i>
                                </div>
                                <h5 class="fw-bold text-dark mb-2">{{ $surat['nama'] }}</h5>
                                <p class="text-muted small mb-4 mt-1">
                                    Durasi penyelesaian berkas estimasi: <span
                                        class="badge bg-secondary-subtle text-dark-emphasis fw-semibold rounded-2 ms-1 px-2 py-1">{{ $surat['hari'] }}</span>
                                </p>
                                <button
                                    class="btn btn-outline-primary w-100 rounded-3 py-2 fw-medium mt-auto transition-base shadow-sm"
                                    data-bs-toggle="modal" data-bs-target="#ajukanSuratModal">
                                    Ajukan Dokumen
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark section-title">Persyaratan Dokumen Umum</h2>
                <p class="text-muted section-subtitle mx-auto" style="max-width: 500px;">
                    Harap siapkan kelengkapan identitas berikut sebelum melangkah ke proses pengisian formulir.
                </p>
            </div>

            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="card border-0 bg-light-section rounded-4 p-4 border border-light shadow-sm">
                        <div class="card-body">
                            <ul class="list-unstyled text-muted m-0">
                                <li class="d-flex align-items-start gap-3 mb-3">
                                    <i class="bi bi-patch-check text-primary fs-5 mt-0.5"></i>
                                    <span class="lh-base text-dark-emphasis">Wajib memiliki Nomor Induk Kependudukan (NIK)
                                        resmi yang valid di database Desa Payudan-Dungdang.</span>
                                </li>
                                <li class="d-flex align-items-start gap-3 mb-3">
                                    <i class="bi bi-patch-check text-primary fs-5 mt-0.5"></i>
                                    <span class="lh-base text-dark-emphasis">Menyiapkan pindaian berkas berkas asli / foto
                                        dokumen Kartu Tanda Penduduk (KTP) pelapor.</span>
                                </li>
                                <li class="d-flex align-items-start gap-3 mb-3">
                                    <i class="bi bi-patch-check text-primary fs-5 mt-0.5"></i>
                                    <span class="lh-base text-dark-emphasis">Menyiapkan pindaian lembar dokumen Kartu
                                        Keluarga (KK) terbaru dari pemohon.</span>
                                </li>
                                <li class="d-flex align-items-start gap-3 mb-3">
                                    <i class="bi bi-patch-check text-primary fs-5 mt-0.5"></i>
                                    <span class="lh-base text-dark-emphasis">Melampirkan dokumen tambahan penunjang khusus
                                        (misal: Surat Pengantar RT/RW untuk jenis layanan tertentu).</span>
                                </li>
                                <li class="d-flex align-items-start gap-3">
                                    <i class="bi bi-patch-check text-primary fs-5 mt-0.5"></i>
                                    <span class="lh-base text-dark-emphasis">Bertanggung jawab penuh atas kebenaran,
                                        keaslian, dan ketepatan entri data isian formulir.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light-section border-top">
        <div class="container py-3">
            <div class="text-center mb-5">
                <h2 class="fw-bold text-dark section-title">Alur Mekanisme Pelayanan</h2>
                <p class="text-muted section-subtitle mx-auto" style="max-width: 500px;">
                    Skema urutan pemrosesan dokumen pengajuan Anda mulai dari awal input hingga selesai diverifikasi.
                </p>
            </div>

            <div class="row g-4 text-center justify-content-center">
                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 bg-white rounded-4 shadow-sm p-2 card-stat">
                        <div class="card-body">
                            <div class="step-number bg-light text-primary border-0 mx-auto mb-3">1</div>
                            <h6 class="fw-bold text-dark mb-2">Validasi NIK</h6>
                            <p class="text-muted small m-0 px-1">Pengecekan integrasi NIK pada pop-up sistem verifikasi
                                mandiri.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 bg-white rounded-4 shadow-sm p-2 card-stat">
                        <div class="card-body">
                            <div class="step-number bg-light text-primary border-0 mx-auto mb-3">2</div>
                            <h6 class="fw-bold text-dark mb-2">Pilih Surat</h6>
                            <p class="text-muted small m-0 px-1">Menentukan lembar kategori surat dinas yang akan
                                dimohonkan.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 bg-white rounded-4 shadow-sm p-2 card-stat">
                        <div class="card-body">
                            <div class="step-number bg-light text-primary border-0 mx-auto mb-3">3</div>
                            <h6 class="fw-bold text-dark mb-2">Upload Berkas</h6>
                            <p class="text-muted small m-0 px-1">Mengunggah kelengkapan bukti dokumen persyaratan digital
                                yang diminta.</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 bg-white rounded-4 shadow-sm p-2 card-stat">
                        <div class="card-body">
                            <div class="step-number bg-light text-primary border-0 mx-auto mb-3">4</div>
                            <h6 class="fw-bold text-dark mb-2">Proses Selesai</h6>
                            <p class="text-muted small m-0 px-1">Operator meninjau berkas antrean dan mencetak dokumen
                                final.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
