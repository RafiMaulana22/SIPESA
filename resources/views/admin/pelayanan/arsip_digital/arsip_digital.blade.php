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
                        <h2 class="fw-bold m-0">1.254</h2>
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
                        <h2 class="fw-bold m-0">84</h2>
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
                        <h2 class="fw-bold m-0">7</h2>
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
                        <h2 class="fw-bold m-0">12</h2>
                    </div>
                    <div class="stat-icon bg-info bg-opacity-10 text-info rounded-4 p-3 d-flex align-items-center justify-content-center"
                        style="width: 52px; height: 52px;">
                        <i class="bi bi-files fs-4 text-info"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-lg-4">
                    <div class="form-group mb-4">
                        <select class="form-control default-select">
                            <option selected>Semua Kategori</option>
                            <option>Administrasi Kependudukan</option>
                            <option>Perizinan</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group mb-4">
                        <select class="form-control default-select">
                            <option selected>Semua Jenis Surat</option>
                            <option>Surat Keterangan Domisili</option>
                            <option>Surat Keterangan Usaha</option>
                            <option>Surat Keterangan Tidak Mampu</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group mb-4">
                        <select class="form-control default-select">
                            <option selected>2026</option>
                            <option>2025</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                @for ($i = 1; $i <= 5; $i++)
                                    <tr>
                                        <td class="ps-4 text-muted fw-medium">{{ $i }}</td>
                                        <td class="fw-semibold">
                                            470/{{ 100 + $i }}/435.312/{{ date('Y') }}
                                        </td>
                                        <td class="text-muted small">28 Juni 2026</td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-bold mb-0.5">Ahmad Fauzi</span>
                                                <small class="text-muted" style="font-size: 0.75rem;">NIK:
                                                    35291234567890{{ $i }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class=fw-medium">Surat Keterangan Domisili</span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                                Arsip Digital
                                            </span>
                                        </td>
                                        <td class="pe-4 text-end">
                                            <div class="d-inline-flex gap-1.5">
                                                <button
                                                    class="btn btn-sm btn-light border text-secondary px-2.5 py-1.5 rounded-2 shadow-none"
                                                    title="Lihat Dokumen">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button
                                                    class="btn btn-sm btn-light border text-primary px-2.5 py-1.5 rounded-2 shadow-none"
                                                    title="Unduh Berkas">
                                                    <i class="bi bi-download"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
