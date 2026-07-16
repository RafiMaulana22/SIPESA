const formValidasi = document.getElementById("formValidasiNik");
const formPengajuan = document.getElementById("formPengajuan");

// FORM VALIDASI NIK
formValidasi.addEventListener("submit", function (e) {
    e.preventDefault();
    validasiNik();
});

// FORM PENGAJUAN SURAT
formPengajuan.addEventListener("submit", function (e) {
    e.preventDefault();
    kirimPengajuan();
});

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

            console.log("VALIDASI BERHASIL");

            // sembunyikan form validasi
            document.getElementById("formValidasiNik").style.display = "none";

            // tampilkan form pengajuan
            document.getElementById("formPengajuan").style.display = "block";

            // tampilkan isi step pengajuan
            document.getElementById("step-pengajuan").style.display = "block";

            document.getElementById("penduduk_id").value = res.penduduk.id;
            document.getElementById("penduduk_nik").value = res.penduduk.nik;
            document.getElementById("penduduk_nama").value = res.penduduk.nama;
            document.getElementById("penduduk_alamat").value =
                res.penduduk.alamat;

            let select = document.getElementById("jenis_surat");

            select.innerHTML =
                '<option value="">-- Pilih Jenis Surat --</option>';

            document.getElementById("wrapper-persyaratan").innerHTML = `
                <div class="text-center text-muted py-3">
                    Pilih jenis surat terlebih dahulu.
                </div>
            `;

            res.jenisSurat.forEach(function (item) {
                select.innerHTML += `
                    <option value="${item.id}">
                        ${item.nama_surat}
                    </option>
                `;
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

function kirimPengajuan() {
    const btnSubmit = document.getElementById("btnSubmitPengajuan");

    btnSubmit.disabled = true;

    btnSubmit.innerHTML =
        '<span class="spinner-border spinner-border-sm me-2"></span>Mengirim...';

    let form = document.getElementById("formPengajuan");

    let formData = new FormData(form);

    for (let pair of formData.entries()) {
        console.log(pair[0], pair[1]);
    }

    fetch(window.formPengajuanUrl, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": window.csrfToken,
            Accept: "application/json",
        },
        body: formData,
    })
        .then(async (response) => {
            const data = await response.json();

            console.log("Status :", response.status);
            console.log("Response :", data);

            return data;
        })
        .then((res) => {
            btnSubmit.disabled = false;

            btnSubmit.innerHTML =
                '<i class="bi bi-check-circle me-1"></i>Kirim Pengajuan';

            if (res.status) {
                // Notifikasi
                Swal.fire({
                    icon: "success",
                    title: "Pengajuan Berhasil",
                    html:
                        "Kode Pengajuan Anda:<br><br>" +
                        "<b>" +
                        res.kode_pengajuan +
                        "</b><br><br>" +
                        "Simpan kode ini untuk mengecek status pengajuan.",
                });

                // Tutup modal
                const modal = bootstrap.Modal.getInstance(
                    document.getElementById("ajukanSuratModal"),
                );

                modal.hide();

                // Reset form
                document.getElementById("formValidasiNik").reset();
                document.getElementById("formPengajuan").reset();

                // Kembali ke step pertama
                document.getElementById("step-validasi").style.display =
                    "block";
                document.getElementById("step-pengajuan").style.display =
                    "none";
                document.getElementById("formPengajuan").style.display = "none";
            } else {
                console.log(res);

                Swal.fire({
                    icon: "error",
                    title: "Pengajuan Gagal",
                    text: res.message ?? "Terjadi kesalahan.",
                });
            }
        })
        .catch(async (err) => {
            console.log("ERROR :", err);

            Swal.fire({
                icon: "error",
                title: "Error",
                text: err,
            });
        });
}

document
    .getElementById("btnKembaliPengajuan")
    .addEventListener("click", function () {
        formPengajuan.reset();
        formValidasi.reset();

        document.getElementById("formPengajuan").style.display = "none";
        document.getElementById("formValidasiNik").style.display = "block";

        document.getElementById("step-pengajuan").style.display = "none";
        document.getElementById("step-validasi").style.display = "block";

        document.getElementById("nikError").innerHTML = "";
    });

const modalAjukan = document.getElementById("ajukanSuratModal");

modalAjukan.addEventListener("hidden.bs.modal", function () {
    formValidasi.reset();
    formPengajuan.reset();

    document.getElementById("wrapper-persyaratan").innerHTML = `
        <div class="text-center text-muted py-3">
            Pilih jenis surat terlebih dahulu.
        </div>
    `;

    document.getElementById("nikError").innerHTML = "";

    document.getElementById("formValidasiNik").style.display = "block";
    document.getElementById("formPengajuan").style.display = "none";

    document.getElementById("step-validasi").style.display = "block";
    document.getElementById("step-pengajuan").style.display = "none";
});

const jenisSurat = document.getElementById("jenis_surat");

jenisSurat.addEventListener("change", function () {
    let id = this.value;

    if (!id) {
        return;
    }

    fetch("/form-pengajuan/" + id)
        .then((response) => response.json())
        .then((res) => {
            let html = "";

            if (res.persyaratan.length == 0) {
                html = `
                    <div class="alert alert-warning mb-0">
                        Jenis surat ini tidak memiliki persyaratan.
                    </div>
                `;
            } else {
                res.persyaratan.forEach(function (item) {
                    if (item.tipe_input == "file") {
                        html += `
                            <div class="mb-3">

                                <label class="form-label fw-semibold">

                                    ${item.nama_persyaratan}

                                    ${
                                        item.is_required
                                            ? '<span class="text-danger">*</span>'
                                            : '<span class="badge bg-secondary ms-2">Opsional</span>'
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
                                            : '<span class="badge bg-secondary ms-2">Opsional</span>'
                                    }

                                </label>

                                <textarea
                                    class="form-control"
                                    rows="3"
                                    name="keterangan[${item.id}]"
                                    placeholder="Masukkan ${item.nama_persyaratan.toLowerCase()}..."
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
