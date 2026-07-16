@extends('admin.components.template_admin')

@section('content')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">

        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('jenis-surat.index') }}" class="btn btn-light border rounded-3">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>

            <div>
                <h3 class="fw-bold mb-1">
                    Persyaratan Surat
                </h3>

                <p class="text-muted small mb-0">
                    Konfigurasi lampiran berkas wajib dan opsional untuk jenis surat
                    <strong>{{ $jenisSurat->nama_surat }}</strong>
                </p>
            </div>
        </div>

    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-4 col-sm-6">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block mb-1 fw-medium">Total Persyaratan</span>
                        <h2 class="fw-bold  m-0">{{ $jenisSurat->persyaratan->count() }}</h2>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded-4 p-3 d-flex align-items-center justify-content-center"
                        style="width: 52px; height: 52px;">
                        <i class="bi bi-file-earmark-text fs-4 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block mb-1 fw-medium">Berkas Wajib</span>
                        <h2 class="fw-bold text-danger m-0">
                            {{ $jenisSurat->persyaratan->where('is_required', 1)->count() }}</h2>
                    </div>
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger rounded-4 p-3 d-flex align-items-center justify-content-center"
                        style="width: 52px; height: 52px;">
                        <i class="bi bi-exclamation-circle fs-4 text-danger"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-12">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block mb-1 fw-medium">Berkas Opsional</span>
                        <h2 class="fw-bold text-secondary m-0">
                            {{ $jenisSurat->persyaratan->where('is_required', 0)->count() }}</h2>
                    </div>
                    <div class="stat-icon bg-secondary bg-opacity-10 text-secondary rounded-4 p-3 d-flex align-items-center justify-content-center"
                        style="width: 52px; height: 52px;">
                        <i class="bi bi-info-circle fs-4 text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-primary border-0 shadow-sm rounded-3 mb-4">
        <h6 class="fw-bold mb-2">
            Placeholder Template Word
        </h6>

        <p class="mb-2">
            Setiap persyaratan bertipe <strong>Keterangan</strong> memiliki placeholder yang dibuat otomatis.
        </p>

        <p class="mb-0">
            Contoh penulisan pada template Word:
        </p>

        <code>${nama_usaha}</code><br>
        <code>${jenis_usaha}</code><br>
        <code>${nomor_induk_berusaha}</code><br>
        <code>${luas_tanah}</code>
    </div>

    <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden">
        <div
            class="card-header bg-white p-4 border-0 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <div>
                <h5 class="mb-0 fw-bold " style="letter-spacing: -0.01em;">
                    Daftar Lampiran Syarat Berkas
                </h5>
            </div>
            <button
                class="btn btn-primary rounded-3 px-4 fw-medium shadow-none transition-base d-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#ModalTambah">
                <i class="bi bi-plus-circle-fill"></i> Tambah Persyaratan
            </button>
        </div>

        <div class="table-responsive px-2">
            <table class="table table-hover align-middle mb-0 custom-admin-table w-100">
                <thead>
                    <tr>
                        <th class="ps-3" width="8%">No</th>
                        <th>Nama Persyaratan Dokumen</th>
                        <th>Jenis Input</th>
                        <th>Placeholder Word</th>
                        <th width="20%">Status Sifat</th>
                        <th width="20%">Tanggal Dibuat</th>
                        <th class="pe-3 text-end" width="20%">Aksi Manajemen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jenisSurat->persyaratan as $item)
                        <tr>
                            <td class="ps-3 text-muted fw-medium">{{ $loop->iteration }}</td>
                            <td class="fw-semibold ">{{ $item->nama_persyaratan }}</td>
                            <td class="text-muted small">
                                @if ($item->tipe_input == 'file')
                                    <span class="badge bg-primary">
                                        Upload Berkas
                                    </span>
                                @else
                                    <span class="badge bg-info">
                                        Isian Keterangan
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-dark">
                                    ${{ $item->placeholder }}
                                </span>
                            </td>
                            <td>
                                @if ($item->is_required)
                                    <span
                                        class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                        Wajib Dipenuhi
                                    </span>
                                @else
                                    <span
                                        class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                        Opsional
                                    </span>
                                @endif
                            </td>
                            <td class="text-muted small">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="pe-3 text-end">
                                <div class="d-inline-flex gap-1">
                                    <button type="button"
                                        class="btn btn-sm btn-light border text-success px-2.5 py-1.5 rounded-2 shadow-none"
                                        data-bs-toggle="modal" data-bs-target="#ModalDetail{{ $item->id }}"
                                        title="Lihat rincian">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-sm btn-light border text-primary px-2.5 py-1.5 rounded-2 shadow-none"
                                        data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $item->id }}"
                                        title="Ubah data">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-sm btn-light border text-danger px-2.5 py-1.5 rounded-2 shadow-none"
                                        data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $item->id }}"
                                        title="Hapus berkas">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4 small">
                                <i class="bi bi-file-earmark-text d-block fs-3 mb-2 text-opacity-50 text-secondary"></i>
                                Belum ada parameter berkas persyaratan untuk jenis surat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pb-4"></div>
    </div>

    @foreach ($jenisSurat->persyaratan as $item)
        {{--  Modal Detail Persyaratan  --}}
        <div class="modal fade" id="ModalDetail{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                                Detail Persyaratan Berkas
                            </h5>
                            <p class="text-muted small m-0 mt-1">Spesifikasi ketentuan dokumen pemohon.</p>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-1">Nama Persyaratan
                                    Dokumen</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  fw-semibold rounded-3"
                                    value="{{ $item->nama_persyaratan }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-1">Jenis Input</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  fw-semibold rounded-3"
                                    value="{{ $item->tipe_input }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium small mb-1">
                                    Placeholder Template Word
                                </label>

                                <input type="text" class="form-control bg-light border-0 py-2.5 fw-semibold rounded-3"
                                    value="${{ $item->placeholder }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-1">Sifat Sifat Dokumen</label>
                                <div>
                                    <span
                                        class="badge {{ $item->is_required ? 'bg-danger-subtle text-danger border border-danger-subtle' : 'bg-secondary-subtle text-secondary border border-secondary-subtle' }} px-3 py-2 rounded-2 fw-medium">
                                        {{ $item->is_required ? 'Wajib Dilampirkan' : 'Opsional / Tambahan' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 px-4">
                        <button type="button"
                            class="btn btn-light rounded-3 px-4 fw-medium text-secondary w-100 w-sm-auto"
                            data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        {{--  Modal Edit Persyaratan  --}}
        <div class="modal fade" id="ModalEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <form action="{{ route('persyaratan-surat.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                            <div>
                                <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                                    Ubah Parameter Persyaratan
                                </h5>
                                <p class="text-muted small m-0 mt-1">Perbarui penamaan atau sifat lampiran digital.</p>
                            </div>
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Nama Persyaratan
                                        Dokumen</label>
                                    <input type="text" name="nama_persyaratan"
                                        class="form-control search-box-modern py-2.5 bg-white border"
                                        value="{{ $item->nama_persyaratan }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Jenis Input</label>
                                    <select class="form-control default-select" name="tipe_input" required>
                                        <option value="file" {{ $item->tipe_input == 'file' ? 'selected' : '' }}>File
                                        </option>
                                        <option value="keterangan"
                                            {{ $item->tipe_input == 'keterangan' ? 'selected' : '' }}>
                                            Keterangan</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium small mb-2">
                                        Placeholder Word
                                    </label>

                                    <input type="text" class="form-control bg-light"
                                        value="${{ $item->placeholder }}" readonly>

                                    <small class="text-muted">
                                        Placeholder dibuat otomatis oleh sistem dan digunakan pada template Word.
                                    </small>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Sifat Sifat
                                        Dokumen</label>
                                    <select class="form-control default-select" name="is_required" required>
                                        <option value="1" {{ $item->is_required == 1 ? 'selected' : '' }}>Wajib
                                            (Harus diunggah warga)
                                        </option>
                                        <option value="0" {{ $item->is_required == 0 ? 'selected' : '' }}>
                                            Opsional (Tambahan berkas pelengkap)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                            <button type="button"
                                class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit"
                                class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Simpan
                                Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{--  Modal Hapus Persyaratan  --}}
        <div class="modal fade" id="ModalDelete{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <form action="{{ route('persyaratan-surat.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                            <div>
                                <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">Konfirmasi
                                    Hapus</h5>
                                <p class="text-muted small m-0 mt-1">Tindakan ini akan menghapus entitas berkas
                                    persyaratan.</p>
                            </div>
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4 text-secondary">
                            Apakah Anda yakin ingin menghapus berkas lampiran persyaratan berikut:<br>
                            <strong class=" d-block mt-2 fs-6"><i class="bi bi-file-earmark-x text-danger me-1"></i>
                                {{ $item->nama_persyaratan }}</strong>
                        </div>
                        <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                            <button type="button"
                                class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit"
                                class="btn btn-danger rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Ya,
                                Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{--  Modal Tambah Persyaratan  --}}
    <div class="modal fade" id="ModalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                <form action="{{ route('persyaratan-surat.store', $jenisSurat->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="jenis_surat_id" value="{{ $jenisSurat->id }}">

                    <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                                Tambah Persyaratan Berkas
                            </h5>
                            <p class="text-muted small m-0 mt-1">Daftarkan parameter lampiran wajib baru pada surat.
                            </p>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="alert alert-info small mb-0">
                                <i class="bi bi-info-circle"></i>

                                Placeholder Word akan dibuat otomatis oleh sistem berdasarkan nama persyaratan.
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Nama Persyaratan
                                    Dokumen</label>
                                <input type="text" name="nama_persyaratan"
                                    class="form-control search-box-modern py-2.5 bg-white border"
                                    placeholder="Contoh: Kartu Keluarga asli / Pengantar RT" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Jenis Input</label>
                                <select class="form-control default-select" name="tipe_input" required>
                                    <option value="" selected disabled>Pilih Jenis Input</option>
                                    <option value="file">File</option>
                                    <option value="keterangan">Keterangan</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Sifat Urgensi Berkas</label>
                                <select class="form-control default-select" name="is_required" required>
                                    <option value="" selected disabled>Pilih Sifat Berkas</option>
                                    <option value="1">Wajib (Harus diunggah warga)</option>
                                    <option value="0">Opsional (Berkas pelengkap/tambahan)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                        <button type="button"
                            class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Simpan
                            Berkas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
