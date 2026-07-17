const formValidasi = document.getElementById("formValidasiNik");

if (formValidasi) {
    formValidasi.addEventListener("submit", function (e) {
        e.preventDefault();
        validasiNik();
    });
}

function validasiNik() {
    let nik = document.getElementById("nik").value;

    fetch(window.validasiNikUrl, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": window.csrfToken,
            Accept: "application/json",
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
            nik: nik,
        }),
    })
        .then((response) => {
            console.log(response);
            return response.json();
        })
        .then((res) => {
            console.log(res);

            if (!res.status) {
                document.getElementById("nikError").innerHTML = "";

                Swal.fire({
                    icon: "error",
                    title: "NIK Tidak Ditemukan",
                    text: "NIK yang Anda masukkan tidak terdaftar pada database penduduk.",
                    confirmButtonText: "OK",
                });

                return;
            }

            document.getElementById("nikError").innerHTML = "";

            Swal.fire({
                icon: "success",
                title: "Validasi Berhasil",
                text: "Data penduduk berhasil ditemukan. Anda akan diarahkan ke halaman pengajuan surat.",
                confirmButtonText: "Lanjut",
                allowOutsideClick: false,
            }).then(() => {
                window.location.href = res.redirect;
            });
        })
        .catch(async (err) => {
            console.log(err);

            Swal.fire({
                icon: "error",
                title: "NIK Tidak Valid",
                text: "Pastikan NIK terdiri dari 16 digit dan telah terdaftar.",
            });
        });
}

const formStatus = document.getElementById("formCekStatus");

formStatus.addEventListener("submit", function (e) {
    e.preventDefault();

    let keyword = this.keyword.value;

    fetch(window.cekStatusUrl, {
        method: "POST",

        headers: {
            "X-CSRF-TOKEN": window.csrfToken,
            Accept: "application/json",
            "Content-Type": "application/x-www-form-urlencoded",
        },

        body: new URLSearchParams({
            keyword: keyword,
        }),
    })
        .then((response) => response.json())
        .then((res) => {
            if (!res.status) {
                Swal.fire({
                    icon: "error",
                    title: "Data tidak ditemukan",
                });

                return;
            }

            document.getElementById("wrapper-input-pencarian").style.display =
                "none";
            document.getElementById("hasilStatus").style.display = "block";

            let badge = "";

            switch (res.pengajuan.status) {
                case "menunggu":
                    badge = '<span class="badge bg-secondary">Menunggu</span>';
                    break;

                case "diproses":
                    badge =
                        '<span class="badge bg-warning text-dark">Diproses</span>';
                    break;

                case "selesai":
                    badge = '<span class="badge bg-success">Selesai</span>';
                    break;

                case "ditolak":
                    badge = '<span class="badge bg-danger">Ditolak</span>';
                    break;
            }

            document.getElementById("status_badge_container").innerHTML = badge;

            document.getElementById("status_kode").innerHTML =
                res.pengajuan.kode;

            document.getElementById("status_nama").innerHTML =
                res.pengajuan.nama;

            document.getElementById("status_nik").innerHTML = res.pengajuan.nik;

            document.getElementById("status_surat").innerHTML =
                res.pengajuan.jenis_surat;

            document.getElementById("status_tanggal").innerHTML =
                res.pengajuan.tanggal;

            document.getElementById("status_catatan").innerHTML =
                res.pengajuan.catatan ?? "-";
        })
        .catch((err) => {
            console.log(err);

            Swal.fire({
                icon: "error",
                title: "Oops",
                text: "Terjadi kesalahan server.",
            });
        });
});

document
    .getElementById("btnKembaliStatus")
    .addEventListener("click", function () {
        document.getElementById("wrapper-input-pencarian").style.display =
            "block";

        document.getElementById("hasilStatus").style.display = "none";

        document.getElementById("formCekStatus").reset();

        document.getElementById("status_badge_container").innerHTML = "";
        document.getElementById("status_kode").innerHTML = "";
        document.getElementById("status_nama").innerHTML = "";
        document.getElementById("status_nik").innerHTML = "";
        document.getElementById("status_surat").innerHTML = "";
        document.getElementById("status_tanggal").innerHTML = "";
        document.getElementById("status_catatan").innerHTML = "-";
    });

const kategori = document.getElementById("kategori_surat");
const jenis = document.getElementById("jenis_surat");

if (kategori && jenis) {
    kategori.addEventListener("change", function () {
        let id = this.value;

        if (!id) {
            jenis.innerHTML =
                '<option value="">-- Pilih Jenis Surat --</option>';

            return;
        }

        jenis.innerHTML = '<option value="">Memuat...</option>';

        fetch("/kategori/" + id + "/jenis-surat")
            .then((res) => res.json())
            .then((res) => {
                jenis.innerHTML =
                    '<option value="">-- Pilih Jenis Surat --</option>';

                res.jenis.forEach((item) => {
                    jenis.innerHTML += `
                        <option value="${item.id}">
                            ${item.nama_surat}
                        </option>
                    `;
                });
            });
    });
}

if (jenis) {
    jenis.addEventListener("change", function () {
        let id = this.value;

        if (!id) {
            document.getElementById("wrapper-persyaratan").innerHTML =
                '<div class="text-center text-muted">Pilih jenis surat terlebih dahulu.</div>';

            return;
        }

        fetch("/form-pengajuan/" + id)
            .then((res) => res.json())
            .then((res) => {
                let html = "";

                if (res.persyaratan.length === 0) {
                    html = `
                        <div class="alert alert-warning mb-0">
                            Tidak ada persyaratan.
                        </div>
                    `;
                } else {
                    res.persyaratan.forEach((item) => {
                        if (item.tipe_input === "file") {
                            html += `
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        ${item.nama_persyaratan}

                                        ${
                                            item.is_required
                                                ? '<span class="text-danger">*</span>'
                                                : ""
                                        }

                                    </label>

                                    <input
                                        type="file"
                                        class="form-control"
                                        name="lampiran[${item.id}]"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                        ${item.is_required ? "required" : ""}
                                    >

                                </div>
                            `;
                        } else {
                            html += `
                                <div class="mb-3">

                                    <label class="form-label fw-semibold">

                                        ${item.nama_persyaratan}

                                        ${
                                            item.is_required
                                                ? '<span class="text-danger">*</span>'
                                                : ""
                                        }

                                    </label>

                                    <textarea
                                        class="form-control"
                                        rows="3"
                                        name="keterangan[${item.id}]"
                                        placeholder="Masukkan ${item.nama_persyaratan}"
                                        ${item.is_required ? "required" : ""}
                                    ></textarea>

                                </div>
                            `;
                        }
                    });
                }

                document.getElementById("wrapper-persyaratan").innerHTML = html;
            });
    });
}

const formPengajuan = document.getElementById("formPengajuan");

formPengajuan.addEventListener("submit", function (e) {
    e.preventDefault();

    const btn = document.getElementById("btnSubmitPengajuan");

    btn.disabled = true;
    btn.innerHTML =
        '<span class="spinner-border spinner-border-sm me-2"></span>Mengirim...';

    let formData = new FormData(this);

    fetch(this.action, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": window.csrfToken,
            Accept: "application/json",
        },
        body: formData,
    })
        .then((res) => res.json())
        .then((res) => {
            btn.disabled = false;
            btn.innerHTML = "Kirim Pengajuan";

            if (res.status) {
                Swal.fire({
                    icon: "success",
                    title: "Pengajuan Berhasil",
                    html:
                        "Kode Pengajuan Anda<br><br><b>" +
                        res.kode_pengajuan +
                        "</b><br><br>Simpan kode ini untuk mengecek status.",
                }).then(() => {
                    window.location.href = "/";
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: res.message,
                });
            }
        })
        .catch((err) => {
            btn.disabled = false;
            btn.innerHTML = "Kirim Pengajuan";

            console.log(err);

            Swal.fire({
                icon: "error",
                title: "Server Error",
                text: "Terjadi kesalahan.",
            });
        });
});
