<?php
include "proses/connect.php";

// Ambil data dari database
$query = mysqli_query($conn, "SELECT * FROM tb_image");
$result = [];
while ($record = mysqli_fetch_array($query)) {
    $result[] = $record;
}
?>
<!-- Report-->
<div class="col-lg-12 mt-2">
    <div class="card">
        <div class="card-header">
            <h1 class="modal-title fs-5">REPORT</h1>
        </div>
        <div class="card-body">
            <div class="card">
                <?php
                if (empty($result)) {
                    echo "Data user tidak ada";
                } else {
                    ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">FOTO DAN VIDEO</th>
                                    <th scope="col">CAPTION</th>
                                    <th scope="col">UPLOAD TIME</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($result as $row) {
                                    $fileType = strtolower(pathinfo($row['foto_video'], PATHINFO_EXTENSION));
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $no++ ?></th>
                                        <td>
                                            <div style="width: 200px">
                                                <?php if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) { ?>
                                                    <img src="assets/media/<?php echo $row['foto_video'] ?>" class="img-thumbnail"
                                                        alt="Image">
                                                <?php } elseif (in_array($fileType, ['mp4', 'mov', 'avi', 'mkv'])) { ?>
                                                    <video width="200" controls>
                                                        <source src="assets/media/<?php echo $row['foto_video'] ?>"
                                                            type="video/<?php echo $fileType ?>">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                <?php } else { ?>
                                                    <p>File type not supported</p>
                                                <?php } ?>
                                            </div>
                                        </td>
                                        <td><?php echo $row['caption'] ?></td>
                                        <td><?php echo $row['upload_time'] ?></td>
                                        <td><?php echo $row['nama_user'] ?></td>
                                        <td>
                                            <div class="d-flex">
                                                <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal"
                                                    data-bs-target="#ModalView<?php echo $row['id']; ?>"><i
                                                        class="bi bi-eye"></i></button>
                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#ModalDelete<?php echo $row['id']; ?>"><i
                                                        class="bi bi-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Modal View-->
                                    <div class="modal fade" id="ModalView<?php echo $row['id'] ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                        <?php echo $row['foto_video'] ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body text-center">
                                                    <?php
                                                    $fileType = strtolower(pathinfo($row['foto_video'], PATHINFO_EXTENSION)); // Mendapatkan tipe file
                                                    if (in_array($fileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                                                        echo '<img src="assets/media/' . $row['foto_video'] . '" class="img-fluid" alt="Image" style="max-height: 80vh; max-width: 100%;">';
                                                    } elseif (in_array($fileType, ['mp4', 'mov', 'avi', 'mkv'])) {
                                                        echo '<video width="100%" controls id="video_' . $row['id'] . '" style="max-height: 80vh;">
                            <source src="assets/media/' . $row['foto_video'] . '" type="video/' . $fileType . '">
                          Your browser does not support the video tag.
                          </video>';
                                                    }
                                                    ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="download.php?filename=<?php echo $row['foto_video']; ?>"
                                                        class="btn btn-primary">Download</a>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal View-->

                                    <!-- Modal Delete-->
                                    <div class="modal fade" id="ModalDelete<?php echo $row['id'] ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-fullscreen-md-down">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">DELETE</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="proses/proses_delete_gambar.php" method="POST">
                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                        <div class="col-lg-12">
                                                            Apakah anda ingin menghapus file
                                                            <b><?php echo $row['foto_video'] ?></b>?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Delete-->

                                    <script>
                                        document.addEventListener('DOMContentLoaded', (event) => {
                                            var modal = document.getElementById('ModalView<?php echo $row['id'] ?>');
                                            modal.addEventListener('hidden.bs.modal', function (e) {
                                                var video = document.getElementById('video_<?php echo $row['id'] ?>');
                                                if (video) {
                                                    video.pause();
                                                    video.currentTime = 0;
                                                }
                                            });
                                        });
                                    </script>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- End Report-->