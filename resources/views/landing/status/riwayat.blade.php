@extends('layouts.landing')

@section('title', 'Riwayat Pengajuan Surat - SIPESA')

@section('content')
    <section class="py-5 bg-light-section border-bottom">
        <div class="container">

            <!-- HEADER UTAMA & TOMBOL KEMBALI -->
            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-medium mb-2">
                                <i class="bi bi-clock-history"></i> Pelacakan Dokumen
                            </span>
                            <h2 class="fw-bold text-dark section-title m-0">Riwayat Pengajuan Surat</h2>
                            <p class="text-muted small mt-1 mb-0">
                                Berikut adalah rekam jejak berkas permohonan pelayanan Anda yang terdaftar di sistem.
                            </p>
                        </div>
                        <a href="{{ route('landing.home') }}"
                            class="btn btn-light border text-secondary px-4 rounded-3 fw-medium d-inline-flex align-items-center gap-2 shadow-none transition-base">
                            <i class="bi bi-arrow-left"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>

            <!-- KARTU 1: INFORMASI DATA PENDUDUK -->
            <div class="card bg-white border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white p-4 border-0 pb-0">
                    <h5 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2" style="letter-spacing: -0.01em;">
                        <i class="bi bi-person-badge text-primary"></i> Data Kependudukan Pemohon
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-3">
                            <label class="text-muted small d-block mb-1 fw-medium">Nama Lengkap</label>
                            <span class="text-dark fw-bold d-block">{{ $penduduk->nama }}</span>
                        </div>

                        <div class="col-md-6 col-lg-3">
                            <label class="text-muted small d-block mb-1 fw-medium">Nomor NIK (KTP)</label>
                            <span class="text-dark fw-bold font-monospace d-block"
                                style="letter-spacing: 0.02em;">{{ $penduduk->nik }}</span>
                        </div>

                        <div class="col-sm-6 col-lg-2">
                            <label class="text-muted small d-block mb-1 fw-medium">Wilayah RT / RW</label>
                            <span class="text-dark fw-semibold d-block">RT {{ sprintf('%02d', $penduduk->rt) }} / RW
                                {{ sprintf('%02d', $penduduk->rw) }}</span>
                        </div>

                        <div class="col-sm-6 col-lg-4">
                            <label class="text-muted small d-block mb-1 fw-medium">Alamat Rumah</label>
                            <span class="text-secondary small d-block">{{ $penduduk->alamat }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KARTU 2: TABEL DAFTAR RIWAYAT SURAT -->
            <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white p-4 border-0 pb-0">
                    <h5 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2" style="letter-spacing: -0.01em;">
                        <i class="bi bi-collection text-primary"></i> Daftar Berkas Permohonan Surat
                    </h5>
                </div>
                <div class="card-body p-4">

                    @if ($pengajuans->count())
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0 custom-admin-table w-100"
                                style="font-size: 0.9rem;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3 py-3 text-muted fw-semibold" width="6%">No</th>
                                        <th class="py-3 text-muted fw-semibold">Kode Pengajuan</th>
                                        <th class="py-3 text-muted fw-semibold">Jenis Surat</th>
                                        <th class="py-3 text-muted fw-semibold">Tanggal Pengajuan</th>
                                        <th class="py-3 text-muted fw-semibold" width="18%">Status Berkas</th>
                                        <th class="pe-3 py-3 text-end text-muted fw-semibold" width="15%">Aksi Tindakan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pengajuans as $item)
                                        <tr>
                                            <td class="ps-3 text-muted fw-medium">{{ $loop->iteration }}</td>
                                            <td>
                                                <span
                                                    class="text-dark fw-bold font-monospace">{{ $item->create_kode ?? $item->kode_pengajuan }}</span>
                                            </td>
                                            <td class="fw-semibold text-dark">
                                                {{ $item->jenisSurat->nama_surat }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $item->tanggal_pengajuan->translatedFormat('d M Y, H:i') }} WIB
                                            </td>
                                            <td>
                                                @switch($item->status)
                                                    @case('menunggu')
                                                        <span
                                                            class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                                            Menunggu
                                                        </span>
                                                    @break

                                                    @case('diproses')
                                                        <span
                                                            class="badge bg-info-subtle text-info border border-info-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                                            Diproses
                                                        </span>
                                                    @break

                                                    @case('selesai')
                                                        <span
                                                            class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                                            Selesai
                                                        </span>
                                                    @break

                                                    @case('ditolak')
                                                        <span
                                                            class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                                            Ditolak
                                                        </span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td class="pe-3 text-end">
                                                <a href="{{ route('landing.detail-pengajuan', $item->kode_pengajuan) }}"
                                                    class="btn btn-sm btn-light border text-primary px-3 rounded-2 fw-medium shadow-none transition-base">
                                                    <i class="bi bi-eye me-1"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <!-- TAMPILAN JIKA DATA KOSONG -->
                        <div class="text-center py-5">
                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 80px; height: 80px;">
                                <i class="bi bi-folder2-open text-muted fs-2 opacity-50"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">Belum Ada Pengajuan Surat</h5>
                            <p class="text-muted small mb-4 mx-auto" style="max-width: 320px;">
                                NIK Anda valid namun belum memiliki riwayat permohonan pelayanan surat di sistem kami.
                            </p>
                            <a href="{{ route('landing.home') }}"
                                class="btn btn-success text-white rounded-3 px-4 fw-medium transition-base shadow-sm">
                                <i class="bi bi-plus-circle me-1.5"></i>Buat Pengajuan Sekarang
                            </a>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </section>
@endsection
