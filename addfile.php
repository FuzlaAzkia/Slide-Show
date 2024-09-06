<div class="modal fade" id="ModalTambahGambar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen-md-down">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Nama">
                        <label for="floatingInput">Nama</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="datetime-local" class="form-control" id="floatingInput"
                                    placeholder="YYYY-MM-DDTHH:MM" pattern="\d{4}-\d{2}-\d{2}T\d{2}:\d{2}" required>
                                <label for="floatingInput">Upload Time</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="datetime-local" class="form-control" id="floatingInput"
                                    placeholder="YYYY-MM-DDTHH:MM" pattern="\d{4}-\d{2}-\d{2}T\d{2}:\d{2}" required>
                                <label for="floatingInput">Display Start Time</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="datetime-local" class="form-control" id="floatingInput"
                                    placeholder="YYYY-MM-DDTHH:MM" pattern="\d{4}-\d{2}-\d{2}T\d{2}:\d{2}" required>
                                <label for="floatingInput">Display End Time</label>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputFoto">Upload Foto</label>
                            <input type="file" class="form-control" id="inputFoto" accept="image/*">
                        </div>
                    </div>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Caption">
                        <label for="floatingInput">Caption</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>