<div class="modal fade" id="cekStatusModal" tabindex="-1" aria-labelledby="cekStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">

            <!-- Header Modal -->
            <div class="modal-header border-0 pb-0 pt-4 px-4 position-relative">
                <div class="w-100 text-center">
                    <!-- Ilustrasi Ikon Pencarian -->
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                        style="width: 72px; height: 72px;">
                        <i class="bi bi-search text-primary fs-3"></i>
                    </div>

                    <h5 class="modal-title fw-bold text-dark mb-1" id="cekStatusModalLabel"
                        style="letter-spacing: -0.01em;">
                        Cek Riwayat Pengajuan Surat
                    </h5>
                    <p class="text-muted small mb-0 mx-auto" style="max-width: 380px;">
                        Masukkan NIK Anda untuk melacak dan melihat seluruh riwayat permohonan surat pelayanan.
                    </p>
                </div>
                <button type="button" class="btn-close position-absolute end-0 top-0 m-3 shadow-none"
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form Eksekusi -->
            <form id="formCekStatus">
                <div class="modal-body p-4">

                    <!-- Input NIK -->
                    <div class="mb-4">
                        <label class="form-label fw-medium text-dark small mb-2">
                            Nomor Induk Kependudukan (NIK)
                        </label>
                        <input type="text" class="form-control form-control-modern" name="nik" maxlength="16"
                            minlength="16" inputmode="numeric" pattern="[0-9]*" placeholder="Masukkan 16 digit NIK Anda"
                            required oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        <div class="form-text text-muted mt-2" style="font-size: 0.8rem; line-height: 1.4;">
                            <i class="bi bi-shield-check text-success me-1"></i> Pastikan NIK sesuai dengan database
                            resmi Desa Payudan-Dungdang.
                        </div>
                    </div>

                    <!-- Kotak Informasi Alur Fitur -->
                    <div class="alert alert-custom p-3 m-0">
                        <div class="small fw-semibold text-dark mb-2.5 d-flex align-items-center gap-1.5">
                            <i class="bi bi-info-circle text-primary fs-5"></i> Fitur Pelacakan Riwayat:
                        </div>
                        <ul class="list-unstyled text-muted m-0 small d-flex flex-column gap-2">
                            <li class="d-flex align-items-center gap-2">
                                <i class="bi bi-dot text-primary fs-4 lh-1"></i>
                                <span class="text-secondary">Menampilkan seluruh trek rekam pengajuan surat.</span>
                            </li>
                            <li class="d-flex align-items-center gap-2">
                                <i class="bi bi-dot text-primary fs-4 lh-1"></i>
                                <span class="text-secondary">Memantau update status berkas secara berkala.</span>
                            </li>
                            <li class="d-flex align-items-center gap-2">
                                <i class="bi bi-dot text-primary fs-4 lh-1"></i>
                                <span class="text-secondary">Melihat catatan verifikasi dari operator desa.</span>
                            </li>
                            <li class="d-flex align-items-center gap-2">
                                <i class="bi bi-dot text-primary fs-4 lh-1"></i>
                                <span class="text-secondary">Mengunduh dokumen mandiri jika selesai diarsip.</span>
                            </li>
                        </ul>
                    </div>

                </div>

                <!-- Footer Modal -->
                <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                    <button type="button"
                        class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                        data-bs-dismiss="modal">
                        Tutup
                    </button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">
                        <i class="bi bi-search me-1.5"></i> Lihat Riwayat
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
