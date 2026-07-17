@extends('admin.components.template_admin')

@section('content')
    <!-- HEADER UTAMA -->
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold  mb-1" style="letter-spacing: -0.02em;">
                Manajemen User
            </h3>
            <p class="text-muted small mb-0">
                Kelola akun pengguna dan hak akses sistem administrasi pelayanan surat.
            </p>
        </div>
        <button class="btn btn-primary rounded-3 px-4 fw-medium shadow-none transition-base d-flex align-items-center gap-2"
            data-bs-toggle="modal" data-bs-target="#modalTambahUser">
            <i class="bi bi-plus-circle-fill"></i> Tambah User
        </button>
    </div>

    <!-- SEKSI DATA TABEL -->
    <div class="card bg-white border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-header bg-white p-4 border-0 pb-0">
            <h5 class="mb-0 fw-bold " style="letter-spacing: -0.01em;">
                Daftar Pengguna Sistem
            </h5>
        </div>

        <div class="table-responsive px-2">
            <table id="example" class="table table-hover align-middle mb-0 custom-admin-table w-100">
                <thead>
                    <tr>
                        <th class="ps-3" width="8%">No</th>
                        <th>Nama Pengguna</th>
                        <th>Alamat Email</th>
                        <th width="18%">Peran / Role</th>
                        <th width="15%">Status Akun</th>
                        <th class="pe-3 text-end" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $item)
                        <tr>
                            <td class="ps-3 text-muted fw-medium">{{ $loop->iteration }}</td>
                            <td class="fw-bold ">{{ $item->name }}</td>
                            <td class="text-secondary fw-medium">{{ $item->email }}</td>
                            <td>
                                @if ($item->role == 'kepala_desa')
                                    <span
                                        class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                        Kepala Desa
                                    </span>
                                @else
                                    <span
                                        class="badge bg-primary-subtle text-primary border border-primary-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                        Operator
                                    </span>
                                @endif
                            </td>
                            <td>
                                @if ($item->status == 1)
                                    <span
                                        class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                        Aktif
                                    </span>
                                @else
                                    <span
                                        class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 fw-medium">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="pe-3 text-end">
                                <div class="d-inline-flex gap-1">
                                    <button
                                        class="btn btn-sm btn-light border text-primary px-2.5 py-1.5 rounded-2 shadow-none btnEdit"
                                        data-id="{{ $item->id }}" data-name="{{ $item->name }}"
                                        data-username="{{ $item->username }}" data-email="{{ $item->email }}"
                                        data-role="{{ $item->role }}" data-status="{{ $item->status }}"
                                        title="Ubah Akses">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button
                                        class="btn btn-sm btn-light border text-danger px-2.5 py-1.5 rounded-2 shadow-none btnHapus"
                                        data-id="{{ $item->id }}" data-name="{{ $item->name }}" title="Hapus Akun">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4 small">
                                <i class="bi bi-people d-block fs-3 mb-2 text-opacity-50 text-secondary"></i>
                                Belum ada rekam data pengguna sistem.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="pb-4"></div>
    </div>

    <!-- MODAL TAMBAH USER -->
    <div class="modal fade" id="modalTambahUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                <form action="{{ route('manajemen-user.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">Tambah User Baru</h5>
                            <p class="text-muted small m-0 mt-1">Daftarkan akun operator atau pimpinan baru ke sistem.</p>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Nama Lengkap</label>
                                <input type="text" class="form-control search-box-modern py-2.5 bg-white border"
                                    name="name" placeholder="Masukkan nama lengkap" required>
                            </div>
                            {{--  <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Username</label>
                                <input type="text" class="form-control search-box-modern py-2.5 bg-white border"
                                    name="username" placeholder="Masukkan username" required>
                            </div>  --}}
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Alamat Email</label>
                                <input type="email" class="form-control search-box-modern py-2.5 bg-white border"
                                    name="email" placeholder="nama@email.com" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Kata Sandi (Password)</label>
                                <input type="password" class="form-control search-box-modern py-2.5 bg-white border"
                                    name="password" placeholder="••••••••" required>
                            </div>
                            {{--  <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Peran Akses (Role)</label>
                                <select class="form-control default-select py-2.5 bg-white border" name="role" required>
                                    <option value="operator" selected>Operator</option>
                                    <option value="kepala_desa">Kepala Desa</option>
                                </select>
                            </div>  --}}
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Status Akun</label>
                                <select class="form-control default-select py-2.5 bg-white border" name="status" required>
                                    <option value="1" selected>Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                        <button type="button"
                            class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Simpan
                            User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT USER -->
    <div class="modal fade" id="modalEditUser" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
                <form id="formEditUser" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                        <div>
                            <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">Ubah Parameter
                                Pengguna</h5>
                            <p class="text-muted small m-0 mt-1">Perbarui hak akses atau rincian kredensial akun user.</p>
                        </div>
                        <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Nama Lengkap</label>
                                <input id="editNama" type="text"
                                    class="form-control search-box-modern py-2.5 bg-white border" name="name" required>
                            </div>
                            {{--  <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Username</label>
                                <input id="editUsername" type="text"
                                    class="form-control search-box-modern py-2.5 bg-white border" name="username"
                                    required>
                            </div>  --}}
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Alamat Email</label>
                                <input id="editEmail" type="email"
                                    class="form-control search-box-modern py-2.5 bg-white border" name="email" required>
                            </div>
                            {{--  <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Kata Sandi Baru (Opsional)</label>
                                <input type="password" class="form-control search-box-modern py-2.5 bg-white border"
                                    name="password" placeholder="••••••••">
                                <div class="form-text text-muted mt-2" style="font-size: 0.75rem;">
                                    <i class="bi bi-info-circle"></i> Kosongkan kolom input ini jika tidak ingin mengubah
                                    password user.
                                </div>
                            </div>  --}}
                            {{--  <div class="col-md-6">
                                <label class="form-label fw-medium  small mb-2">Peran Akses (Role)</label>
                                <select id="editRole" class="form-control default-select py-2.5 bg-white border"
                                    name="role" required>
                                    <option value="operator">Operator</option>
                                    <option value="kepala_desa">Kepala Desa</option>
                                </select>
                            </div>  --}}
                            <div class="col-md-12">
                                <label class="form-label fw-medium  small mb-2">Status Akun</label>
                                <select id="editStatus" class="form-control default-select py-2.5 bg-white border"
                                    name="status" required>
                                    <option value="1">Aktif</option>
                                    <option value="0">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                        <button type="button"
                            class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn btn-primary rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Update
                            User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('.btnEdit').click(function() {
            let id = $(this).data('id');

            // Memperbaiki binding pencocokan data kustom atribut komponen
            $('#editNama').val($(this).data('name'));
            // $('#editUsername').val($(this).data('username'));
            $('#editEmail').val($(this).data('email'));
            // $('#editRole').val($(this).data('role'));
            $('#editStatus').val($(this).data('status'));

            $('#formEditUser').attr('action', '/manajemen-user/' + id);
            $('#modalEditUser').modal('show');
        });
    </script>
    <script>
        $('.btnHapus').click(function() {
            let id = $(this).data('id');
            let nama = $(this).data('name');

            Swal.fire({
                title: 'Hapus Akun Pengguna?',
                text: "Anda akan menghapus akun milik: " + nama,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#475569',
                confirmButtonText: 'Ya, Hapus Akun',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('<form>', {
                            method: 'POST',
                            action: '/manajemen-user/' + id
                        })
                        .append('@csrf')
                        .append('<input type="hidden" name="_method" value="DELETE">')
                        .appendTo('body')
                        .submit();
                }
            });
        });
    </script>

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#0d6efd'
            });

            // buka kembali modal tambah
            $('#modalTambahUser').modal('show');
        </script>
    @endif

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: "{{ session('success') }}",
                confirmButtonColor: '#198754'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
                confirmButtonColor: '#dc3545'
            });
        </script>
    @endif
@endpush
