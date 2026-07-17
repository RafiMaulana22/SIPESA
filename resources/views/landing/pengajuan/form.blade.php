@extends('layouts.landing')

@section('content')
    <section class="py-5 bg-light">
        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="mb-4">
                        <h2 class="fw-bold mb-2">
                            Form Pengajuan Surat
                        </h2>

                        <p class="text-muted mb-0">
                            Lengkapi data berikut untuk mengajukan surat pelayanan Desa Payudan-Dungdang.
                        </p>
                    </div>

                    <form id="formPengajuan" action="{{ route('landing.form-pengajuan') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <input type="hidden" name="penduduk_id" value="{{ $penduduk->id }}">

                        <div class="card shadow-sm border-0 rounded-4 mb-4">

                            <div class="card-header bg-primary text-white rounded-top-4">

                                <h5 class="mb-0">

                                    Data Penduduk

                                </h5>

                            </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            NIK

                                        </label>

                                        <input type="text" class="form-control" value="{{ $penduduk->nik }}" readonly>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            Nama

                                        </label>

                                        <input type="text" class="form-control" value="{{ $penduduk->nama }}" readonly>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            RT

                                        </label>

                                        <input type="text" class="form-control" value="{{ $penduduk->rt }}" readonly>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label class="form-label">

                                            RW

                                        </label>

                                        <input type="text" class="form-control" value="{{ $penduduk->rw }}" readonly>

                                    </div>

                                    <div class="col-12">

                                        <label class="form-label">

                                            Alamat

                                        </label>

                                        <textarea class="form-control" rows="3" readonly>{{ $penduduk->alamat }}</textarea>

                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="card shadow-sm border-0 rounded-4">

                            <div class="card-header bg-success text-white rounded-top-4">

                                <h5 class="mb-0">

                                    Form Pengajuan Surat

                                </h5>

                            </div>

                            <div class="card-body">

                                <div class="mb-3">

                                    <label class="form-label">

                                        Kategori Surat

                                    </label>

                                    <select class="form-select" id="kategori_surat">

                                        <option value="">

                                            -- Pilih Kategori --

                                        </option>

                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}">

                                                {{ $item->nama_kategori }}

                                            </option>
                                        @endforeach

                                    </select>

                                </div>


                                <div class="mb-3">

                                    <label class="form-label">

                                        Jenis Surat

                                    </label>

                                    <select class="form-select" id="jenis_surat" name="jenis_surat_id" required>

                                        <option value="">

                                            -- Pilih Jenis Surat --

                                        </option>

                                    </select>

                                </div>


                                <div class="mb-3">

                                    <label class="form-label">

                                        Keperluan

                                    </label>

                                    <textarea class="form-control" rows="4" name="keperluan" required></textarea>

                                </div>


                                <div id="usaha-wrapper" style="display:none;">

                                    <div class="mb-3">

                                        <label class="form-label">

                                            Nama Usaha

                                        </label>

                                        <input type="text" class="form-control" name="nama_usaha">

                                    </div>

                                    <div class="mb-3">

                                        <label class="form-label">

                                            Jenis Usaha

                                        </label>

                                        <input type="text" class="form-control" name="jenis_usaha">

                                    </div>

                                </div>


                                <div class="mb-4">

                                    <label class="form-label">

                                        Persyaratan

                                    </label>

                                    <div id="wrapper-persyaratan" class="border rounded-3 p-4 bg-light">

                                        <div class="text-center text-muted">

                                            Pilih jenis surat terlebih dahulu.

                                        </div>

                                    </div>

                                </div>


                                <div class="d-flex justify-content-between">

                                    <a href="{{ route('landing.home') }}" class="btn btn-secondary">

                                        Kembali

                                    </a>

                                    <button type="submit" class="btn btn-success" id="btnSubmitPengajuan">

                                        Kirim Pengajuan

                                    </button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.getElementById("formPengajuan").addEventListener("submit", function(e) {
            e.preventDefault();

            const btn = document.getElementById("btnSubmitPengajuan");
            btn.disabled = true;
            btn.innerHTML = "Mengirim...";

            let formData = new FormData(this);

            fetch(this.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json"
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(res => {

                    btn.disabled = false;
                    btn.innerHTML = "Kirim Pengajuan";

                    if (res.status) {

                        Swal.fire({
                            icon: "success",
                            title: "Pengajuan Berhasil",
                            html: `
                    <p>Pengajuan surat berhasil dikirim.</p>
                    <h4 class="text-primary">${res.kode_pengajuan}</h4>
                    <small>Simpan kode ini untuk mengecek status pengajuan.</small>
                `
                        }).then(() => {
                            window.location.href = "{{ route('landing.home') }}";
                        });

                    } else {

                        Swal.fire({
                            icon: "error",
                            title: "Gagal",
                            text: res.message
                        });

                    }

                });
        });
    </script>
@endpush
