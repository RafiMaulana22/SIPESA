@extends('admin.components.template_admin')

@section('content')
        <!-- HEADER UTAMA & TOMBOL KEMBALI -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('jenis-surat.index') }}" class="btn btn-light border rounded-3 px-3 shadow-none transition-base">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <div>
                    <h3 class="fw-bold  mb-1" style="letter-spacing: -0.02em;">
                        Persyaratan Surat
                    </h3>
                    <p class="text-muted small mb-0">
                        Konfigurasi lampiran berkas wajib dan opsional untuk jenis surat: <strong class="">{{ $jenisSurat->nama_surat }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <!-- SEKSI STATISTIK INDIKATOR (STYLE GYMOVE) -->
        <div class="row g-4 mb-4">
            <!-- Total Persyaratan -->
            <div class="col-xl-4 col-sm-6">
                <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small d-block mb-1 fw-medium">Total Persyaratan</span>
                            <h2 class="fw-bold  m-0">{{ $jenisSurat->persyaratan->count() }}</h2>
                        </div>
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary rounded-4 p-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi bi-file-earmark-text fs-4 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Berkas Wajib -->
            <div class="col-xl-4 col-sm-6">
                <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small d-block mb-1 fw-medium">Berkas Wajib</span>
                            <h2 class="fw-bold text-danger m-0">{{ $jenisSurat->persyaratan->where('is_required', 1)->count() }}</h2>
                        </div>
                        <div class="stat-icon bg-danger bg-opacity-10 text-danger rounded-4 p-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi bi-exclamation-circle fs-4 text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Berkas Opsional -->
            <div class="col-xl-4 col-sm-12">
                <div class="card bg-white border-0 shadow-sm rounded-4 h-100 transition-base">
                    <div class="card-body p-4 d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small d-block mb-1 fw-medium">Berkas Opsional</span>
                            <h2 class="fw-bold text-secondary m-0">{{ $jenisSurat->persyaratan->where('is_required', 0)->count() }}</h2>
                        </div>
                        <div class="stat-icon bg-secondary bg-opacity-10 text-secondary rounded-4 p-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi bi-info-circle fs-4 text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NOTIFIKASI PETUNJUK PLACEHOLDER TEMPLATE WORD -->
        <div class="alert alert-primary bg-primary bg-opacity-10 border border-primary border-opacity-10 rounded-4 p-4 mb-4  shadow-sm">
            <div class="d-flex align-items-center gap-2 mb-2">
                <i class="bi bi-info-circle-fill text-primary fs-5"></i>
                <h6 class="fw-bold  m-0">Panduan Sinkronisasi Template Word</h6>
            </div>
            <p class="text-muted small mb-3">
                Setiap item persyaratan bertipe <strong class="">Isian Keterangan</strong> akan menghasilkan kode penanda khusus (*placeholder*) secara otomatis. Integrasikan kode ini ke dalam file template Microsoft Word agar sistem dapat melakukan automasi pengisian data warga secara dinamis.
            </p>
            <div class="d-flex flex-wrap gap-2">
                <span class="badge bg-white text-dark border px-2.5 py-1.5 font-monospace fs-7"><i class="bi bi-code-slash text-primary"></i> ${nama_usaha}</span>
                <span class="badge bg-white text-dark border px-2.5 py-1.5 font-monospace fs-7"><i class="bi bi-code-slash text-primary"></i> ${jenis_usaha}</span>
                <span class="badge bg-white text-dark border px-2.5 py-1.5 font-monospace fs-7"><i class="bi bi-code-slash text-primary"></i> ${nomor_induk_berusaha}</span>
                <span class="badge bg-white text-dark border px-2.5 py-1.5 font-monospace fs-7"><i class="bi bi-code-slash text-primary"></i> ${luas_tanah}</span>
            </div>
        </div>

        <!-- SEKSI DATA TABEL -->
        <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white p-4 border-0 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                <div>
                    <h5 class="mb-0 fw-bold " style="letter-spacing: -0.01em;">
                        Daftar Lampiran Syarat Berkas
                    </h5>
                </div>
                <button class="btn btn-primary rounded-3 px-4 fw-medium shadow-none transition-base d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#ModalTambah">
                    <i class="bi bi-plus-circle-fill"></i> Tambah Persyaratan
                </button>
            </div>

            <div class="table-responsive px-2">
                <table class="table table-hover align-middle mb-0 custom-admin-table w-100">
                    <thead>
                        <tr>
                            <th class="ps-3" width="6%">No</th>
                            <th>Nama Persyaratan Dokumen</th>
                            <th>Jenis Input</th>
                            <th>Placeholder Word</th>
                            <th width="18%">Status Sifat</th>
                            <th width="15%">Tanggal Dibuat</th>
                            <th class="pe-3 text-end" width="18%">Aksi Manajemen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jenisSurat->persyaratan as $item)
                            <tr>
                                <td class="ps-3 text-muted fw-medium">{{ $loop->iteration }}</td>
                                <td class="fw-semibold ">{{ $item->nama_persyaratan }}</td>
                                <td>
                                    @if ($item->tipe_input == 'file')
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-10 px-2.5 py-1.5 rounded-2 fw-medium" style="font-size: 0.75rem;">
                                            <i class="bi bi-file-earmark-arrow-up"></i> Upload Berkas
                                        </span>
                                    @else
                                        <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-10 px-2.5 py-1.5 rounded-2 fw-medium" style="font-size: 0.75rem;">
                                            <i class="bi bi-keyboard"></i> Isian Keterangan
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-inline-flex align-items-center gap-1.5">
                                        <code id="placeholder{{ $item->id }}" class="bg-light border  rounded px-2.5 py-1.5 small font-monospacefw-semibold">
                                            ${{ '{' . $item->placeholder . '}' }}
                                        </code>
                                        <button type="button" class="btn btn-sm btn-light border text-primary p-1.5 rounded-2 shadow-none" onclick="copyPlaceholder('placeholder{{ $item->id }}')" title="Salin tag">
                                            <i class="bi bi-clipboard"></i>
                                        </button>
                                    </div>
                                </td>
                                <td>
                                    @if ($item->is_required)
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                            Wajib Dipenuhi
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                            Opsional
                                        </span>
                                    @endif
                                </td>
                                <td class="text-muted small">{{ $item->created_at->format('d M Y') }}</td>
                                <td class="pe-3 text-end">
                                    <div class="d-inline-flex gap-1">
                                        <button type="button" class="btn btn-sm btn-light border text-success px-2.5 py-1.5 rounded-2 shadow-none" data-bs-toggle="modal" data-bs-target="#ModalDetail{{ $item->id }}" title="Lihat rincian">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light border text-primary px-2.5 py-1.5 rounded-2 shadow-none" data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $item->id }}" title="Ubah data">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light border text-danger px-2.5 py-1.5 rounded-2 shadow-none" data-bs-toggle="modal" data-bs-target="#ModalDelete{{ $item->id }}" title="Hapus berkas">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-5 small">
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

    <!-- COMPONENT BINDING MODAL DI LUAR STRUKTUR UTAMA TABEL -->
    @foreach ($jenisSurat->persyaratan as $item)
        {{-- Modal Detail Persyaratan --}}
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
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-medium mb-1">Nama Persyaratan Dokumen</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  fw-semibold rounded-3 shadow-none" value="{{ $item->nama_persyaratan }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-medium mb-1">Jenis Elemen Input</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  fw-semibold rounded-3 shadow-none" value="{{ $item->tipe_input == 'file' ? 'Upload Berkas' : 'Isian Keterangan' }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-medium mb-1">Placeholder Code Word</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  font-monospace rounded-3 shadow-none" value="${{ $item->placeholder }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-medium mb-1">Sifat Sifat Dokumen</label>
                                <div>
                                    <span class="badge {{ $item->is_required ? 'bg-danger-subtle text-danger border border-danger-subtle' : 'bg-secondary-subtle text-secondary border border-secondary-subtle' }} px-3 py-2 rounded-2 fw-medium">
                                        {{ $item->is_required ? 'Wajib Dilampirkan' : 'Opsional / Tambahan' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 px-4">
                        <button type="button" class="btn btn-light rounded-3 px-4 fw-medium text-secondary w-100 w-sm-auto" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Edit Persyaratan --}}
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
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Nama Persyaratan Dokumen</label>
                                    <input type="text" name="nama_persyaratan" class="form-control search-box-modern py-2.5 bg-white border" value="{{ $item->nama_persyaratan }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Jenis Tipe Input</label>
                                    <select class="form-select select-custom py-2.5 bg-white border" name="tipe_input" required>
                                        <option value="file" {{ $item->tipe_input == 'file' ? 'selected' : '' }}>File (Dokumen/Scan PDF/Gambar)</option>
                                        <option value="keterangan" {{ $item->tipe_input == 'keterangan' ? 'selected' : '' }}>Keterangan (Isian Teks Singkat)</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-1">Placeholder Code Word</label>
                                    <input type="text" class="form-control bg-light border-0 py-2.5 text-muted font-monospace rounded-3 shadow-none shadow-none" value="${{{ $item->placeholder }}}" readonly>
                                    <div class="form-text text-muted mt-2" style="font-size: 0.75rem;">
                                        <i class="bi bi-info-circle"></i> Sistem mengunci placeholder otomatis agar keselarasan variabel berkas tetap terjaga.
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Sifat Urgensi Lampiran</label>
                                    <select class="form-select select-custom py-2.5 bg-white border" name="is_required" required>
                                        <option value="1" {{ $item->is_required == 1 ? 'selected' : '' }}>Wajib (Harus diisi/diunggah warga)</option>
                                        <option value="0" {{ $item->is_required == 0 ? 'selected' : '' }}>Opsional (Berkas pelengkap/tambahan)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                            <button type="button" class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Hapus Persyaratan --}}
        <div class="modal fade" id="ModalDelete{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <form action="{{ route('persyaratan-surat.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                            <div>
                                <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">Konfirmasi Hapus</h5>
                                <p class="text-muted small m-0 mt-1">Tindakan ini akan menghapus entitas berkas persyaratan.</p>
                            </div>
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4 text-secondary small">
                            Apakah Anda yakin ingin menghapus berkas lampiran persyaratan berikut:<br>
                            <strong class=" d-block mt-2 fs-6"><i class="bi bi-file-earmark-x text-danger me-1"></i> {{ $item->nama_persyaratan }}</strong>
                        </div>
                        <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                            <button type="button" class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Ya, Hapus Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Tambah Persyaratan --}}
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
                            <p class="text-muted small m-0 mt-1">Daftarkan parameter lampiran atau isian keterangan baru pada surat.</p>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="alert alert-info bg-info bg-opacity-10 border border-info border-opacity-10  small mb-1 p-3 rounded-3">
                                <i class="bi bi-info-circle-fill text-info me-1"></i> Placeholder sistem penyesuai berkas Word akan digenerasi otomatis berdasarkan judul input yang diisi.
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Nama Persyaratan Dokumen</label>
                                <input type="text" name="nama_persyaratan" class="form-control search-box-modern py-2.5 bg-white border" placeholder="Contoh: Surat Pengantar RT / Luas Tanah" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Jenis Tipe Input</label>
                                <select class="form-select select-custom py-2.5 bg-white border" name="tipe_input" required>
                                    <option value="" selected disabled>Pilih Jenis Input</option>
                                    <option value="file">File (Dokumen/Scan PDF/Gambar)</option>
                                    <option value="keterangan">Keterangan (Isian Teks Singkat)</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Sifat Urgensi Berkas</label>
                                <select class="form-select select-custom py-2.5 bg-white border" name="is_required" required>
                                    <option value="" selected disabled>Pilih Sifat Berkas</option>
                                    <option value="1">Wajib (Harus diisi/diunggah warga)</option>
                                    <option value="0">Opsional (Berkas pelengkap/tambahan)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                        <button type="button" class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Simpan Berkas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                timer: 1800,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#dc3545'
            });
        </script>
    @endif

    <script>
        function copyPlaceholder(id) {
            let text = document.getElementById(id).innerText;
            navigator.clipboard.writeText(text);

            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Placeholder berhasil disalin ke clipboard.',
                timer: 1200,
                showConfirmButton: false
            });
        }
    </script>
@endpush
