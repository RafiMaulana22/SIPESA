@extends('admin.components.template_admin')

@section('content')
    @if (auth()->user()->role == 'operator' || auth()->user()->role == 'admin')
        {{-- ========================= DASHBOARD OPERATOR / ADMIN ========================= --}}

        <!-- HEADER UTAMA -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
            <div>
                <h3 class="fw-bold  mb-1" style="letter-spacing: -0.02em;">
                    Dashboard Operator
                </h3>
                <p class="text-muted small mb-0">
                    Selamat datang kembali, {{ auth()->user()->name }}. Kelola alur pelayanan administrasi surat desa
                    hari ini.
                </p>
            </div>
        </div>

        <!-- SEKSI STATISTIK OPERATOR (STYLE GYMOVE) -->
        <div class="row g-4 mb-4">
            <!-- Pengajuan Menunggu -->
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small d-block mb-1 fw-medium">Pengajuan Menunggu</span>
                            <h2 class="fw-bold  m-0">{{ $menunggu }}</h2>
                            <span class="badge bg-warning bg-opacity-10 text-warning-emphasis mt-2 rounded-2 fw-medium"
                                style="font-size: 0.7rem;">
                                Antrean FIFO
                            </span>
                        </div>
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning-emphasis rounded-4 p-3 d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-hourglass-split fs-4 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sedang Diproses -->
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small d-block mb-1 fw-medium">Sedang Diproses</span>
                            <h2 class="fw-bold  m-0">{{ $diproses }}</h2>
                            <span class="badge bg-info bg-opacity-10 text-info mt-2 rounded-2 fw-medium"
                                style="font-size: 0.7rem;">
                                Tahap Verifikasi
                            </span>
                        </div>
                        <div class="stat-icon bg-info bg-opacity-10 text-info rounded-4 p-3 d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-arrow-repeat fs-4 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Surat Selesai -->
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small d-block mb-1 fw-medium">Surat Selesai</span>
                            <h2 class="fw-bold  m-0">{{ $selesai }}</h2>
                            <span class="badge bg-success bg-opacity-10 text-success mt-2 rounded-2 fw-medium"
                                style="font-size: 0.7rem;">
                                Arsip Digital
                            </span>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 text-success rounded-4 p-3 d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-check-circle fs-4 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Penduduk -->
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small d-block mb-1 fw-medium">Data Penduduk</span>
                            <h2 class="fw-bold  m-0">{{ $penduduk }}</h2>
                            <span class="badge bg-primary bg-opacity-10 text-primary mt-2 rounded-2 fw-medium"
                                style="font-size: 0.7rem;">
                                Warga Terdaftar
                            </span>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded-4 p-3 d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-people fs-4 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- DETAIL KONTEN UTAMA -->
        <div class="row g-4 mt-2">
            <!-- Tabel Pengajuan Terbaru -->
            <div class="col-lg-8">
                <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white p-4 border-0">
                        <h5 class="fw-bold  m-0" style="letter-spacing: -0.01em;">
                            Pengajuan Surat Terbaru
                        </h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 custom-admin-table">
                            <thead>
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>Nama Penduduk</th>
                                    <th>Jenis Surat</th>
                                    <th class="pe-4">Status Alur</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengajuanTerbaru as $item)
                                    <tr>
                                        <td class="ps-4 text-muted fw-medium">{{ $loop->iteration }}</td>
                                        <td class="fw-semibold ">{{ $item->penduduk->nama }}</td>
                                        <td class="text-secondary fw-medium">{{ $item->jenisSurat->nama_surat }}</td>
                                        <td class="pe-4">
                                            @if ($item->status == 'menunggu')
                                                <span
                                                    class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1.5 rounded-2 fw-medium">Menunggu</span>
                                            @elseif($item->status == 'diproses')
                                                <span
                                                    class="badge bg-info-subtle text-info border border-info-subtle px-2.5 py-1.5 rounded-2 fw-medium">Diproses</span>
                                            @elseif($item->status == 'selesai')
                                                <span
                                                    class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">Selesai</span>
                                            @else
                                                <span
                                                    class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4 small">Belum ada antrean
                                            permohonan surat masuk masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Menu Akses Cepat Samping -->
            <div class="col-lg-4">
                <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white p-4 border-0 pb-2">
                        <h5 class="fw-bold  m-0" style="letter-spacing: -0.01em;">
                            Menu Akses Kerja
                        </h5>
                    </div>
                    <div class="list-group list-group-flush p-2">
                        <a href="{{ route('pengajuan-surat.index') }}"
                            class="list-group-item list-group-item-action border-0 rounded-3 d-flex align-items-center gap-2.5 py-3 px-3 mb-1  fw-medium small text-dark">
                            <i class="bi bi-envelope-paper text-primary fs-5"></i> Kelola Antrean Surat
                        </a>
                        <a href="{{ route('arsip-digital.index') }}"
                            class="list-group-item list-group-item-action border-0 rounded-3 d-flex align-items-center gap-2.5 py-3 px-3 mb-1  fw-medium small text-dark">
                            <i class="bi bi-archive text-success fs-5"></i> Arsip Digital Surat
                        </a>
                        <a href="{{ route('penduduk.index') }}"
                            class="list-group-item list-group-item-action border-0 rounded-3 d-flex align-items-center gap-2.5 py-3 px-3  fw-medium small text-dark">
                            <i class="bi bi-folder-symlink text-info fs-5"></i> Master Basis Penduduk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- ========================= DASHBOARD KEPALA DESA ========================= --}}

        <!-- HEADER UTAMA KADES -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
            <div>
                <h3 class="fw-bold  mb-1" style="letter-spacing: -0.02em;">
                    Dashboard Kepala Desa
                </h3>
                <p class="text-muted small mb-0">
                    Sistem Monitoring dan Evaluasi Kinerja Pelayanan Administrasi Surat Desa Payudan-Dungdang.
                </p>
            </div>
        </div>

        <!-- SEKSI STATISTIK KADES -->
        <div class="row g-4 mb-4">
            <!-- Total Surat Masuk -->
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small d-block mb-1 fw-medium">Total Dokumen Surat</span>
                            <h2 class="fw-bold  m-0">{{ $totalSurat }}</h2>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded-4 p-3 d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-file-earmark-text fs-4 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Surat Selesai -->
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small d-block mb-1 fw-medium">Surat Selesai Cetak</span>
                            <h2 class="fw-bold  m-0">{{ $selesai }}</h2>
                        </div>
                        <div class="stat-icon bg-success bg-opacity-10 text-success rounded-4 p-3 d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-patch-check fs-4 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Penduduk -->
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small d-block mb-1 fw-medium">Total Warga Desa</span>
                            <h2 class="fw-bold  m-0">{{ $penduduk }}</h2>
                        </div>
                        <div class="stat-icon bg-info bg-opacity-10 text-info rounded-4 p-3 d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-people fs-4 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Berkas Diarsipkan -->
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small d-block mb-1 fw-medium">Berkas Diarsipkan</span>
                            <h2 class="fw-bold  m-0">{{ $arsip ?? $selesai }}</h2>
                        </div>
                        <div class="stat-icon bg-secondary bg-opacity-10 text-secondary rounded-4 p-3 d-flex align-items-center justify-content-center"
                            style="width: 52px; height: 52px;">
                            <i class="bi bi-hdd-rack fs-4 text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TABEL RINGKASAN MONITORING KADES -->
        <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden mt-4">
            <div class="card-header bg-white p-4 border-0">
                <h5 class="fw-bold  m-0" style="letter-spacing: -0.01em;">
                    Ringkasan Transaksi Pelayanan Surat
                </h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 custom-admin-table">
                    <thead>
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Nama Penduduk / Pemohon</th>
                            <th>Kategori Surat Kualifikasi</th>
                            <th>Tanggal Pengajuan</th>
                            <th class="pe-4">Status Validitas Berkas</th>
                        </tr>
                </table>
                <table class="table table-hover align-middle mb-0 custom-admin-table">
                    <tbody>
                        @forelse ($pengajuanTerbaru as $item)
                            <tr>
                                <td class="ps-4 text-muted fw-medium">{{ $loop->iteration }}</td>
                                <td class="fw-bold ">{{ $item->penduduk->nama }}</td>
                                <td class="fw-medium text-secondary">{{ $item->jenisSurat->nama_surat }}</td>
                                <td class="text-muted small">{{ $item->tanggal_pengajuan }}</td>
                                <td class="pe-4">
                                    @if ($item->status == 'selesai')
                                        <span
                                            class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">Selesai</span>
                                    @elseif($item->status == 'diproses')
                                        <span
                                            class="badge bg-info-subtle text-info border border-info-subtle px-2.5 py-1.5 rounded-2 fw-medium">Diproses</span>
                                    @elseif($item->status == 'menunggu')
                                        <span
                                            class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1.5 rounded-2 fw-medium">Menunggu</span>
                                    @else
                                        <span
                                            class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4 small">Belum ada rekam transaksi
                                    log pelayanan masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    @endif
@endsection
