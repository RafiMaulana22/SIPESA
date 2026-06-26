<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('landing.home') }}">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Desa" width="42" height="42"
                class="object-fit-contain">
            <div class="brand-text">
                <div class="fw-bold text-primary lh-1 mb-1" style="font-size: 1.25rem; letter-spacing: -0.01em;">
                    SIPESA
                </div>
                <small class="text-muted d-block lh-1" style="font-size: 0.75rem; font-weight: 400;">
                    Sistem Pelayanan Surat Desa
                </small>
            </div>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSipesa" aria-controls="navbarSipesa" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSipesa">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-1 gap-lg-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('landing.home') ? 'active' : '' }}"
                        href="{{ route('landing.home') }}">
                        Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('landing.profil') ? 'active' : '' }}"
                        href="{{ route('landing.profil') }}">
                        Profil Desa
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('landing.layanan') ? 'active' : '' }}"
                        href="{{ route('landing.layanan') }}">
                        Layanan Surat
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('landing.berita') ? 'active' : '' }}"
                        href="{{ route('landing.berita') }}">
                        Berita
                    </a>
                </li>
            </ul>

            <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-2 mt-3 mt-lg-0 ms-lg-3">
                <button class="btn btn-outline-primary rounded-pill px-3" data-bs-toggle="modal"
                    data-bs-target="#cekStatusModal">
                    <i class="bi bi-search me-1.5"></i>Cek Status
                </button>

                <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal"
                    data-bs-target="#ajukanSuratModal">
                    <i class="bi bi-file-earmark-plus me-1.5"></i>Ajukan Surat
                </button>

                <a href="/login" class="btn btn-dark rounded-pill px-4 ms-lg-1">
                    <i class="bi bi-box-arrow-in-right me-1.5"></i>Login Admin
                </a>
            </div>
        </div>

    </div>
</nav>
