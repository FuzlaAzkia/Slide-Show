<?php
if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];
    $filepath = 'assets/media/' . $filename;

    // Memastikan file yang akan diunduh ada dan bisa diakses
    if (file_exists($filepath)) {
        // Pengaturan header untuk memulai pengunduhan
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath); // Membaca file dan menuliskannya ke output buffer
        exit;
    } else {
        echo 'File tidak ditemukan.';
    }
} else {
    echo 'Parameter filename tidak ditemukan.';
}
?>
