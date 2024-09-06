<?php
include "connect.php";

// Ambil data dari form
$pilihfile = (isset($_POST['pilihfile'])) ? htmlentities($_POST['pilihfile']) : "";
$caption = (isset($_POST['caption'])) ? htmlentities($_POST['caption']) : "";
$upload_time = (isset($_POST['upload_time']) && !empty($_POST['upload_time'])) ? htmlentities($_POST['upload_time']) : NULL;
$nama = (isset($_POST['nama'])) ? htmlentities($_POST['nama']) : "";

$kode_rand = rand(10000, 999999)."-";
$target_dir = "../assets/media/".$kode_rand;
$target_file = $target_dir . basename($_FILES['pilihfile']['name']);
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (!empty($_POST['input_gambar_validate'])) {
    // Cek apakah gambar atau video
    $allowed_image_types = ['jpg', 'jpeg', 'png', 'gif'];
    $allowed_video_types = ['mp4', 'mov', 'avi', 'mkv'];
    
    if (in_array($fileType, $allowed_image_types)) {
        $cek = getimagesize($_FILES['pilihfile']['tmp_name']);
        if ($cek === false) {
            $message = "Ini bukan file gambar";
            $statusUpload = 0;
        } else {
            $statusUpload = 1;
        }
    } elseif (in_array($fileType, $allowed_video_types)) {
        $statusUpload = 1;
    } else {
        $message = "Format file tidak sesuai";
        $statusUpload = 0;
    }

    if ($statusUpload == 1) {
        if (file_exists($target_file)) {
            $message = "Maaf, file yang dimasukkan telah ada";
            $statusUpload = 0;
        } elseif ($_FILES['pilihfile']['size'] > 1073741824) {  // 1 GB
            $message = "File yang diupload terlalu besar";
            $statusUpload = 0;
        }
    }

    if ($statusUpload == 0) {
        $message = '<script>alert("' . $message . ', file tidak dapat diupload");
                window.location="../index"</script>';
    } else {
        // Pastikan kolom yang benar dalam tabel tb_image
        $filename = $kode_rand . basename($_FILES['pilihfile']['name']);
        $select = mysqli_query($conn, "SELECT * FROM tb_image WHERE foto_video = '$filename'");
        if (mysqli_num_rows($select) > 0) {
            $message = '<script>alert("Nama file yang dimasukkan telah ada");
                        window.location="../index"</script>';
        } else {
            if (move_uploaded_file($_FILES['pilihfile']['tmp_name'], $target_file)) {
                $query = mysqli_query($conn, "INSERT INTO tb_image (foto_video, caption, upload_time, nama_user) VALUES ('$filename', '$caption', '$upload_time', '$nama')");
                if ($query) {
                    $message = '<script>alert("Data berhasil dimasukkan");
                        window.location="../index"</script>';
                } else {
                    $message = '<script>alert("Data gagal dimasukkan");
                        window.location="../index"</script>';
                }
            } else {
                $message = '<script>alert("Maaf, terjadi kesalahan, file tidak dapat diupload");
                        window.location="../index"</script>';
            }
        }
    }
}

echo $message;
?>
