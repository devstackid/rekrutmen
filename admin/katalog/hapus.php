<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT gambar FROM katalog WHERE id = '$id'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
    
    // Jika data ditemukan
    if ($data) {
        $gambar = $data['gambar'];
        $uploadDir = "./uploads/";  // Direktori tempat gambar di-upload

        $queryDelete = "DELETE FROM katalog WHERE id = '$id'";
        $resultDelete = mysqli_query($koneksi, $queryDelete);

        if ($resultDelete) {
            if (file_exists($uploadDir . $gambar)) {
                unlink($uploadDir . $gambar); 
            }

            $_SESSION['result'] = 'success';
            $_SESSION['message'] = 'Data dan gambar berhasil dihapus.';
        } else {
            $_SESSION['result'] = 'error';
            $_SESSION['message'] = 'Gagal menghapus data: ' . mysqli_error($koneksi);
        }
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data tidak ditemukan.';
    }

    header("Location: katalog.php?page=tampil");
}
?>
