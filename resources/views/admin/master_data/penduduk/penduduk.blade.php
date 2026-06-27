@extends('admin.components.template_admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" id="alertSuccess" role="alert">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                        <strong>Success!</strong>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                    <script>
                        setTimeout(function() {
                            let alertElement = document.getElementById('alertSuccess');
                            if (alertElement) {
                                let bsAlert = new bootstrap.Alert(alertElement);
                                bsAlert.close();
                            }
                        }, 2000);
                    </script>
                @endif
                <div class="card-header">
                    <h4 class="card-title">Data Penduduk</h4>
                    <div>
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                            data-bs-target="#modalTambah">
                            <i class="fa fa-plus me-1"></i> Add Data
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>KK</th>
                                    <th>Nama</th>
                                    <th>jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penduduk as $get)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $get->nik }}</td>
                                        <td>{{ $get->no_kk }}</td>
                                        <td>{{ $get->nama }}</td>
                                        <td>{{ $get->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                        <td>{{ $get->alamat }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-success shadow btn-xs sharp me-1"
                                                    data-bs-toggle="modal" data-bs-target="#detailModal{{ $get->id }}"
                                                    title="Detail Data">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button class="btn btn-primary shadow btn-xs sharp me-1"
                                                    data-bs-toggle="modal" data-bs-target="#editModal{{ $get->id }}">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <a href="#ModalHapus{{ $get->id }}" data-bs-toggle="modal"
                                                    class="btn btn-danger shadow btn-xs sharp" data-bs-toggle="modal"><i
                                                        class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @foreach ($penduduk as $get)
                        <!-- Modal Detail -->
                        <div class="modal fade" id="detailModal{{ $get->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="fa fa-info-circle me-2"></i>Detail Data Penduduk :
                                            {{ $get->nama }}
                                        </h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">NIK</label>
                                                <input type="text" class="form-control" value="{{ $get->nik }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">No. KK</label>
                                                <input type="text" class="form-control" value="{{ $get->no_kk }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" value="{{ $get->nama }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control" value="{{ $get->tempat_lahir }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Tanggal Lahir</label>
                                                <input type="date" class="form-control"
                                                    value="{{ \Carbon\Carbon::parse($get->tanggal_lahir)->format('Y-m-d') }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Jenis Kelamin</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $get->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Alamat</label>
                                                <input type="text" class="form-control" value="{{ $get->alamat }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">RT</label>
                                                <input type="text" class="form-control" value="{{ $get->rt }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">RW</label>
                                                <input type="text" class="form-control" value="{{ $get->rw }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">No. HP</label>
                                                <input type="text" class="form-control" value="{{ $get->no_hp }}"
                                                    readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">Status Penduduk</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $get->status_penduduk }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">
                                            <i class="fa fa-times"></i> Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $get->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('penduduk.update', $get->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="fa fa-pencil me-2"></i>Edit Data Penduduk : {{ $get->nama }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">NIK</label>
                                                    <input type="text" name="nik" class="form-control"
                                                        maxlength="16" value="{{ $get->nik }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">No. KK</label>
                                                    <input type="text" name="no_kk" class="form-control"
                                                        maxlength="16" value="{{ $get->no_kk }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $get->nama }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Tempat Lahir</label>
                                                    <input type="text" name="tempat_lahir" class="form-control"
                                                        value="{{ $get->tempat_lahir }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Tanggal Lahir</label>
                                                    <input type="date" name="tanggal_lahir" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($get->tanggal_lahir)->format('Y-m-d') }}"
                                                        required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Jenis Kelamin</label>
                                                    <select name="jenis_kelamin" class="form-control" required>
                                                        <option value="">-- Pilih Jenis Kelamin --
                                                        </option>
                                                        <option value="L"
                                                            {{ $get->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                            Laki-Laki
                                                        </option>
                                                        <option value="P"
                                                            {{ $get->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                            Perempuan
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Alamat</label>
                                                    <input type="text" class="form-control"
                                                        value="{{ $get->alamat }}" required>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">RT</label>

                                                    <input type="text" name="rt" class="form-control"
                                                        maxlength="3" value="{{ $get->rt }}" required>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label class="form-label">RW</label>
                                                    <input type="text" name="rw" class="form-control"
                                                        maxlength="3" value="{{ $get->rw }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">No. HP</label>
                                                    <input type="text" name="no_hp" class="form-control"
                                                        maxlength="15" value="{{ $get->no_hp }}">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">Status Penduduk</label>
                                                    <select name="status_penduduk" class="form-control">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="Tetap"
                                                            {{ $get->status_penduduk == 'Tetap' ? 'selected' : '' }}>
                                                            Tetap
                                                        </option>
                                                        <option value="Pendatang"
                                                            {{ $get->status_penduduk == 'Pendatang' ? 'selected' : '' }}>
                                                            Pendatang
                                                        </option>
                                                        <option value="Pindah"
                                                            {{ $get->status_penduduk == 'Pindah' ? 'selected' : '' }}>
                                                            Pindah
                                                        </option>
                                                        <option value="Meninggal"
                                                            {{ $get->status_penduduk == 'Meninggal' ? 'selected' : '' }}>
                                                            Meninggal
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">
                                                <i class="fa fa-times"></i> Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade" id="ModalHapus{{ $get->id }}" tabindex="-1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('penduduk.destroy', $get->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Peringatan !!!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda Yakin Menghapus Data dengan Nama
                                            <br><b>{{ $get->nama }}</b>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger light"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('penduduk.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-plus-circle me-2"></i>Tambah Data Penduduk
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" name="nik" class="form-control" maxlength="16" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. KK</label>
                                <input type="text" name="no_kk" class="form-control" maxlength="16" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alamat</label>
                                <input name="alamat" rows="3" class="form-control" required></input>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">RT</label>
                                <input type="text" name="rt" class="form-control" maxlength="3" required>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label">RW</label>
                                <input type="text" name="rw" class="form-control" maxlength="3" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">No. HP</label>
                                <input type="text" name="no_hp" class="form-control" maxlength="15">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status Penduduk</label>
                                <select name="status_penduduk" class="form-control">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Tetap">Tetap</option>
                                    <option value="Pendatang">Pendatang</option>
                                    <option value="Pindah">Pindah</option>
                                    <option value="Meninggal">Meninggal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
