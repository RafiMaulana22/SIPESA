<div class="modal fade" id="editModal{{ $get->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
            <form action="{{ route('penduduk.update', $get->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                    <div>
                        <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">
                            Ubah Data Kependudukan
                        </h5>
                        <p class="text-muted small m-0 mt-1">Perbarui entri data kependudukan penduduk desa secara
                            akurat.</p>
                    </div>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-medium  small mb-2">Nomor NIK</label>
                            <input type="text" name="nik"
                                class="form-control search-box-modern py-2.5 bg-white border" maxlength="16"
                                value="{{ $get->nik }}" required
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium  small mb-2">Nomor Kartu Keluarga
                                (KK)</label>
                            <input type="text" name="no_kk"
                                class="form-control search-box-modern py-2.5 bg-white border" maxlength="16"
                                value="{{ $get->no_kk }}" required
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-medium  small mb-2">Nama Lengkap</label>
                            <input type="text" name="nama"
                                class="form-control search-box-modern py-2.5 bg-white border"
                                value="{{ $get->nama }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium  small mb-2">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir"
                                class="form-control search-box-modern py-2.5 bg-white border"
                                value="{{ $get->tempat_lahir }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium  small mb-2">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                class="form-control date-custom py-2.5 bg-white border"
                                value="{{ \Carbon\Carbon::parse($get->tanggal_lahir)->format('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium  small mb-2">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control default-select" required>
                                <option value="L" {{ $get->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                    Laki-Laki</option>
                                <option value="P" {{ $get->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium  small mb-2">Agama</label>
                            <select name="agama" class="form-control default-select" required>
                                @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'] as $agm)
                                    <option value="{{ $agm }}" {{ $get->agama == $agm ? 'selected' : '' }}>
                                        {{ $agm }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium  small mb-2">Pekerjaan</label>
                            <input type="text" name="pekerjaan"
                                class="form-control search-box-modern py-2.5 bg-white border"
                                value="{{ $get->pekerjaan }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium  small mb-2">No. HP / WA</label>
                            <input type="text" name="no_hp"
                                class="form-control search-box-modern py-2.5 bg-white border"
                                value="{{ $get->no_hp }}" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-medium  small mb-2">Alamat Jalan / Dusun</label>
                            <input type="text" name="alamat"
                                class="form-control search-box-modern py-2.5 bg-white border"
                                value="{{ $get->alamat }}" required>
                        </div>
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-medium  small mb-2">RT</label>
                            <input type="text" name="rt"
                                class="form-control search-box-modern py-2.5 text-center bg-white border" maxlength="3"
                                value="{{ $get->rt }}" required
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        </div>
                        <div class="col-md-3 col-6">
                            <label class="form-label fw-medium  small mb-2">RW</label>
                            <input type="text" name="rw"
                                class="form-control search-box-modern py-2.5 text-center bg-white border" maxlength="3"
                                value="{{ $get->rw }}" required
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-medium  small mb-2">Status Perkawinan</label>
                            <select name="status_perkawinan" class="form-control default-select" required>
                                @foreach (['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati'] as $stts)
                                    <option value="{{ $stts }}"
                                        {{ $get->status_perkawinan == $stts ? 'selected' : '' }}>{{ $stts }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                    <button type="button"
                        class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit"
                        class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Update Basis
                        Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
