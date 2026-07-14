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

    <!-- AREA NOTIFIKASI SYSTEM -->
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
                    Daftar Rekam Data Kependudukan
                </h5>
            </div>
            <button
                class="btn btn-primary rounded-3 px-4 fw-medium shadow-none transition-base d-flex align-items-center gap-2"
                data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-circle-fill"></i> Tambah Penduduk
            </button>
        </div>

        <div class="table-responsive px-2">
            <table id="example" class="table table-hover align-middle mb-0 custom-admin-table w-100">
                <thead>
                    <tr>
                        <th class="ps-3" width="6%">No</th>
                        <th>Nomor NIK (KTP)</th>
                        <th>Nomor KK</th>
                        <th>Nama Lengkap</th>
                        <th>L/P</th>
                        <th>Alamat Rumah</th>
                        <th class="pe-3 text-end" width="18%">Aksi Kelola</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penduduk as $get)
                        <tr>
                            <td class="ps-3 text-muted fw-medium">{{ $loop->iteration }}</td>
                            <td class="fw-bold ">{{ $get->nik }}</td>
                            <td class="text-secondary font-monospace" style="font-size: 0.85rem;">{{ $get->no_kk }}</td>
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
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pb-4"></div>
    </div>

    <!-- LOOPING MODAL DETAIL, EDIT & HAPUS -->
    @foreach ($penduduk as $get)
        <!-- Modal Detail -->
        <div class="modal fade" id="detailModal{{ $get->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                                Detail Profil Penduduk
                            </h5>
                            <p class="text-muted small m-0 mt-1">Berkas rekam identitas lengkap kemasyarakatan desa.</p>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-medium mb-1">Nomor Induk Kependudukan
                                    (NIK)</label>
                                <input type="text"
                                    class="form-control bg-light border-0 py-2.5  fw-bold rounded-3"
                                    value="{{ $get->nik }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-medium mb-1">Nomor Kartu Keluarga (KK)</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  rounded-3"
                                    value="{{ $get->no_kk }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-medium mb-1">Nama Lengkap Sesuai KTP</label>
                                <input type="text"
                                    class="form-control bg-light border-0 py-2.5  fw-semibold rounded-3"
                                    value="{{ $get->nama }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-medium mb-1">Tempat Lahir</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  rounded-3"
                                    value="{{ $get->tempat_lahir }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-medium mb-1">Tanggal Lahir</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  rounded-3"
                                    value="{{ \Carbon\Carbon::parse($get->tanggal_lahir)->translatedFormat('d F Y') }}"
                                    readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-medium mb-1">Jenis Kelamin</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  rounded-3"
                                    value="{{ $get->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-medium mb-1">Agama</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  rounded-3"
                                    value="{{ $get->agama ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-medium mb-1">Pekerjaan</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  rounded-3"
                                    value="{{ $get->pekerjaan ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-medium mb-1">Nomor Kontak WhatsApp /
                                    HP</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  rounded-3"
                                    value="{{ $get->no_hp ?? '-' }}" readonly>
                            </div>
                            <div class="col-md-8">
                                <label class="form-label text-muted small fw-medium mb-1">Alamat Domisili Rumah</label>
                                <input type="text" class="form-control bg-light border-0 py-2.5  rounded-3"
                                    value="{{ $get->alamat }}" readonly>
                            </div>
                            <div class="col-md-2 col-6">
                                <label class="form-label text-muted small fw-medium mb-1">RT</label>
                                <input type="text"
                                    class="form-control bg-light border-0 py-2.5 text-center  rounded-3"
                                    value="{{ $get->rt }}" readonly>
                            </div>
                            <div class="col-md-2 col-6">
                                <label class="form-label text-muted small fw-medium mb-1">RW</label>
                                <input type="text"
                                    class="form-control bg-light border-0 py-2.5 text-center  rounded-3"
                                    value="{{ $get->rw }}" readonly>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small fw-medium mb-1">Status Kependudukan</label>
                                <div>
                                    <span
                                        class="badge bg-secondary bg-opacity-10  border border-secondary border-opacity-10 px-3 py-2 rounded-2 fw-medium">
                                        Status: {{ $get->status_penduduk ?? 'Tetap' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 px-4">
                        <button type="button"
                            class="btn btn-light rounded-3 px-4 fw-medium text-secondary w-100 w-sm-auto"
                            data-bs-dismiss="modal">Tutup Rincian</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal{{ $get->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <form action="{{ route('penduduk.update', $get->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                            <div>
                                <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                                    Ubah Data Kependudukan
                                </h5>
                                <p class="text-muted small m-0 mt-1">Perbarui entri data kependudukan penduduk desa secara
                                    akurat.</p>
                            </div>
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium  small mb-2">Nomor NIK</label>
                                    <input type="text" name="nik"
                                        class="form-control search-box-modern py-2.5 bg-white border" maxlength="16"
                                        value="{{ $get->nik }}" required
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium  small mb-2">Nomor Kartu Keluarga
                                        (KK)</label>
                                    <input type="text" name="no_kk"
                                        class="form-control search-box-modern py-2.5 bg-white border" maxlength="16"
                                        value="{{ $get->no_kk }}" required
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Nama Lengkap</label>
                                    <input type="text" name="nama"
                                        class="form-control search-box-modern py-2.5 bg-white border"
                                        value="{{ $get->nama }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium  small mb-2">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir"
                                        class="form-control search-box-modern py-2.5 bg-white border"
                                        value="{{ $get->tempat_lahir }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium  small mb-2">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir"
                                        class="form-control date-custom py-2.5 bg-white border"
                                        value="{{ \Carbon\Carbon::parse($get->tanggal_lahir)->format('Y-m-d') }}"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium  small mb-2">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control default-select"
                                        required>
                                        <option value="L" {{ $get->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                            Laki-Laki</option>
                                        <option value="P" {{ $get->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                            Perempuan</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium  small mb-2">Agama</label>
                                    <select name="agama" class="form-control default-select"
                                        required>
                                        @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'] as $agm)
                                            <option value="{{ $agm }}"
                                                {{ $get->agama == $agm ? 'selected' : '' }}>{{ $agm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium  small mb-2">Pekerjaan</label>
                                    <input type="text" name="pekerjaan"
                                        class="form-control search-box-modern py-2.5 bg-white border"
                                        value="{{ $get->pekerjaan }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium  small mb-2">No. HP / WA</label>
                                    <input type="text" name="no_hp"
                                        class="form-control search-box-modern py-2.5 bg-white border"
                                        value="{{ $get->no_hp }}"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium  small mb-2">Alamat Jalan / Dusun</label>
                                    <input type="text" name="alamat"
                                        class="form-control search-box-modern py-2.5 bg-white border"
                                        value="{{ $get->alamat }}" required>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label fw-medium  small mb-2">RT</label>
                                    <input type="text" name="rt"
                                        class="form-control search-box-modern py-2.5 text-center bg-white border"
                                        maxlength="3" value="{{ $get->rt }}" required
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="form-label fw-medium  small mb-2">RW</label>
                                    <input type="text" name="rw"
                                        class="form-control search-box-modern py-2.5 text-center bg-white border"
                                        maxlength="3" value="{{ $get->rw }}" required
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-medium  small mb-2">Status Klasifikasi
                                        Penduduk</label>
                                    <select name="status_penduduk"
                                        class="form-control default-select" required>
                                        @foreach (['Tetap', 'Pendatang', 'Pindah', 'Meninggal'] as $stts)
                                            <option value="{{ $stts }}"
                                                {{ $get->status_penduduk == $stts ? 'selected' : '' }}>{{ $stts }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                            <button type="button"
                                class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit"
                                class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Update Basis
                                Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Hapus -->
        <div class="modal fade" id="ModalHapus{{ $get->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                    <form action="{{ route('penduduk.destroy', $get->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                            <div>
                                <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">Peringatan
                                    Penting !</h5>
                                <p class="text-muted small m-0 mt-1">Konfirmasi penghapusan data penduduk permanen.</p>
                            </div>
                            <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body p-4 text-secondary">
                            Apakah Anda benar-benar yakin ingin menghapus data kependudukan atas nama:<br>
                            <strong class=" d-block mt-2 fs-6"><i class="bi bi-person-x text-danger me-1"></i>
                                {{ $get->nama }}</strong>
                            <span class="text-danger small mt-2 d-block"><i class="bi bi-info-circle"></i> Catatan:
                                Tindakan ini akan menghapus data pelaporan terkait dari riwayat FIFO layanan.</span>
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

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                <form action="{{ route('penduduk.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                                Tambah Data Penduduk Baru
                            </h5>
                            <p class="text-muted small m-0 mt-1">Daftarkan data rekam kependudukan warga baru secara
                                manual.</p>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Nomor NIK (16 Digit)</label>
                                <input type="text" name="nik"
                                    class="form-control search-box-modern py-2.5 bg-white border"
                                    placeholder="Masukkan 16 digit NIK" maxlength="16" required
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Nomor Kartu Keluarga (KK)</label>
                                <input type="text" name="no_kk"
                                    class="form-control search-box-modern py-2.5 bg-white border"
                                    placeholder="Masukkan 16 digit No. KK" maxlength="16" required
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Nama Lengkap Pemohon</label>
                                <input type="text" name="nama"
                                    class="form-control search-box-modern py-2.5 bg-white border"
                                    placeholder="Masukkan nama lengkap pas foto KTP" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir"
                                    class="form-control search-box-modern py-2.5 bg-white border"
                                    placeholder="Contoh: Sumenep" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir"
                                    class="form-control date-custom py-2.5 bg-white border" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control default-select"
                                    required>
                                    <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Agama</label>
                                <select name="agama" class="form-control default-select" required>
                                    <option value="" selected disabled>Pilih Kepercayaan</option>
                                    @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'] as $agm)
                                        <option value="{{ $agm }}">{{ $agm }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Pekerjaan Utama</label>
                                <input type="text" name="pekerjaan"
                                    class="form-control search-box-modern py-2.5 bg-white border"
                                    placeholder="Contoh: Wiraswasta" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Nomor HP Aktif</label>
                                <input type="text" name="no_hp"
                                    class="form-control search-box-modern py-2.5 bg-white border"
                                    placeholder="Contoh: 081234xxxxxx"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Alamat Lingkungan Dusun</label>
                                <input type="text" name="alamat"
                                    class="form-control search-box-modern py-2.5 bg-white border"
                                    placeholder="Contoh: Dusun Timur" required>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="form-label fw-medium  small mb-2">RT</label>
                                <input type="text" name="rt"
                                    class="form-control search-box-modern py-2.5 text-center bg-white border"
                                    placeholder="000" maxlength="3" required
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="form-label fw-medium  small mb-2">RW</label>
                                <input type="text" name="rw"
                                    class="form-control search-box-modern py-2.5 text-center bg-white border"
                                    placeholder="000" maxlength="3" required
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Status Domisili Warga</label>
                                <select name="status_penduduk" class="form-control default-select"
                                    required>
                                    <option value="" selected disabled>-- Pilih Status --</option>
                                    <option value="Tetap">Tetap (Warga Asli)</option>
                                    <option value="Pendatang">Pendatang</option>
                                    <option value="Pindah">Pindah Wilayah</option>
                                    <option value="Meninggal">Meninggal Dunia</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                        <button type="button"
                            class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Simpan Log
                            Penduduk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
