@extends('admin.components.template_admin')

@section('content')
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1" style="letter-spacing: -0.02em;">
                Detail Pengajuan Surat
            </h3>
            <p class="text-muted small mb-0">
                Informasi rinci berkas permohonan surat dan verifikasi data pemohon.
            </p>
        </div>
        <div>
            <a href="/pengajuan-surat"
                class="btn btn-light border text-secondary px-4 rounded-3 fw-medium d-inline-flex align-items-center gap-2 shadow-none transition-base">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card bg-white border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white p-4 border-0 pb-0">
                <h5 class="mb-0 fw-bold " style="letter-spacing: -0.01em;">
                    Informasi Pengajuan
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="text-muted small d-block mb-1 fw-medium">Kode Pengajuan</label>
                        <p class=" fw-bold m-0 fs-5">{{ $pengajuan->kode_pengajuan }}</p>
                    </div>

                    <div class="col-sm-6">
                        <label class="text-muted small d-block mb-1 fw-medium">Nomor Antrean FIFO</label>
                        <div class="m-0">
                            <span
                                class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-2.5 py-1.5 rounded-2 fw-semibold">
                                #{{ sprintf('%03d', $pengajuan->nomor_antrian) }}
                            </span>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label class="text-muted small d-block mb-1 fw-medium">Tanggal Masuk Sistem</label>
                        <p class=" fw-medium m-0">{{ $pengajuan->tanggal_pengajuan->translatedFormat('d F Y') }}</p>
                    </div>

                    <div class="col-sm-6">
                        <label class="text-muted small d-block mb-1 fw-medium">Status Berkas</label>
                        <div class="m-0">
                            @if ($pengajuan->status == 'menunggu')
                                <span
                                    class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                    Menunggu
                                </span>
                            @elseif($pengajuan->status == 'diproses')
                                <span
                                    class="badge bg-info-subtle text-info-emphasis border border-info-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                    Diproses
                                </span>
                            @elseif($pengajuan->status == 'selesai')
                                <span
                                    class="badge bg-success-subtle text-success-emphasis border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                    Selesai
                                </span>
                            @else
                                <span
                                    class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                    Ditolak
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label class="text-muted small d-block mb-1 fw-medium">Jenis Dokumen Surat</label>
                        <p class=" fw-medium m-0">{{ $pengajuan->jenisSurat->nama_surat }}</p>
                    </div>

                    <div class="col-sm-6">
                        <label class="text-muted small d-block mb-1 fw-medium">Kategori Klasifikasi</label>
                        <p class=" fw-medium m-0">{{ $pengajuan->jenisSurat->kategoriSurat->nama_kategori }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card bg-white border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white p-4 border-0 pb-0">
                <h5 class="mb-0 fw-bold " style="letter-spacing: -0.01em;">
                    Data Kependudukan Penduduk
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-borderless align-middle m-0" style="font-size: 0.95rem;">
                        <tbody>
                            <tr>
                                <td class="text-muted fw-medium py-2" style="width: 240px;">Nomor Induk Kependudukan
                                    (NIK)</td>
                                <td class=" fw-bold py-2">: {{ $pengajuan->penduduk->nik }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-medium py-2">Nama Lengkap Sesuai KTP</td>
                                <td class=" fw-semibold py-2">: {{ $pengajuan->penduduk->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-medium py-2">Jenis Kelamin</td>
                                <td class=" py-2">: {{ $pengajuan->penduduk->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-medium py-2">Tempat, Tanggal Lahir</td>
                                <td class=" py-2">: {{ $pengajuan->penduduk->tempat_lahir }},
                                    {{ \Carbon\Carbon::parse($pengajuan->penduduk->tanggal_lahir)->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted fw-medium py-2">Alamat Domisili Asli</td>
                                <td class=" py-2">: {{ $pengajuan->penduduk->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-white p-4 border-0 pb-0">
                <h5 class="mb-0 fw-bold " style="letter-spacing: -0.01em;">
                    Berkas Lampiran Persyaratan
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3 py-3 text-muted fw-semibold">Nama Lampiran Berkas</th>
                                <th class="py-3 text-muted fw-semibold">Status Verifikasi</th>
                                <th class="pe-3 py-3 text-end text-muted fw-semibold">Tindakan Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengajuan->lampiran as $lampiran)
                                <tr>
                                    <td class="ps-3  fw-medium"{{ $lampiran->persyaratan->nama_persyaratan }} </td>
                                    <td>
                                        @if ($lampiran->status == 'valid')
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">Lengkap</span>
                                        @elseif($lampiran->status == 'ditolak')
                                            <span
                                                class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">Ditolak</span>
                                        @else
                                            <span
                                                class="badge bg-warning-subtle text-warning border border-warning-subtle px-2.5 py-1.5 rounded-2 fw-medium">Menunggu</span>
                                        @endif
                                    </td>
                                    <td class="pe-3 text-end">
                                        <a target="_blank" href="{{ Storage::url($lampiran->file) }}"
                                            class="btn btn-sm btn-light border text-primary px-3 rounded-2 fw-medium shadow-none">
                                            <i class="bi bi-eye me-1"></i> Periksa File
                                        </a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="card bg-white border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white p-4 border-0 pb-0">
                <h5 class="mb-0 fw-bold " style="letter-spacing: -0.01em;">
                    Jejak Log Timeline
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-column gap-3">
                    @foreach ($pengajuan->logs as $log)
                        <div class="d-flex gap-3 position-relative">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center p-2 mt-1"
                                style="width: 32px; height: 32px; flex-shrink: 0;">
                                <i class="bi bi-file-earmark-plus small"></i>
                            </div>
                            <div>
                                <span class=" fw-bold d-block small">{{ $log->aktivitas }}</span>
                                <small class="text-muted d-block mt-0.5"
                                    style="font-size: 0.75rem;">{{ $log->created_at->translatedFormat('d F Y H:i') }}</small>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card bg-white border-0 shadow-sm rounded-4 mb-4">
            <div class="card-header bg-white p-4 border-0 pb-0">
                <h5 class="mb-0 fw-bold " style="letter-spacing: -0.01em;">
                    Catatan Peninjauan Operator
                </h5>
            </div>
            <div class="card-body p-4">
                <textarea class="form-control border bg-light bg-opacity-50 p-3 rounded-3 shadow-none  small" rows="5"
                    name="catatan_admin"
                    placeholder="Masukkan alasan penolakan berkas atau catatan tambahan operasional cetak dokumen...">{{ old('catatan_admin', $pengajuan->catatan_admin) }}
</textarea>
            </div>
        </div>

        <div class="card bg-white border-0 shadow-sm rounded-4">
            <div class="card-header bg-white p-4 border-0 pb-0">
                <h5 class="mb-0 fw-bold " style="letter-spacing: -0.01em;">
                    Tindakan Berkas Eksekusi
                </h5>
            </div>
            <div class="card-body p-4 d-grid gap-2">
                <form method="POST" action="{{ route('pengajuan-surat.setujui', $pengajuan) }}">

                    @csrf
                    <button
                        class="btn btn-success rounded-3 py-2.5 fw-medium shadow-none transition-base d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-play-circle fs-5"></i> Setujui & Proses Surat
                    </button>
                </form>
                <form method="POST" action="{{ route('pengajuan-surat.tolak', $pengajuan) }}">

                    @csrf
                    <input type="hidden" name="catatan_admin" id="catatan_admin">

                    <button
                        class="btn btn-danger rounded-3 py-2.5 fw-medium shadow-none transition-base d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-x-circle fs-5"></i> Tolak Pengajuan Berkas
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection
