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
                    <h4 class="card-title">Data Kategori Surat</h4>
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
                                    <th>Kode</th>
                                    <th>Nama Kategori</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $get)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $get->kode_kategori }}</td>
                                        <td>{{ $get->nama_kategori }}</td>
                                        <td>
                                            @if ($get->is_active)
                                                <span class="badge badge-success">
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="badge badge-danger">
                                                    Tidak Aktif
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <button type="button" class="btn btn-success shadow btn-xs sharp me-1"
                                                    data-bs-toggle="modal" data-bs-target="#ModalDetail{{ $get->id }}"
                                                    title="Detail">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-primary shadow btn-xs sharp me-1"
                                                    data-bs-toggle="modal" data-bs-target="#ModalEdit{{ $get->id }}"
                                                    title="Edit"><i class="fa fa-pencil"></i>
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
                    @foreach ($kategori as $get)
                        <!-- Modal Detail -->
                        <div class="modal fade" id="ModalDetail{{ $get->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="fa fa-eye me-2"></i>
                                            Detail Kategori : {{ $get->nama_kategori }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">
                                                    Kode Kategori
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{ $get->kode_kategori }}" readonly>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label">
                                                    Nama Kategori
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{ $get->nama_kategori }}" readonly>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">
                                                    Deskripsi
                                                </label>
                                                <textarea class="form-control" rows="4" readonly>{{ $get->deskripsi }}</textarea>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">
                                                    Status
                                                </label>
                                                <input type="text" class="form-control"
                                                    value="{{ $get->is_active ? 'Aktif' : 'Tidak Aktif' }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">

                                            <i class="fa fa-times"></i>
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Edit -->
                        <div class="modal fade" id="ModalEdit{{ $get->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <form action="{{ route('kategori-surat.update', $get->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="fa fa-pencil me-2"></i>
                                                Edit Kategori : {{ $get->nama_kategori }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        Kode Kategori
                                                    </label>
                                                    <input type="text" name="kode_kategori" class="form-control"
                                                        value="{{ $get->kode_kategori }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label">
                                                        Nama Kategori
                                                    </label>
                                                    <input type="text" name="nama_kategori" class="form-control"
                                                        value="{{ $get->nama_kategori }}" required>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        Deskripsi
                                                    </label>
                                                    <textarea name="deskripsi" class="form-control" rows="4">{{ $get->deskripsi }}</textarea>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        Status
                                                    </label>
                                                    <select name="is_active" class="form-control" required>
                                                        <option value="1"
                                                            {{ $get->is_active == 1 ? 'selected' : '' }}>
                                                            Aktif
                                                        </option>
                                                        <option value="0"
                                                            {{ $get->is_active == 0 ? 'selected' : '' }}>
                                                            Tidak Aktif
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">
                                                <i class="fa fa-times"></i>
                                                Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i>
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                         <!-- Modal hapus -->
                        <div class="modal fade" id="ModalHapus{{ $get->id }}" tabindex="-1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('kategori-surat.destroy', $get->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Peringatan !!!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda Yakin Menghapus Data dengan Nama
                                            <br><b>{{ $get->nama_kategori }}</b>?
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
            <form action="{{ route('kategori-surat.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-plus-circle me-2"></i>
                            Tambah Kategori Surat
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Nama Kategori
                                </label>
                                <input type="text" name="nama_kategori" class="form-control"
                                    placeholder="Masukkan nama kategori" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Status
                                </label>
                                <select name="is_active" class="form-control" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="1">
                                        Aktif
                                    </option>
                                    <option value="0">
                                        Tidak Aktif
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">
                                    Deskripsi
                                </label>
                                <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi kategori"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">
                            <i class="fa fa-times"></i>
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i>
                            Simpan
                        </button>

                    </div>

                </div>

            </form>
        </div>
    </div>
@endsection
