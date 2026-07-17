@extends('layouts.landing')

@section('title', 'Form Pengajuan Surat - SIPESA')

@section('content')
    <section class="py-5 bg-light-section border-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <!-- Judul Halaman -->
                    <div class="mb-4 text-center text-sm-start">
                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-medium mb-2">
                            <i class="bi bi-file-earmark-text-fill"></i> Layanan Mandiri Warga
                        </span>
                        <h2 class="fw-bold text-dark section-title m-0">Formulir Pengajuan Surat</h2>
                        <p class="text-muted small mt-1 mb-0">
                            Lengkapi seluruh data dan lampiran di bawah ini untuk memohon surat pelayanan di Desa
                            Payudan-Dungdang.
                        </p>
                    </div>

                    <form id="formPengajuan" action="{{ route('landing.form-pengajuan') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="penduduk_id" value="{{ $penduduk->id }}">

                        <!-- KARTU 1: DATA PENDUDUK (READONLY) -->
                        <div class="card bg-white border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-header bg-white p-4 border-0 pb-0">
                                <h5 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2"
                                    style="letter-spacing: -0.01em;">
                                    <i class="bi bi-person-badge text-primary"></i> Data Kependudukan Pemohon
                                </h5>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark small mb-1">Nomor Induk Kependudukan
                                            (NIK)</label>
                                        <input type="text"
                                            class="form-control form-control-modern bg-light border-0 text-dark fw-bold shadow-none"
                                            value="{{ $penduduk->nik }}" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark small mb-1">Nama Lengkap Sesuai
                                            KTP</label>
                                        <input type="text"
                                            class="form-control form-control-modern bg-light border-0 text-dark fw-semibold shadow-none"
                                            value="{{ $penduduk->nama }}" readonly>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <label class="form-label fw-medium text-dark small mb-1">Rukun Tetangga (RT)</label>
                                        <input type="text"
                                            class="form-control form-control-modern bg-light border-0 text-dark text-center shadow-none"
                                            value="{{ $penduduk->rt }}" readonly>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <label class="form-label fw-medium text-dark small mb-1">Rukun Warga (RW)</label>
                                        <input type="text"
                                            class="form-control form-control-modern bg-light border-0 text-dark text-center shadow-none"
                                            value="{{ $penduduk->rw }}" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-medium text-dark small mb-1">Alamat Rumah</label>
                                        <input type="text"
                                            class="form-control form-control-modern bg-light border-0 text-dark shadow-none"
                                            value="{{ $penduduk->alamat }}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- KARTU 2: INPUT FORMULIR SURAT -->
                        <div class="card bg-white border-0 shadow-sm rounded-4 mb-4">
                            <div class="card-header bg-white p-4 border-0 pb-0">
                                <h5 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2"
                                    style="letter-spacing: -0.01em;">
                                    <i class="bi bi-pencil-square text-success"></i> Detail Permohonan Dokumen
                                </h5>
                            </div>
                            <div class="card-body p-4">

                                <!-- Pilihan Kategori -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium text-dark small mb-2">Kategori Surat</label>
                                    <select class="form-select form-select-modern" id="kategori_surat" required>
                                        <option value="" selected disabled>-- Pilih Kategori Surat --</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Pilihan Jenis Surat -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium text-dark small mb-2">Jenis Surat</label>
                                    <select class="form-select form-select-modern" id="jenis_surat" name="jenis_surat_id"
                                        required>
                                        <option value="" selected disabled>-- Pilih Jenis Surat --</option>
                                    </select>
                                </div>

                                <!-- Maksud & Keperluan -->
                                <div class="mb-3">
                                    <label class="form-label fw-medium text-dark small mb-2">Maksud / Keperluan</label>
                                    <textarea class="form-control form-control-modern" rows="4" name="keperluan"
                                        placeholder="Contoh: Digunakan sebagai kelengkapan persyaratan pendaftaran beasiswa perkuliahan..." required
                                        style="resize: none;"></textarea>
                                </div>

                                <!-- Form Dinamis Khusus Surat Keterangan Usaha -->
                                <div id="usaha-wrapper" class="p-3 bg-light-section border rounded-3 mb-4 animate-fadeIn"
                                    style="display:none;">
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-medium text-dark small mb-2">Nama Usaha</label>
                                            <input type="text" class="form-control form-control-modern bg-white border"
                                                name="nama_usaha" placeholder="Contoh: Toko Sembako Jaya Mandiri">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-medium text-dark small mb-2">Jenis / Bidang
                                                Usaha</label>
                                            <input type="text" class="form-control form-control-modern bg-white border"
                                                name="jenis_usaha" placeholder="Contoh: Perdagangan Bahan Pokok">
                                        </div>
                                    </div>
                                </div>

                                <!-- Unggah Berkas Persyaratan -->
                                <div class="mb-2">
                                    <label class="form-label fw-medium text-dark small mb-2">Upload Berkas Lampiran
                                        Syarat</label>
                                    <div id="wrapper-persyaratan"
                                        class="border rounded-3 p-4 bg-light-section text-center text-muted small">
                                        <i class="bi bi-files d-block fs-3 mb-2 opacity-50 text-secondary"></i>
                                        Silakan tentukan jenis layanan surat terlebih dahulu untuk menampilkan daftar
                                        lampiran.
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- TOMBOL AKSI BAWAH -->
                        <div class="d-flex justify-content-between align-items-center gap-2">
                            <a href="{{ route('landing.home') }}"
                                class="btn btn-light rounded-3 px-4 fw-medium text-secondary">
                                Batal
                            </a>
                            <button type="submit"
                                class="btn btn-success text-white rounded-3 px-4 py-2.5 fw-medium transition-base d-flex align-items-center gap-2 shadow-sm"
                                id="btnSubmitPengajuan">
                                <i class="bi bi-send-check-fill"></i> Kirim Pengajuan Surat
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
