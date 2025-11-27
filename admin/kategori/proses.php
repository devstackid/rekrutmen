<?php
include '../config/koneksi.php';

$kategori = $_POST['kategori'];

if (isset($_POST['tambah'])) {
    // Cek apakah tanggal sudah ada di tabel
    $querytransaksi = "INSERT INTO kategori (kategori) 
                           VALUES ('$kategori')";
    $resulttransaksi = mysqli_query($koneksi, $querytransaksi);

    if ($resulttransaksi) {
        // Pesan sukses jika data berhasil ditambahkan
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil ditambahkan';
        header("Location: kategori.php?page=tampil");
    } else {
        // Pesan error jika terjadi kesalahan saat insert data
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = mysqli_error($koneksi);
        header("Location: kategori.php?page=tambah");
    }
}
