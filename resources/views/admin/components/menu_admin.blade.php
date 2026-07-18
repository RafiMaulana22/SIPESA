<ul class="metismenu" id="menu">
    <li>
        <a class="ai-icon" href="{{ route('dashboard') }}" aria-expanded="false">
            <i class="flaticon-381-networking"></i>
            <span class="nav-text">Dashboard</span>
        </a>
    </li>
    @if (Auth::user()->role == 'admin')
        <li>
            <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                <i class="flaticon-381-television"></i>
                <span class="nav-text">Master Data</span>
            </a>
            <ul aria-expanded="false">
                <li><a href="{{ route('penduduk.index') }}">Penduduk</a></li>
                <li><a href="{{ route('kategori-surat.index') }}">Kategori Surat</a></li>
                <li><a href="{{ route('jenis-surat.index') }}">Jenis Surat</a></li>
                <li><a href="{{ route('template-surat.index') }}">Template Surat</a></li>
            </ul>
        </li>
    @endif
    <li>
        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="flaticon-381-briefcase"></i>
            <span class="nav-text">Pelayanan</span>
        </a>
        <ul aria-expanded="false">
            <li>
                <a href="/pengajuan-surat">Pengajuan Surat</a>
            </li>
            <li>
                <a href="/arsip-digital">Arsip Digital</a>
            </li>
        </ul>
    </li>
    @if (Auth::user()->role == 'kepala_desa')
        <li>
            <a class="ai-icon" href="{{ route('manajemen-user.index') }}" aria-expanded="false">
                <i class="flaticon-381-networking"></i>
                <span class="nav-text">Manajemen User</span>
            </a>
        </li>
    @endif

    {{--  <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="flaticon-381-internet"></i>
            <span class="nav-text">Informasi</span>
        </a>
        <ul aria-expanded="false">
            <li><a href="chart-flot.html">Profile Desa</a></li>
            <li><a href="chart-flot.html">Berita</a></li>

        </ul>
    </li>
    <li><a class="ai-icon" href="javascript:void()" aria-expanded="false">
            <i class="flaticon-381-notepad"></i>
            <span class="nav-text">Laporan</span>
        </a>
    </li>
    <li><a href="widget-basic.html" class="ai-icon" aria-expanded="false">
            <i class="flaticon-381-settings-2"></i>
            <span class="nav-text">Pengaturan</span>
        </a>
    </li>  --}}
</ul>
<div class="copyright">
    <p><strong>SIPESA Admin Dashboard</strong> © 2026 All Rights Reserved</p>
    <p>Made with <span class="heart"></span> by SUPERSITESTUDIO</p>
</div>
