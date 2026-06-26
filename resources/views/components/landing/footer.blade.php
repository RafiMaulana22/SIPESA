<footer class="footer-section">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <h5 class="fw-bold text-white mb-3" style="letter-spacing: -0.01em;">
                    SIPESA
                </h5>
                <p style="font-size: 0.95rem; line-height: 1.6;">
                    Sistem Pelayanan Surat Desa Payudan-Dungdang yang memudahkan masyarakat dalam pengajuan surat secara
                    online dengan validasi NIK dan sistem antrian FIFO.
                </p>
            </div>

            <div class="col-lg-2 col-md-6 ms-lg-auto">
                <h6 class="fw-semibold text-white mb-3">
                    Menu Utama
                </h6>
                <ul class="list-unstyled">
                    <li><a href="{{ route('landing.home') }}" class="footer-link">Beranda</a></li>
                    <li><a href="{{ route('landing.profil') }}" class="footer-link">Profil Desa</a></li>
                    <li><a href="{{ route('landing.layanan') }}" class="footer-link">Layanan Surat</a></li>
                    <li><a href="{{ route('landing.berita') }}" class="footer-link">Berita</a></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="fw-semibold text-white mb-3">
                    Jenis Layanan
                </h6>
                <ul class="list-unstyled">
                    <li class="footer-item-text">Surat Domisili</li>
                    <li class="footer-item-text">Surat Keterangan Usaha</li>
                    <li class="footer-item-text">Surat Keterangan Tidak Mampu</li>
                    <li class="footer-item-text">Surat Pengantar SKCK</li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <h6 class="fw-semibold text-white mb-3">
                    Kontak Desa
                </h6>
                <div class="d-flex align-items-start gap-2 mb-2.5">
                    <i class="bi bi-geo-alt text-primary fs-5 mt-0.5"></i>
                    <p class="m-0" style="font-size: 0.95rem;">Desa Payudan-Dungdang, Kabupaten Sumenep</p>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2.5">
                    <i class="bi bi-telephone text-primary fs-5"></i>
                    <p class="m-0" style="font-size: 0.95rem;">(0328) 123456</p>
                </div>
                <div class="d-flex align-items-center gap-2 mb-3">
                    <i class="bi bi-envelope text-primary fs-5"></i>
                    <p class="m-0" style="font-size: 0.95rem;">desapayudan@example.com</p>
                </div>

                <div class="d-flex gap-2 mt-4">
                    <a href="#" class="social-link" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Youtube">
                        <i class="bi bi-youtube"></i>
                    </a>
                </div>
            </div>

        </div>

        <div class="footer-bottom text-center">
            <small style="font-size: 0.85rem; font-weight: 300; opacity: 0.8;">
                &copy; {{ date('Y') }} SIPESA &mdash; Sistem Pelayanan Surat Desa Payudan-Dungdang. All Rights
                Reserved.
            </small>
        </div>
    </div>
</footer>
