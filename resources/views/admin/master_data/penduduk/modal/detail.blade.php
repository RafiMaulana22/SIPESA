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
                            (NIK)
                        </label>
                        <input type="text" class="form-control bg-light border-0 py-2.5  fw-bold rounded-3"
                            value="{{ $get->nik }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small fw-medium mb-1">Nomor Kartu Keluarga (KK)</label>
                        <input type="text" class="form-control bg-light border-0 py-2.5  rounded-3"
                            value="{{ $get->no_kk }}" readonly>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label text-muted small fw-medium mb-1">Nama Lengkap Sesuai KTP</label>
                        <input type="text" class="form-control bg-light border-0 py-2.5  fw-semibold rounded-3"
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
                        <input type="text" class="form-control bg-light border-0 py-2.5 text-center  rounded-3"
                            value="{{ $get->rt }}" readonly>
                    </div>
                    <div class="col-md-2 col-6">
                        <label class="form-label text-muted small fw-medium mb-1">RW</label>
                        <input type="text" class="form-control bg-light border-0 py-2.5 text-center  rounded-3"
                            value="{{ $get->rw }}" readonly>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label text-muted small fw-medium mb-1">Status Perkawinan</label>
                        <div>
                            <span
                                class="badge bg-secondary bg-opacity-10  border border-secondary border-opacity-10 px-3 py-2 rounded-2 fw-medium">
                                Status: {{ $get->status_perkawinan ?? '-' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-3 px-4 fw-medium text-secondary w-100 w-sm-auto"
                    data-bs-dismiss="modal">Tutup Rincian</button>
            </div>
        </div>
    </div>
</div>
