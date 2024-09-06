<!-- style header -->
<style>
    .dropdown-item-success:hover,
    .dropdown-item-success:active {
        background-color: #198754;
        color: white;
    }
</style>
<!-- End style header -->

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-lg">
        <a class="navbar-brand" href="."><img src="img/L1.png" alt="" width="300" height="43"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><i class="bi bi-grid-3x3-gap-fill fs-5"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mt-3">
                        <li><a class="dropdown-item dropdown-item-success" data-bs-toggle="modal"
                                data-bs-target="#ModalTambahGambar" href=".">
                                <i class="bi bi-plus-square"></i> UPLOAD FILE</a></li>
                        <li><a class="dropdown-item dropdown-item-success" href="report">
                                <i class="bi bi-file-earmark-richtext"></i> REPORT</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Header -->

<!-- Modal Tambah Gambar-->
<div class="modal fade" id="ModalTambahGambar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">UPLOAD FILE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_input_gambar.php" method="POST" enctype="multipart/form-data">
                    <div class="input-group mb-3"> <!-- pilih foto -->
                        <input type="file" class="form-control form-control-lg" id="uploadfoto" accept="image/*"
                            name="pilihfile" required>
                        <label class="input-group" for="uploadfoto"></label>
                        <div class="invalid-feedback">File harus diunggah.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="caption" style="height:100px" name="caption"></textarea>
                        <label for="caption">Caption</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="datetime-local" class="form-control" id="upload_time" name="upload_time"
                                    required>
                                <label for="upload_time">Upload Time</label>
                                <div class="invalid-feedback">Masukkan waktu unggah.</div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama">
                                <label for="nama">Nama</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="input_gambar_validate" value="1234">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Tambah Gambar-->

<script>
    (() => {
        'use strict';

        // Ambil form yang memerlukan validasi
        const form = document.querySelector('.needs-validation');

        // Menangani pengiriman form
        form.addEventListener('submit', event => {
            // Validasi hanya jika pilihfile atau upload_time diisi
            if (form.pilihfile.value.trim() === '' && form.upload_time.value.trim() === '') {
                event.preventDefault();
                event.stopPropagation();
                // Menampilkan pesan error
                if (form.pilihfile.value.trim() === '') {
                    form.pilihfile.classList.add('is-invalid');
                } else {
                    form.pilihfile.classList.remove('is-invalid');
                }
                if (form.upload_time.value.trim() === '') {
                    form.upload_time.classList.add('is-invalid');
                } else {
                    form.upload_time.classList.remove('is-invalid');
                }
            } else {
                form.classList.add('was-validated');
            }
        }, false);
    })();
</script>