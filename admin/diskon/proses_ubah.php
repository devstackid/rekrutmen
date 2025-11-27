<?php
include '../config/koneksi.php';

$id = $_POST['id'];
$keterangan = $_POST['keterangan'];
$diskon = $_POST['diskon'];


// Query untuk update data
$queryUpdate = "UPDATE diskon SET 
                    keterangan = '$keterangan',
                    diskon = $diskon
                    WHERE id = $id";

$resultUpdate = mysqli_query($koneksi, $queryUpdate);

if ($resultUpdate) {
    $_SESSION['result'] = 'success';
    $_SESSION['message'] = 'Data berhasil diubah';
    header("Location: diskon.php?page=tampil");
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = mysqli_error($koneksi);
    header("Location: diskon.php?page=edit&id=$id");
}
