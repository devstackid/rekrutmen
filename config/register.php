<?php
include 'koneksi.php';
session_start();

$nama = $_POST['nama'];
$nomor_telepon = $_POST['nomor_telepon'];
$username = $_POST['username'];
$password = md5($_POST['password']);

$queryRegister = "
    INSERT INTO pengguna (nama, nomor_telepon, username, password) 
    VALUES ('$nama', '$nomor_telepon', '$username', '$password')
";

$resultRegister = mysqli_query($koneksi, $queryRegister);

if ($resultRegister) {

    $user_id = mysqli_insert_id($koneksi);

    $queryGetUser = "SELECT * FROM pengguna WHERE id = '$user_id' LIMIT 1";
    $resultUser = mysqli_query($koneksi, $queryGetUser);
    $row = mysqli_fetch_assoc($resultUser);

    $_SESSION['result'] = 'success';
    $_SESSION['message'] = 'Registrasi berhasil!';
    $_SESSION['login'] = true;
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'] ?? 'pelamar';
    $_SESSION['id'] = $row['id'];
    $_SESSION['nomor_telepon'] = $row['nomor_telepon'];
    $_SESSION['nama'] = $row['nama'];

    header("Location: ../admin/index.php");
    exit();

} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = mysqli_error($koneksi);
    header("Location: register.php");
    exit();
}
