<div class="modal fade" id="ModalHapus{{ $get->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden bg-white">
            <form action="{{ route('penduduk.destroy', $get->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header border-0 pb-0 pt-4 px-4 d-flex align-items-start justify-content-between">
                    <div>
                        <h5 class="modal-title fw-bold " style="letter-spacing: -0.01em;">Peringatan
                            Penting !</h5>
                        <p class="text-muted small m-0 mt-1">Konfirmasi penghapusan data penduduk permanen.</p>
                    </div>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 text-secondary">
                    Apakah Anda benar-benar yakin ingin menghapus data kependudukan atas nama:<br>
                    <strong class=" d-block mt-2 fs-6"><i class="bi bi-person-x text-danger me-1"></i>
                        {{ $get->nama }}</strong>
                    <span class="text-danger small mt-2 d-block"><i class="bi bi-info-circle"></i> Catatan:
                        Tindakan ini akan menghapus data pelaporan terkait dari riwayat FIFO layanan.</span>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4 gap-2">
                    <button type="button"
                        class="btn btn-light rounded-3 px-4 fw-medium text-secondary flex-grow-1 flex-sm-grow-0"
                        data-bs-dismiss="modal">Batal</button>
                    <button type="submit"
                        class="btn btn-danger rounded-3 px-4 fw-medium flex-grow-1 flex-sm-grow-0">Ya, Hapus
                        Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
