@extends('admin.components.template_admin')

@section('content')
    <!-- HEADER UTAMA -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold  mb-1" style="letter-spacing: -0.02em;">
                Master Data Penduduk
            </h3>
            <p class="text-muted small mb-0">
                Kelola basis data kependudukan resmi Desa Payudan-Dungdang untuk basis validasi layanan persuratan.
            </p>
        </div>
    </div>

    <!-- NOTIFIKASI SYSTEM -->
    @include('admin.components.alert-admin')

    <!-- SEKSI DATA TABEL & FILTER BAR -->
    <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden">
        <div
            class="card-header bg-white p-4 border-0 d-flex flex-column flex-xl-row justify-content-between align-items-xl-center gap-3">
            <div>
                <h5 class="mb-0 fw-bold " style="letter-spacing: -0.01em;">
                    Daftar Rekam Data Kependudukan
                </h5>
            </div>

            <!-- Kelompok Filter Pencarian & Tombol Aksi -->
            <div class="d-flex flex-column flex-sm-row align-items-stretch align-items-sm-center gap-2">
                <form action="{{ route('penduduk.index') }}" method="GET" class="m-0">
                    <div class="input-group search-box-modern shadow-none border bg-white">
                        <span class="input-group-text bg-transparent border-0 ps-3">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control bg-transparent border-0 py-2 shadow-none"
                            placeholder="Cari NIK, No KK, atau nama..." value="{{ request('search') }}">
                        <button class="btn btn-primary px-3 rounded-2 m-1 small fw-medium" type="submit">
                            Cari
                        </button>
                    </div>
                </form>

                <div class="d-flex gap-2">
                    <button
                        class="btn btn-success rounded-3 px-3 py-2 fw-medium shadow-none text-white d-flex align-items-center justify-content-center gap-2 flex-grow-1 flex-sm-grow-0"
                        data-bs-toggle="modal" data-bs-target="#modalImport">
                        <i class="bi bi-file-earmark-excel-fill"></i> Import Excel
                    </button>

                    <button
                        class="btn btn-primary rounded-3 px-3 py-2 fw-medium shadow-none d-flex align-items-center justify-content-center gap-2 flex-grow-1 flex-sm-grow-0"
                        data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="bi bi-plus-circle-fill"></i> Tambah Penduduk
                    </button>
                </div>
            </div>
        </div>

        <!-- TABEL REKAM DATA -->
        <div class="table-responsive px-2">
            <table class="table table-hover align-middle mb-0 custom-admin-table w-100">
                <thead>
                    <tr>
                        <th class="ps-3" width="6%">No</th>
                        <th>Nomor NIK (KTP)</th>
                        <th>Nomor KK</th>
                        <th>Nama Lengkap</th>
                        <th>L/P</th>
                        <th>Alamat Rumah</th>
                        <th class="pe-3 text-end" width="16%">Aksi Kelola</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($penduduk as $get)
                        <tr>
                            <td class="ps-3 text-muted fw-medium">
                                {{ $penduduk->firstItem() + $loop->index }}
                            </td>
                            <td class="fw-bold ">{{ $get->nik }}</td>
                            <td class="text-secondary font-monospace" style="font-size: 0.85rem;">{{ $get->no_kk }}
                            </td>
                            <td class="fw-semibold ">{{ $get->nama }}</td>
                            <td>
                                <span
                                    class="badge {{ $get->jenis_kelamin == 'L' ? 'bg-primary-subtle text-primary' : 'bg-danger-subtle text-danger' }} px-2 py-1 rounded-2 small fw-medium">
                                    {{ $get->jenis_kelamin == 'L' ? 'L' : 'P' }}
                                </span>
                            </td>
                            <td class="text-muted small">{{ $get->alamat }}</td>
                            <td class="pe-3 text-end">
                                <div class="d-inline-flex gap-1">
                                    <button type="button"
                                        class="btn btn-sm btn-light border text-success px-2.5 py-1.5 rounded-2 shadow-none"
                                        data-bs-toggle="modal" data-bs-target="#detailModal{{ $get->id }}"
                                        title="Lihat Rincian">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-sm btn-light border text-primary px-2.5 py-1.5 rounded-2 shadow-none"
                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $get->id }}"
                                        title="Ubah Data">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-sm btn-light border text-danger px-2.5 py-1.5 rounded-2 shadow-none"
                                        data-bs-toggle="modal" data-bs-target="#ModalHapus{{ $get->id }}"
                                        title="Hapus Data">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5 small">
                                <i class="bi bi-people d-block fs-3 mb-2 text-opacity-50 text-secondary"></i>
                                Tidak ditemukan rekam data kependudukan yang sesuai.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- FOOTER TABEL & PAGINASI -->
        <div class="card-footer bg-white p-4 border-0 border-top">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="text-muted small fw-medium">
                    Menampilkan
                    <strong class="">{{ $penduduk->firstItem() ?? 0 }}</strong>
                    sampai
                    <strong class="">{{ $penduduk->lastItem() ?? 0 }}</strong>
                    dari
                    <strong class="">{{ $penduduk->total() }}</strong>
                    data penduduk
                </div>

                <div class="pagination-modern-wrapper">
                    @if ($penduduk->hasPages())
                        <nav aria-label="Pagination Penduduk">
                            <ul class="pagination pagination-sm mb-0">

                                {{-- Previous --}}
                                @if ($penduduk->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <i class="bi bi-chevron-left"></i>
                                        </span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $penduduk->previousPageUrl() }}" rel="prev">
                                            <i class="bi bi-chevron-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Nomor Halaman --}}
                                @foreach ($penduduk->getUrlRange(max(1, $penduduk->currentPage() - 2), min($penduduk->lastPage(), $penduduk->currentPage() + 2)) as $page => $url)
                                    <li class="page-item {{ $page == $penduduk->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endforeach

                                {{-- Next --}}
                                @if ($penduduk->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $penduduk->nextPageUrl() }}" rel="next">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <i class="bi bi-chevron-right"></i>
                                        </span>
                                    </li>
                                @endif

                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- LOOPING MODAL COMPONENT (DETAIL, EDIT & HAPUS) -->
    @foreach ($penduduk as $get)
        <!-- Modal Detail -->
        @include('admin.master_data.penduduk.modal.detail')

        <!-- Modal Edit -->
        @include('admin.master_data.penduduk.modal.edit')

        <!-- Modal Hapus -->
        @include('admin.master_data.penduduk.modal.hapus')
    @endforeach

    <!-- Modal Tambah Manual -->
    @include('admin.master_data.penduduk.modal.tambah')

    <!-- Modal Import Berkas Excel -->
    @include('admin.master_data.penduduk.modal.excel')
@endsection

@push('styles')
    <style>
        .pagination-modern-wrapper .pagination {
            margin-bottom: 0;
            gap: 4px;
        }

        .pagination-modern-wrapper .page-item {
            margin: 0;
        }

        .pagination-modern-wrapper .page-link {
            min-width: 36px;
            height: 36px;
            padding: 0 10px;

            display: inline-flex;
            align-items: center;
            justify-content: center;

            border: 1px solid #e5e7eb;
            border-radius: 8px !important;

            background: #fff;
            color: #64748b;

            font-size: 0.85rem;
            font-weight: 500;

            box-shadow: none;
            transition: all 0.2s ease;
        }

        .pagination-modern-wrapper .page-link:hover {
            background: #f8fafc;
            color: #0d6efd;
            border-color: #cbd5e1;
        }

        .pagination-modern-wrapper .page-item.active .page-link {
            background: #0d6efd;
            border-color: #0d6efd;
            color: #fff;
            font-weight: 600;
        }

        .pagination-modern-wrapper .page-item.disabled .page-link {
            background: #f8fafc;
            color: #cbd5e1;
            border-color: #e5e7eb;
            cursor: not-allowed;
        }
    </style>
@endpush
