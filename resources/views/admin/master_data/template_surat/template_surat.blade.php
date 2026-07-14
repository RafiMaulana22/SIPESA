@extends('admin.components.template_admin')

@section('content')
    <!-- HEADER UTAMA -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold  mb-1" style="letter-spacing: -0.02em;">
                Master Template Surat
            </h3>
            <p class="text-muted small mb-0">
                Kelola berkas master cetak (*template file Word*) yang digunakan otomatis oleh sistem.
            </p>
        </div>
    </div>

    <!-- NOTIFIKASI SYSTEM -->
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

    <!-- SEKSI DATA TABEL -->
    <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden">
        <div
            class="card-header bg-white p-4 border-0 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
            <div>
                <h5 class="mb-0 fw-bold " style="letter-spacing: -0.01em;">
                    Daftar Berkas Template Word
                </h5>
            </div>
            <button
                class="btn btn-primary rounded-3 px-4 fw-medium shadow-none transition-base d-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#ModalTambah">
                <i class="bi bi-plus-circle-fill"></i> Tambah Template
            </button>
        </div>

        <div class="table-responsive px-2">
            <table id="example" class="table table-hover align-middle mb-0 custom-admin-table w-100">
                <thead>
                    <tr>
                        <th class="ps-3" width="8%">No</th>
                        <th>Jenis Surat Mandiri</th>
                        <th>Judul Format Surat</th>
                        <th>Status Unduhan Dokumen</th>
                        <th class="pe-3 text-end" width="20%">Aksi Manajemen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($template as $get)
                        <tr>
                            <td class="ps-3 text-muted fw-medium">{{ $loop->iteration }}</td>
                            <td class="fw-bold ">{{ $get->jenissurat->nama_surat }}</td>
                            <td class="text-secondary fw-medium">{{ $get->judul_surat }}</td>
                            <td>
                                @if ($get->file_template)
                                    <a href="{{ asset('template_surat/' . $get->file_template) }}" target="_blank"
                                        class="btn btn-sm btn-light border text-primary px-3 rounded-2 fw-medium shadow-none">
                                        <i class="bi bi-file-earmark-word-fill me-1 text-primary"></i> Lihat File
                                    </a>
                                @else
                                    <span
                                        class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                        Belum Tersedia
                                    </span>
                                @endif
                            </td>
                            <td class="pe-3 text-end">
                                <div class="d-inline-flex gap-1">
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
                                        title="Hapus template">
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

    <!-- LOOPING COMPONENT MODAL DETAIL, EDIT & HAPUS -->
    @foreach ($template as $get)
        <!-- Modal Detail -->
        <div class="modal fade" id="ModalDetail{{ $get->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                                Detail File Template Surat
                            </h5>
                            <p class="text-muted small m-0 mt-1">Spesifikasi format dokumen dinas desa.</p>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-1">Jenis Surat</label>
                                <input type="text"
                                    class="form-control bg-light border-0 py-2.5  fw-semibold rounded-3"
                                    value="{{ $get->jenissurat->nama_surat }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-1">Judul Format Surat</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  rounded-3"
                                    value="{{ $get->judul_surat }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-1">File Unduhan Master</label>
                                <div>
                                    @if ($get->file_template)
                                        <a href="{{ asset('template_surat/' . $get->file_template) }}" target="_blank"
                                            class="btn btn-primary rounded-3 px-4 py-2 fw-medium shadow-none transition-base">
                                            <i class="bi bi-file-earmark-word me-1"></i> Unduh File Word (.docx)
                                        </a>
                                    @else
                                        <span
                                            class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-2 fw-medium">
                                            Berkas Fisik Belum Diunggah
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 px-4">
                        <button type="button" class="btn btn-light rounded-3 px-4 fw-medium text-secondary w-100 w-sm-auto"
                            data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="ModalEdit{{ $get->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <form action="{{ route('template-surat.update', $get->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                            <div>
                                <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                                    Ubah File Template Surat
                                </h5>
                                <p class="text-muted small m-0 mt-1">Perbarui judul atau ganti file master cetak surat.
                                </p>
                            </div>
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Pilihan Jenis
                                        Surat</label>
                                    <select name="jenis_surat_id" class="form-control default-select"
                                        required>
                                        @foreach ($jenis as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $get->jenis_surat_id ? 'selected' : '' }}>
                                                {{ $item->nama_surat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Judul Format Surat</label>
                                    <input type="text" name="judul_surat"
                                        class="form-control search-box-modern py-2.5 bg-white border"
                                        value="{{ $get->judul_surat }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Berkas Pendukung Saat
                                        Ini</label>
                                    <div class="mb-3">
                                        @if ($get->file_template)
                                            <a href="{{ asset('template_surat/' . $get->file_template) }}"
                                                target="_blank" class="btn btn-sm btn-success rounded-2 px-3 shadow-none">
                                                <i class="bi bi-file-earmark-word me-1"></i> File Word Terlampir
                                            </a>
                                        @endif
                                    </div>
                                    <label class="form-label fw-medium  small mb-2">Unggah File Template
                                        Baru</label>
                                    <input type="file" name="file_template"
                                        class="form-control form-control-modern py-2 bg-white border" accept=".doc,.docx">
                                    <div class="form-text text-muted mt-2" style="font-size: 0.75rem;">
                                        <i class="bi bi-info-circle"></i> Biarkan kosong jika tidak ingin memperbarui
                                        struktur file word saat ini.
                                    </div>
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

        <!-- Modal Hapus -->
        <div class="modal fade" id="ModalHapus{{ $get->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <form action="{{ route('template-surat.destroy', $get->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                            <div>
                                <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">Peringatan
                                    Penting !</h5>
                                <p class="text-muted small m-0 mt-1">Konfirmasi penghapusan data format cetak dari
                                    sistem.</p>
                            </div>
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4 text-secondary">
                            Apakah Anda benar-benar yakin ingin menghapus data master berkas template milik surat:<br>
                            <strong class=" d-block mt-2 fs-6"><i
                                    class="bi bi-file-earmark-x text-danger me-1"></i>
                                {{ $get->jenissurat->nama_surat }}</strong>
                        </div>
                        <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                            <button type="button"
                                class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit"
                                class="btn btn-danger rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Ya, Hapus
                                Berkas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Tambah -->
    <div class="modal fade" id="ModalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                <form action="{{ route('template-surat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                                Tambah Template Surat Baru
                            </h5>
                            <p class="text-muted small m-0 mt-1">Unggah berkas ekstensi Word baru sebagai struktur
                                cetak otomatis.</p>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Hubungkan Ke Jenis
                                    Surat</label>
                                <select name="jenis_surat_id" class="form-control default-select"
                                    required>
                                    <option value="" selected disabled>Pilih Jenis Surat Layanan</option>
                                    @foreach ($jenis as $get)
                                        <option value="{{ $get->id }}">{{ $get->nama_surat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Judul Dokumen Format
                                    Surat</label>
                                <input type="text" name="judul_surat"
                                    class="form-control search-box-modern py-2.5 bg-white border"
                                    placeholder="Contoh: Format Resmi Surat Keterangan Usaha" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">File Master (.doc /
                                    .docx)</label>
                                <input type="file" name="file_template"
                                    class="form-control form-control-modern py-2 bg-white border" accept=".doc,.docx"
                                    required>
                                <div class="form-text text-muted mt-2" style="font-size: 0.75rem;">
                                    <i class="bi bi-info-circle"></i> Pastikan dokumen memuat tag-tag variabel
                                    kependudukan yang sesuai untuk automasi cetak.
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                        <button type="button"
                            class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Simpan
                            Template</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
