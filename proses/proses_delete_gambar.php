<?php
include "connect.php";

$id = (isset($_POST['id'])) ? htmlentities($_POST['id']) : "";

if (!empty($id)) {
    $query = mysqli_query($conn, "DELETE FROM tb_image WHERE id = '$id'");

    if ($query) {
        $message = '<script>alert("Data berhasil dihapus"); window.location="../report"</script>';
    } else {
        $message = '<script>alert("Data gagal dihapus"); window.location="../report"</script>';
    }
} else {
    $message = '<script>alert("ID tidak valid atau tidak ditemukan"); window.location="../report"</script>';
}

echo $message;
?>