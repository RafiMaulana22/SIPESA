<!-- AREA NOTIFIKASI SYSTEM -->
@if ($errors->any())
    <div class="alert alert-danger rounded-3 mb-4 small border-0 shadow-sm">
        <ul class="mb-0 ps-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4 small border-0 shadow-sm d-flex align-items-center gap-2"
        id="alertSuccess" role="alert">
        <i class="bi bi-check-circle-fill fs-5"></i>
        <div>
            <strong>Berhasil!</strong> {{ session('success') }}
        </div>
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close"></button>
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
