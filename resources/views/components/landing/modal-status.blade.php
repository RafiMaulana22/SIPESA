<div class="modal fade" id="cekStatusModal" tabindex="-1" aria-labelledby="cekStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">

            <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                <div>
                    <h5 class="modal-title fw-bold text-dark" id="cekStatusModalLabel" style="letter-spacing: -0.01em;">
                        Cek Status Pengajuan
                    </h5>
                    <p class="text-muted small m-0 mt-1">
                        Masukkan kode pengajuan atau NIK untuk melacak surat Anda.
                    </p>
                </div>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <form action="#" method="GET">
                <div class="modal-body p-4">

                    <div class="text-center mb-4">
                        <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center"
                            style="width: 72px; height: 72px;">
                            <i class="bi bi-search text-success fs-3"></i>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-medium text-dark small mb-2">
                            Kode Pengajuan / NIK
                        </label>
                        <input type="text" class="form-control form-control-modern" name="keyword"
                            placeholder="Contoh: PGJ-20260001 atau NIK Anda" required>
                        <div class="form-text text-muted mt-2" style="font-size: 0.8rem; line-height: 1.4;">
                            <i class="bi bi-info-circle me-1"></i> Gunakan kode unik yang Anda dapatkan setelah
                            mengirimkan berkas pengajuan.
                        </div>
                    </div>

                    <div class="alert alert-custom-success m-0">
                        <div class="small fw-semibold text-dark mb-2">
                            <i class="bi bi-clock-history text-success me-1.5"></i> Alur Tahapan Status Dokumen:
                        </div>
                        <div class="d-flex flex-wrap gap-1.5 dynamic-status-list">
                            <span
                                class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1.5 rounded-2 fw-medium">Menunggu</span>
                            <span
                                class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1.5 rounded-2 fw-medium">Diproses</span>
                            <span
                                class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">Selesai</span>
                            <span
                                class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">Ditolak</span>
                        </div>
                    </div>

                </div>

                <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                    <button type="button"
                        class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                        data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit"
                        class="btn btn-success rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0 text-white">
                        <i class="bi bi-search me-1.5"></i>Cari Status
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
