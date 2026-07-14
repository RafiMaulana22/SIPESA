@extends('admin.components.template_admin')

@section('content')
    <!-- HEADER UTAMA & TOMBOL KEMBALI -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold  mb-1" style="letter-spacing: -0.02em;">
                Detail Pengajuan Surat
            </h3>
            <p class="text-muted small mb-0">
                Informasi lengkap data rekam pengajuan berkas layanan persuratan warga.
            </p>
        </div>
        <div>
            <a href="{{ route('pengajuan-surat.index') }}"
                class="btn btn-light border text-secondary px-4 rounded-3 fw-medium d-inline-flex align-items-center gap-2 shadow-none transition-base">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row g-4">

        <!-- SISI KIRI: INFORMASI PENGAJUAN -->
        <div class="col-xl-6">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white p-4 border-0 pb-0">
                    <h5 class="card-title fw-bold  m-0" style="letter-spacing: -0.01em;">
                        Informasi Pengajuan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle m-0" style="font-size: 0.95rem;">
                            <tbody>
                                <tr>
                                    <td class="text-muted fw-medium py-2.5" style="width: 40%;">Kode Pengajuan</td>
                                    <td class=" fw-bold py-2.5">: {{ $pengajuan->kode_pengajuan }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-medium py-2.5">Nomor Antrean FIFO</td>
                                    <td class="py-2.5">:
                                        <span
                                            class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10 px-2.5 py-1.5 rounded-2 fw-bold">
                                            #{{ sprintf('%03d', $pengajuan->nomor_antrian) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-medium py-2.5">Tanggal Pengajuan</td>
                                    <td class=" fw-medium py-2.5">:
                                        {{ $pengajuan->tanggal_pengajuan->translatedFormat('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-medium py-2.5">Jenis Dokumen Surat</td>
                                    <td class=" fw-medium py-2.5">: {{ $pengajuan->jenisSurat->nama_surat }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-medium py-2.5">Kategori Klasifikasi</td>
                                    <td class=" fw-medium py-2.5">:
                                        {{ $pengajuan->jenisSurat->kategoriSurat->nama_kategori }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-medium py-2.5">Status Pengajuan</td>
                                    <td class="py-2.5">:
                                        @if ($pengajuan->status == 'menunggu')
                                            <span
                                                class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1.5 rounded-2 fw-medium">Menunggu</span>
                                        @elseif($pengajuan->status == 'diproses')
                                            <span
                                                class="badge bg-info-subtle text-info border border-info-subtle px-2.5 py-1.5 rounded-2 fw-medium">Diproses</span>
                                        @elseif($pengajuan->status == 'selesai')
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">Selesai</span>
                                        @else
                                            <span
                                                class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- SISI KANAN: DATA PEMOHON -->
        <div class="col-xl-6">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white p-4 border-0 pb-0">
                    <h5 class="card-title fw-bold  m-0" style="letter-spacing: -0.01em;">
                        Data Pemohon (Warga)
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle m-0" style="font-size: 0.95rem;">
                            <tbody>
                                <tr>
                                    <td class="text-muted fw-medium py-2.5" style="width: 40%;">Nomor NIK</td>
                                    <td class=" fw-bold py-2.5">: {{ $pengajuan->penduduk->nik }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-medium py-2.5">Nama Lengkap Pemohon</td>
                                    <td class=" fw-semibold py-2.5">: {{ $pengajuan->penduduk->nama }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-medium py-2.5">Tempat, Tanggal Lahir</td>
                                    <td class=" py-2.5">: {{ $pengajuan->penduduk->tempat_lahir }},
                                        {{ \Carbon\Carbon::parse($pengajuan->penduduk->tanggal_lahir)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-medium py-2.5">Jenis Kelamin</td>
                                    <td class=" py-2.5">:
                                        {{ $pengajuan->penduduk->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-medium py-2.5">Pekerjaan Utama</td>
                                    <td class=" py-2.5">: {{ $pengajuan->penduduk->pekerjaan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-medium py-2.5">Alamat Dusun Domisili</td>
                                    <td class=" py-2.5">: {{ $pengajuan->penduduk->alamat }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEKSI BAWAH: TABEL LAMPIRAN -->
        <div class="col-12">
            <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white p-4 border-0 pb-0">
                    <h5 class="card-title fw-bold  m-0" style="letter-spacing: -0.01em;">
                        Berkas Lampiran Persyaratan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3 py-3 text-muted fw-semibold" width="8%">No</th>
                                    <th class="py-3 text-muted fw-semibold">Nama Dokumen Persyaratan</th>
                                    <th class="py-3 text-muted fw-semibold" width="20%">File Digital</th>
                                    <th class="py-3 text-muted fw-semibold" width="20%">Status Verifikasi</th>
                                    <th class="pe-3 py-3 text-muted fw-semibold" width="25%">Catatan Operator</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuan->lampiran as $lampiran)
                                    <tr>
                                        <td class="ps-3 text-muted fw-medium">{{ $loop->iteration }}</td>
                                        <td class="fw-semibold ">
                                            {{ $lampiran->persyaratan->nama_persyaratan }}</td>
                                        <td>
                                            @if ($lampiran->file_path)
                                                <a href="{{ asset('storage/' . $lampiran->file_path) }}" target="_blank"
                                                    class="btn btn-sm btn-light border text-primary px-3 rounded-2 fw-medium shadow-none">
                                                    <i class="bi bi-file-earmark-text me-1"></i> Lihat File
                                                </a>
                                            @else
                                                <span
                                                    class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">Tidak
                                                    Ditemukan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($lampiran->status == 'valid')
                                                <span
                                                    class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">Valid</span>
                                            @elseif($lampiran->status == 'ditolak')
                                                <span
                                                    class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">Ditolak</span>
                                            @else
                                                <span
                                                    class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1.5 rounded-2 fw-medium">Belum
                                                    Dicek</span>
                                            @endif
                                        </td>
                                        <td class="pe-3 text-secondary italic small">
                                            {{ $lampiran->catatan ?? '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEKSI CATATAN OPERATOR -->
        <div class="col-12">
            <div class="card bg-white border-0 shadow-sm rounded-4">
                <div class="card-header bg-white p-4 border-0 pb-0">
                    <h5 class="card-title fw-bold  m-0" style="letter-spacing: -0.01em;">
                        Catatan Resmi Operator
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="alert alert-custom p-3 m-0 rounded-3 -emphasis lh-base"
                        style="font-size: 0.925rem; background-color: #f8fafc; border: 1px solid #e2e8f0;">
                        <i class="bi bi-chat-left-text text-primary me-2"></i>
                        {{ $pengajuan->catatan_admin ?? 'Tidak ada catatan peninjauan dari operator desa untuk pengajuan berkas ini.' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- ACTION ACTION BUTTONS -->
        <div class="col-12 mb-3">
            <div class="d-flex flex-wrap gap-2 justify-content-end">
                @if ($pengajuan->status == 'selesai')
                    <a href="{{ route('pengajuan-surat.preview', $pengajuan->id) }}"
                        class="btn btn-success rounded-3 px-4 py-2.5 fw-medium shadow-none transition-base text-white d-inline-flex align-items-center gap-2">
                        <i class="bi bi-download"></i> Unduh Berkas Surat
                    </a>
                @endif
                <a href="{{ route('pengajuan-surat.index') }}"
                    class="btn btn-secondary bg-slate-600 border-0 rounded-3 px-4 py-2.5 fw-medium shadow-none transition-base text-white">
                    Kembali ke Tabel
                </a>
            </div>
        </div>

    </div>
@endsection
