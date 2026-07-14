@extends('admin.components.template_admin')

@section('content')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold  mb-1" style="letter-spacing: -0.02em;">
                Master Jenis Surat
            </h3>
            <p class="text-muted small mb-0">
                Kelola standarisasi jenis surat dan lampiran persyaratan dokumen sistem.
            </p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-xl-4 col-sm-6">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block mb-1 fw-medium">Total Jenis Surat</span>
                        <h2 class="fw-bold  m-0">{{ $jenis->count() }}</h2>
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
                        <span class="text-muted small d-block mb-1 fw-medium">Status Aktif</span>
                        <h2 class="fw-bold text-success m-0">{{ $jenis->where('is_active', 1)->count() }}</h2>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success rounded-4 p-3 d-flex align-items-center justify-content-center"
                        style="width: 52px; height: 52px;">
                        <i class="bi bi-check-circle fs-4 text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-12">
            <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block mb-1 fw-medium">Status Nonaktif</span>
                        <h2 class="fw-bold text-danger m-0">{{ $jenis->where('is_active', 0)->count() }}</h2>
                    </div>
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger rounded-4 p-3 d-flex align-items-center justify-content-center"
                        style="width: 52px; height: 52px;">
                        <i class="bi bi-x-circle fs-4 text-danger"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-3 mb-4 small border-0 shadow-sm">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4 small border-0 shadow-sm d-flex align-items-center gap-2"
            id="alertSuccess" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>
                <strong>Berhasil!</strong> {{ session('success') }}
            </div>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
            setTimeout(function() {
                let alertElement = document.getElementById('alertSuccess');
                if (alertElement) {
                    let bsAlert = new bootstrap.Alert(alertElement);
                    bsAlert.close();
                }
            }, 2000);
        </script>
    @endif

    <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden">
        <div
            class="card-header bg-white p-4 border-0 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <div>
                <h5 class="mb-0 fw-bold " style="letter-spacing: -0.01em;">
                    Master Kategori & Jenis Surat
                </h5>
            </div>
            <button
                class="btn btn-primary rounded-3 px-4 fw-medium shadow-none transition-base d-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#ModalTambah">
                <i class="bi bi-plus-circle-fill"></i> Tambah Jenis Surat
            </button>
        </div>

        <div class="table-responsive px-2">
            <table id="example" class="table table-hover align-middle mb-0 custom-admin-table w-100">
                <thead>
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Kode</th>
                        <th>Kategori Surat</th>
                        <th>Nama Klasifikasi Surat</th>
                        <th>Persyaratan</th>
                        <th>Status Aktif</th>
                        <th class="pe-3 text-end">Aksi Manajemen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jenis as $get)
                        <tr>
                            <td class="ps-3 text-muted fw-medium">{{ $loop->iteration }}</td>
                            <td class="fw-bold ">{{ $get->kode_surat }}</td>
                            <td>
                                <span class="text-secondary fw-medium">{{ $get->kategorisurat->nama_kategori }}</span>
                            </td>
                            <td class="fw-semibold ">{{ $get->nama_surat }}</td>
                            <td>
                                <span
                                    class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-10 px-2.5 py-1.5 rounded-2 fw-semibold"
                                    style="font-size: 0.75rem;">
                                    <i class="bi bi-file-earmark-check me-1"></i> {{ $get->persyaratan->count() }}
                                    Berkas
                                </span>
                            </td>
                            <td>
                                @if ($get->is_active)
                                    <span
                                        class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="pe-3 text-end">
                                <div class="d-inline-flex gap-1">
                                    <a href="{{ route('persyaratan-surat.index', $get->id) }}"
                                        class="btn btn-sm btn-light border text-warning px-2.5 py-1.5 rounded-2 shadow-none"
                                        title="Kelola Syarat Berkas">
                                        <i class="bi bi-folder-check"></i>
                                    </a>
                                    <button type="button"
                                        class="btn btn-sm btn-light border text-success px-2.5 py-1.5 rounded-2 shadow-none"
                                        data-bs-toggle="modal" data-bs-target="#ModalDetail{{ $get->id }}"
                                        title="Lihat rincian">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-sm btn-light border text-primary px-2.5 py-1.5 rounded-2 shadow-none"
                                        data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $get->id }}"
                                        title="Ubah data">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button"
                                        class="btn btn-sm btn-light border text-danger px-2.5 py-1.5 rounded-2 shadow-none"
                                        data-bs-toggle="modal" data-bs-target="#ModalHapus{{ $get->id }}"
                                        title="Hapus berkas">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pb-4"></div>
    </div>

    @foreach ($jenis as $get)
        <div class="modal fade" id="ModalDetail{{ $get->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                                Detail Klasifikasi Surat
                            </h5>
                            <p class="text-muted small m-0 mt-1">Rincian parameter konfigurasi layanan internal.</p>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-1">Kode Surat</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  fw-bold rounded-3"
                                    value="{{ $get->kode_surat }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-1">Kategori Surat</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  rounded-3"
                                    value="{{ $get->kategoriSurat->nama_kategori }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-1">Nama Surat</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  fw-semibold rounded-3"
                                    value="{{ $get->nama_surat }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-1">Deskripsi Informasi
                                    Layanan</label>
                                <textarea class="form-control bg-light border-0 p-3  rounded-3" rows="3" readonly style="resize: none;">{{ $get->deskripsi }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-1">Status Publikasi</label>
                                <div>
                                    <span
                                        class="badge {{ $get->is_active ? 'bg-success-subtle text-success border border-success-subtle' : 'bg-danger-subtle text-danger border border-danger-subtle' }} px-3 py-2 rounded-2 fw-medium">
                                        {{ $get->is_active ? 'Sistem Aktif' : 'Sistem Dinonaktifkan' }}
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

        <div class="modal fade" id="ModalEdit{{ $get->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <form action="{{ route('jenis-surat.update', $get->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                            <div>
                                <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                                    Ubah Struktur Surat
                                </h5>
                                <p class="text-muted small m-0 mt-1">Perbarui parameter data master berkas persuratan
                                    desa.</p>
                            </div>
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium  small mb-2">Kode Surat</label>
                                    <input type="text"
                                        class="form-control bg-light border-0 py-2.5 text-muted fw-bold rounded-3"
                                        value="{{ $get->kode_surat }}" readonly>
                                    <input type="hidden" name="kode_surat" value="{{ $get->kode_surat }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium  small mb-2">Kategori Surat</label>
                                    <select class="form-control default-select" name="kategori_surat_id" required>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $get->kategori_surat_id ? 'selected' : '' }}>
                                                {{ $item->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Nama Surat</label>
                                    <input type="text" name="nama_surat"
                                        class="form-control search-box-modern py-2.5 bg-white border"
                                        value="{{ $get->nama_surat }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Deskripsi Layanan</label>
                                    <textarea name="deskripsi" class="form-control search-box-modern p-3 bg-white border" rows="3"
                                        style="resize: none;">{{ $get->deskripsi }}</textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Status Operasional</label>
                                    <select class="form-control default-select" name="is_active" required>
                                        <option value="1" {{ $get->is_active == 1 ? 'selected' : '' }}>Aktif
                                            (Tampilkan di warga)
                                        </option>
                                        <option value="0" {{ $get->is_active == 0 ? 'selected' : '' }}>Tidak
                                            Aktif (Sembunyikan)</option>
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

        <div class="modal fade" id="ModalHapus{{ $get->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <form action="{{ route('jenis-surat.destroy', $get->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                            <div>
                                <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">Peringatan
                                    Keamanan !!!</h5>
                                <p class="text-muted small m-0 mt-1">Konfirmasi penghapusan data master dari database.
                                </p>
                            </div>
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4 text-secondary">
                            Apakah Anda benar-benar yakin ingin menghapus data master jenis surat dengan nama:<br>
                            <strong class=" d-block mt-2 fs-6"><i class="bi bi-file-earmark-x text-danger me-1"></i>
                                {{ $get->nama_surat }}</strong>
                            <span class="text-danger small mt-2 d-block"><i class="bi bi-info-circle"></i> Catatan:
                                Tindakan ini dapat berdampak pada relasi data riwayat pengajuan surat warga.</span>
                        </div>
                        <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                            <button type="button"
                                class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit"
                                class="btn btn-danger rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Ya, Hapus
                                Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="ModalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                <form action="{{ route('jenis-surat.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                                Tambah Jenis Surat Baru
                            </h5>
                            <p class="text-muted small m-0 mt-1">Daftarkan kategori klasifikasi surat pelaporan baru ke
                                sistem.</p>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Kategori Induk Surat</label>
                                <select class="form-control default-select" name="kategori_surat_id" required>
                                    <option value="" selected disabled>Pilih Kategori Surat</option>
                                    @foreach ($kategori as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Nama Berkas Surat</label>
                                <input type="text" name="nama_surat"
                                    class="form-control search-box-modern py-2.5 bg-white border"
                                    placeholder="Contoh: Surat Keterangan Domisili" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Deskripsi Persyaratan
                                    Singkat</label>
                                <textarea name="deskripsi" class="form-control search-box-modern p-3 bg-white border" rows="3"
                                    placeholder="Masukkan ringkasan penjelasan atau kegunaan berkas surat bagi warga..." style="resize: none;"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Status Publikasi Awal</label>
                                <select class="form-control default-select" name="is_active" required>
                                    <option value="" selected disabled>Pilih Status Publikasi</option>
                                    <option value="1">Aktif (Langsung tampil di landing page)</option>
                                    <option value="0">Tidak Aktif (Simpan sebagai draf)</option>
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
                            Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
