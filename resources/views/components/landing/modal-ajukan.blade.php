<div class="modal fade" id="ajukanSuratModal" tabindex="-1" aria-labelledby="ajukanSuratModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

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

            <form action="#" method="POST">
                @csrf
                <div class="modal-body p-4">

                    <div class="text-center mb-4">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center animate-pulse"
                            style="width: 72px; height: 72px;">
                            <i class="bi bi-person-vcard text-primary fs-2"></i>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium text-dark small mb-2">
                            Nomor Induk Kependudukan (NIK)
                        </label>
                        <input type="text" class="form-control form-control-modern" name="nik" maxlength="16"
                            inputmode="numeric" pattern="[0-9]*" placeholder="Contoh: 3529xxxxxxxxxxxx" required>
                        <div class="form-text text-muted mt-2" style="font-size: 0.8rem; line-height: 1.4;">
                            <i class="bi bi-shield-check text-success me-1"></i> Pastikan NIK Anda sudah terdaftar di
                            database Desa Payudan-Dungdang.
                        </div>
                    </div>

                    <div class="alert alert-custom d-flex gap-3 m-0">
                        <i class="bi bi-info-circle text-primary fs-5 mt-0.5"></i>
                        <div class="small text-secondary" style="line-height: 1.5;">
                            Setelah NIK berhasil divalidasi, sistem akan mengarahkan Anda ke formulir pengisian data
                            berkas berkas surat.
                        </div>
                    </div>

                </div>

                <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                    <button type="button"
                        class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                        data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">
                        <i class="bi bi-arrow-right-circle me-1.5"></i>Validasi NIK
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
