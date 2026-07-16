@extends('admin.components.template_admin')

@section('content')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1" style="letter-spacing: -0.02em;">
                Arsip Digital Surat
            </h3>
            <p class="text-muted small mb-0">
                Seluruh berkas pelayanan surat yang telah selesai diproses dan tersimpan aman di database digital.
            </p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-sm-6">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block mb-1 fw-medium">Total Arsip</span>
                        <h2 class="fw-bold m-0">{{ $totalArsip }}</h2>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded-4 p-3 d-flex align-items-center justify-content-center"
                        style="width: 52px; height: 52px;">
                        <i class="bi bi-archive fs-4 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block mb-1 fw-medium">Arsip Bulan Ini</span>
                        <h2 class="fw-bold m-0">{{ $arsipBulan }}</h2>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success rounded-4 p-3 d-flex align-items-center justify-content-center"
                        style="width: 52px; height: 52px;">
                        <i class="bi bi-calendar-check fs-4 text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block mb-1 fw-medium">Arsip Hari Ini</span>
                        <h2 class="fw-bold m-0">{{ $arsipHari }}</h2>
                    </div>
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning-emphasis rounded-4 p-3 d-flex align-items-center justify-content-center"
                        style="width: 52px; height: 52px;">
                        <i class="bi bi-collection fs-4 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block mb-1 fw-medium">Jenis Surat</span>
                        <h2 class="fw-bold m-0">{{ $totalJenis }}</h2>
                    </div>
                    <div class="stat-icon bg-info bg-opacity-10 text-info rounded-4 p-3 d-flex align-items-center justify-content-center"
                        style="width: 52px; height: 52px;">
                        <i class="bi bi-files fs-4 text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form method="GET" action="{{ route('arsip-digital.index') }}">
        <div class="card">
            <div class="card-body">

                <div class="row g-3">
                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <select class="form-control default-select" name="kategori">
                                <option value="" selected>Semua Kategori</option>
                                @foreach ($kategoriSurats as $kategori)
                                    <option value="{{ $kategori->id }}" @selected(request('kategori') == $kategori->id)>

                                        {{ $kategori->nama_kategori }}

                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <select class="form-control default-select" name="jenis">
                                <option selected value="">Semua Jenis Surat</option>
                                @foreach ($jenisSurats as $jenis)
                                    <option value="{{ $jenis->id }}" @selected(request('jenis') == $jenis->id)>

                                        {{ $jenis->nama_surat }}

                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group mb-4">
                            <select class="form-control default-select" name="tahun">
                                <option selected value="">Semua Tahun</option>
                                @for ($tahun = date('Y'); $tahun >= 2024; $tahun--)
                                    <option value="{{ $tahun }}" @selected(request('tahun') == $tahun)>

                                        {{ $tahun }}

                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <button type="submit" class="btn btn-primary">

                            <i class="bi bi-funnel"></i>
                            Filter

                        </button>

                        <a href="{{ route('arsip-digital.index') }}" class="btn btn-secondary">

                            Reset

                        </a>

                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Arsip Surat</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display min-w850">
                            <thead>
                                <tr>
                                    <th class="ps-4">No</th>
                                    <th>No Surat</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Identitas Warga</th>
                                    <th>Kategori Surat</th>
                                    <th>Status Data</th>
                                    <th class="pe-4 text-end">Aksi Berkas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($arsips as $arsip)
                                    <tr>
                                        <td class="ps-4 text-muted fw-medium">{{ $loop->iteration }}</td>
                                        <td class="fw-semibold">
                                            {{ $arsip->nomor_surat }}
                                        </td>
                                        <td class="text-muted small">
                                            {{ $arsip->tanggal_surat->translatedFormat('d F Y') }}</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold mb-0.5">{{ $arsip->pengajuan->penduduk->nama }}</span>
                                                <small class="text-muted" style="font-size: 0.75rem;">NIK:
                                                    {{ $arsip->pengajuan->penduduk->nik }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class=fw-medium">{{ $arsip->pengajuan->jenisSurat->kategoriSurat->nama_kategori }}</span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                                Arsip Digital
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex gap-1.5">
                                                <a target="_blank" href="{{ asset($arsip->file_pdf) }}"
                                                    class="btn btn-sm btn-light border text-secondary px-2.5 py-1.5 rounded-2 shadow-none"
                                                    title="Lihat Dokumen">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ Storage::url($arsip->file_pdf) }}" download
                                                    class="btn btn-sm btn-light border text-primary px-2.5 py-1.5 rounded-2 shadow-none"
                                                    title="Unduh Berkas">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty

                                    <tr>

                                        <td colspan="7" class="text-center py-5">

                                            Belum terdapat arsip surat.

                                        </td>

                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
