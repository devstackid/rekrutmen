<?php
include '../config/koneksi.php';

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$no_telp = $_POST['no_telp'];
$role = $_POST['role'];



if (isset($_POST['tambah'])) {
    $querytransaksi = "INSERT INTO users (nama, username, password, no_telp, role) 
                           VALUES ('$nama', '$username', '$password', '$no_telp', '$role')";
        $resulttransaksi = mysqli_query($koneksi, $querytransaksi);

        if ($resulttransaksi) {
            // Pesan sukses jika data berhasil ditambahkan
            $_SESSION['result'] = 'success';
            $_SESSION['message'] = 'Data berhasil ditambahkan';
            header("Location: users.php?page=tampil");
        } else {
            // Pesan error jika terjadi kesalahan saat insert data
            $_SESSION['result'] = 'error';
            $_SESSION['message'] = mysqli_error($koneksi);
            header("Location: users.php?page=tambah");
        }
}

