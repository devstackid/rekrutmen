<?php
include '../config/koneksi.php';

$id = $_POST['id'];
    $kategori = $_POST['kategori'];
    

    // Query untuk update data
    $queryUpdate = "UPDATE kategori SET 
                    kategori = '$kategori'
                    WHERE id = $id";

    $resultUpdate = mysqli_query($koneksi, $queryUpdate);

    if ($resultUpdate) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil diubah';
        header("Location: kategori.php?page=tampil");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = mysqli_error($koneksi);
        header("Location: kategori.php?page=edit&id=$id");
    }