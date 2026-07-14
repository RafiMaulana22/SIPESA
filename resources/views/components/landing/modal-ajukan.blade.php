<div class="modal fade" id="ajukanSuratModal" tabindex="-1" aria-labelledby="ajukanSuratModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">

            <!-- Header Modal -->
            <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="ajukanSuratModalLabel" style="letter-spacing: -0.01em;">
                        Ajukan Surat Layanan
                    </h5>
                    <p class="text-muted small m-0 mt-1">
                        Masukkan NIK Anda untuk melakukan verifikasi data penduduk.
                    </p>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body p-4">
                <form id="formValidasiNik" enctype="multipart/form-data">
                    @csrf
                    <!-- STEP 1: VALIDASI NIK -->
                    <div id="step-validasi">
                        <div class="text-center mb-4">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center animate-pulse"
                                style="width: 72px; height: 72px;">
                                <i class="bi bi-person-vcard text-primary fs-2"></i>
                            </div>
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger rounded-3 mb-3 small d-flex align-items-center gap-2">
                                <i class="bi bi-exclamation-triangle-fill"></i> {{ session('error') }}
                            </div>
                        @endif

                        <div class="mb-4">
                            <label class="form-label fw-medium text-dark small mb-2">
                                Nomor Induk Kependudukan (NIK)
                            </label>
                            <input type="text" id="nik"
                                class="form-control form-control-modern @error('nik') is-invalid @enderror"
                                name="nik" maxlength="16" inputmode="numeric" pattern="[0-9]*"
                                placeholder="Contoh: 3529xxxxxxxxxxxx" required value="{{ old('nik') }}"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                            <div id="nikError" class="text-danger small mt-2"></div>
                            @error('nik')
                                <div class="invalid-feedback small mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text text-muted mt-2" style="font-size: 0.8rem; line-height: 1.4;">
                                <i class="bi bi-shield-check text-success me-1"></i> Pastikan NIK Anda sudah terdaftar
                                di database Desa Payudan-Dungdang.
                            </div>
                        </div>

                        <div class="alert alert-custom d-flex gap-3 mb-4">
                            <i class="bi bi-info-circle text-primary fs-5 mt-0.5"></i>
                            <div class="small text-secondary" style="line-height: 1.5;">
                                Setelah NIK berhasil divalidasi, sistem akan mengarahkan Anda ke formulir pengisian data
                                berkas berkas surat.
                            </div>
                        </div>

                        <div class="modal-footer border-0 p-0 gap-2">
                            <button type="button"
                                class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                                data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit"
                                class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">
                                <i class="bi bi-arrow-right-circle me-1.5"></i>Validasi NIK
                            </button>
                        </div>
                    </div>
                </form>
                <form id="formPengajuan" action="{{ route('landing.form-pengajuan') }}" method="POST"
                    enctype="multipart/form-data" style="display:none;">

                    @csrf
                    <input type="hidden" id="penduduk_id" name="penduduk_id">
                    <!-- STEP 2: FORMULIR PENGAJUAN (SETELAH VALIDASI) -->
                    <div id="step-pengajuan" style="display:none;">

                        <div class="alert alert-success rounded-3 mb-4 small d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill fs-5"></i> NIK Anda berhasil diverifikasi oleh sistem.
                        </div>

                        <!-- Kartu Informasi Data Penduduk -->
                        <div class="card border-0 bg-light-section border rounded-4 mb-4">
                            <div class="card-body p-3 small text-secondary">
                                <div class="mb-2.5">
                                    <label class="text-muted fw-medium d-block mb-0.5" style="font-size: 0.75rem;">Nomor
                                        Induk Kependudukan</label>
                                    <input type="text" id="penduduk_nik" name="penduduk_nik"
                                        class="form-control form-control-modern bg-white text-dark fw-bold border-0 p-0 shadow-none fs-6"
                                        readonly style="height: auto;">
                                </div>
                                <div class="mb-2.5">
                                    <label class="text-muted fw-medium d-block mb-0.5" style="font-size: 0.75rem;">Nama
                                        Lengkap Penduduk</label>
                                    <input type="text" id="penduduk_nama"
                                        class="form-control form-control-modern bg-white text-dark fw-semibold border-0 p-0 shadow-none"
                                        readonly style="height: auto;">
                                </div>
                                <div class="mb-0">
                                    <label class="text-muted fw-medium d-block mb-0.5"
                                        style="font-size: 0.75rem;">Alamat
                                        Rumah Asli</label>
                                    <textarea id="penduduk_alamat" class="form-control form-control-modern bg-white text-dark border-0 p-0 shadow-none"
                                        rows="2" readonly style="resize: none; min-height: auto; line-height: 1.4;"></textarea>
                                </div>
                                
                            </div>
                        </div>

                        <!-- Pilihan Jenis Surat -->
                        <div class="mb-3">
                            <label class="form-label fw-medium text-dark small mb-2">
                                Jenis Layanan Surat
                            </label>

                            <select class="form-select form-select-modern" id="jenis_surat" name="jenis_surat_id"
                                required>

                                <option value="" selected disabled>
                                    -- Pilih Jenis Surat --
                                </option>

                            </select>
                            <div id="infoPersyaratan" class="alert alert-info d-none">

                                Pilih jenis surat untuk melihat persyaratan.

                            </div>
                        </div>

                        <!-- Keperluan Permohonan -->
                        <div class="mb-3">

                            <label class="form-label fw-medium text-dark small mb-2">
                                Maksud & Keperluan Surat
                            </label>

                            <textarea class="form-control form-control-modern" rows="3" name="keperluan" required
                                placeholder="Contoh: Persyaratan administrasi mendaftar beasiswa pendidikan..." style="resize:none;"></textarea>

                        </div>

                        <div id="formUsaha" style="display:none;">

                            <div class="mb-3">

                                <label class="form-label">
                                    Nama Usaha
                                </label>

                                <input type="text" class="form-control" name="nama_usaha" id="nama_usaha">

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Jenis Usaha
                                </label>

                                <input type="text" class="form-control" name="jenis_usaha" id="jenis_usaha">

                            </div>

                        </div>

                        <!-- Unggah Lampiran Persyaratan -->
                        <div class="mb-4">

                            <label class="form-label fw-medium text-dark small mb-2">
                                Dokumen Persyaratan
                            </label>

                            <div id="wrapper-persyaratan" class="border rounded-3 p-3 bg-light">

                                <div class="text-center text-muted small">

                                    <i class="bi bi-folder2-open fs-3 d-block mb-2"></i>

                                    Silakan pilih jenis surat terlebih dahulu.

                                </div>

                            </div>

                        </div>

                        <!-- Tombol Footer Langkah Kedua -->
                        <div class="modal-footer border-0 p-0 gap-2">
                            <button type="button"
                                class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                                id="btnKembaliPengajuan">
                                Kembali
                            </button>
                            <button type="submit" id="btnSubmitPengajuan"
                                class="btn btn-success text-white rounded-3 px-4 fw-medium">

                                <i class="bi bi-check-circle me-1"></i>

                                Kirim Pengajuan

                            </button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
