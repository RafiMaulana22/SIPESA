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
                    <h4 class="card-title">Data Template Surat</h4>
                    <div>
                        <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                            data-bs-target="#ModalTambah">
                            <i class="fa fa-plus me-1"></i>
                            Add Data
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display min-w850">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Surat</th>
                                    <th>Judul Surat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($template as $get)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $get->jenissurat->nama_surat }}</td>
                                        <td>{{ $get->judul_surat }}</td>
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
                    @foreach ($template as $get)
                        <!-- Modal Detail -->
                        <div class="modal fade" id="ModalDetail{{ $get->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-xl">

                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            <i class="fa fa-eye me-2"></i>
                                            Detail Template Surat
                                        </h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>

                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">
                                                    Jenis Surat
                                                </label>

                                                <input type="text" class="form-control"
                                                    value="{{ $get->jenisSurat->nama_surat }}" readonly>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">
                                                    Judul Surat
                                                </label>

                                                <input type="text" class="form-control" value="{{ $get->judul_surat }}"
                                                    readonly>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">
                                                    Isi Template Surat
                                                </label>

                                                <textarea class="form-control" rows="15" readonly>{{ $get->isi_template }}</textarea>
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
                            <div class="modal-dialog modal-xl">
                                <form action="{{ route('template-surat.update', $get->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="fa fa-pencil me-2"></i>
                                                Edit Template Surat
                                            </h5>

                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                            </button>
                                        </div>

                                        <div class="modal-body">

                                            <div class="row">

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        Jenis Surat
                                                    </label>

                                                    <select name="jenis_surat_id" class="form-control" required>

                                                        @foreach ($jenis as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->id == $get->jenis_surat_id ? 'selected' : '' }}>

                                                                {{ $item->nama_surat }}

                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        Judul Surat
                                                    </label>

                                                    <input type="text" name="judul_surat" class="form-control"
                                                        value="{{ $get->judul_surat }}" required>
                                                </div>

                                                <div class="col-md-12 mb-3">
                                                    <label class="form-label">
                                                        Isi Template Surat
                                                    </label>

                                                    <textarea name="isi_template" class="form-control" rows="15" required>{{ $get->isi_template }}</textarea>
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
                                    <form action="{{ route('jenis-surat.destroy', $get->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Peringatan !!!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda Yakin Menghapus Data dengan Nama
                                            <br><b>{{ $get->nama_surat }}</b>?
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
    <div class="modal fade" id="ModalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form action="{{ route('template-surat.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-plus-circle me-2"></i>
                            Tambah Template Surat
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">
                                    Jenis Surat
                                </label>
                                <select name="jenis_surat_id" class="form-control" required>
                                    <option value="">
                                        Pilih Jenis Surat
                                    </option>
                                    @foreach ($jenis as $get)
                                        <option value="{{ $get->id }}">
                                            {{ $get->nama_surat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">
                                    Judul Surat
                                </label>
                                <input type="text" name="judul_surat" class="form-control"
                                    placeholder="Masukkan judul surat" required>
                            </div>
                            <div class="col-md-12 mb-3">

                                <label class="form-label">
                                    Isi Template Surat
                                </label>
                                <div class="mb-3">

                                    <label class="form-label">
                                        Placeholder
                                    </label>
                                    <br>
                                    <button class="btn btn-primary btn-sm insert" type="button" data-text="{nama}">
                                        Nama
                                    </button>
                                    <button class="btn btn-primary btn-sm insert" type="button" data-text="{nik}">
                                        NIK
                                    </button>
                                    <button class="btn btn-primary btn-sm insert" type="button" data-text="{alamat}">
                                        Alamat
                                    </button>
                                    <button class="btn btn-primary btn-sm insert" type="button" data-text="{keperluan}">
                                        Keperluan
                                    </button>
                                    <button class="btn btn-primary btn-sm insert" type="button"
                                        data-text="{tanggal_surat}">
                                        Tanggal Surat
                                    </button>
                                    <button class="btn btn-primary btn-sm insert" type="button" data-text="{nama_desa}">
                                        Nama Desa
                                    </button>
                                </div>
                                <textarea id="editor" name="isi_template" class="form-control" rows="15"></textarea>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        let editor;
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(newEditor => {

                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        document.querySelectorAll('.insert').forEach(button => {
            button.addEventListener('click', function() {
                editor.model.change(writer => {
                    editor.model.insertContent(
                        writer.createText(

                            this.dataset.text

                        )
                    );
                });
            });
        });
    </script>
@endsection
