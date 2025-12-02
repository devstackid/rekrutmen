<?php
include '../config/koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $catatan = $_POST['catatan'];
    
    $query = "UPDATE rekrutmen 
              SET status = '$status', catatan = '$catatan', updated_at = NOW()
              WHERE id = '$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil diupdate.';
        header("Location: rekrutmen.php?page=tampil");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Gagal mengupdate data: ' . mysqli_error($koneksi);
        header("Location: rekrutmen.php?page=ubah&id=$id");
    }
}
?>
