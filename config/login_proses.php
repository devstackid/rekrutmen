<?php
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "SELECT * FROM pengguna WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($koneksi, $query);

// Cek apakah username + password cocok
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    session_start();
    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $row['role'];
    $_SESSION['id'] = $row['id'];
    $_SESSION['nomor_telepon'] = $row['nomor_telepon'];
    $_SESSION['nama'] = $row['nama'];

    header("Location: cek_login.php");
    exit();
} else {
    echo '<script>alert("Username atau Password Salah!");</script>';
    echo '<script>window.location.href = "../index.php";</script>';
}
