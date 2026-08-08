<div class="modal fade" id="modalImport" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow">

            <form action="{{ route('penduduk.import') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="modal-header border-0">

                    <h5 class="fw-bold">
                        Import Data Penduduk
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="alert alert-info">

                        Upload file Excel (.xlsx atau .xls)
                        yang berisi data penduduk.

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            File Excel

                        </label>

                        <input type="file" class="form-control" name="file" accept=".xlsx,.xls" required>

                    </div>

                    <a href="{{ asset('template/template_penduduk.xlsx') }}" class="btn btn-link p-0">

                        Download Template Excel

                    </a>

                </div>

                <div class="modal-footer border-0">

                    <button class="btn btn-light" data-bs-dismiss="modal" type="button">

                        Batal

                    </button>

                    <button class="btn btn-success">

                        <i class="bi bi-upload"></i>

                        Import

                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
