<?php
include '../config/koneksi.php';

$bidang_pekerjaan = $_POST['bidang_pekerjaan'];

if (isset($_POST['tambah'])) {
    // Cek apakah tanggal sudah ada di tabel
    $querytransaksi = "INSERT INTO bidang_pekerjaan (bidang_pekerjaan) 
                           VALUES ('$bidang_pekerjaan')";
    $resulttransaksi = mysqli_query($koneksi, $querytransaksi);

    if ($resulttransaksi) {
        // Pesan sukses jika data berhasil ditambahkan
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil ditambahkan';
        header("Location: bidang-pekerjaan.php?page=tampil");
    } else {
        // Pesan error jika terjadi kesalahan saat insert data
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = mysqli_error($koneksi);
        header("Location: bidang-pekerjaan.php?page=tambah");
    }
}
