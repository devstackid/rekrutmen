<?php
include '../config/koneksi.php';

$id = $_POST['id'];
    $bidang_pekerjaan = $_POST['bidang_pekerjaan'];
    

    // Query untuk update data
    $queryUpdate = "UPDATE bidang_pekerjaan SET 
                    bidang_pekerjaan = '$bidang_pekerjaan'
                    WHERE id = $id";

    $resultUpdate = mysqli_query($koneksi, $queryUpdate);

    if ($resultUpdate) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil diubah';
        header("Location: bidang-pekerjaan.php?page=tampil");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = mysqli_error($koneksi);
        header("Location: bidang-pekerjaan.php?page=edit&id=$id");
    }