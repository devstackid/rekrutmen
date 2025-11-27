<?php
include 'koneksi.php';
$username = $_POST['username'];
$password = md5($_POST['password']);

$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);

if ($row >= 0) {

  // echo 'atas';
  // die;
  session_start();
  $_SESSION['login'] = true;
  // $_SESSION['id'] = $id;
  $_SESSION['username'] = $username;
  $_SESSION['role'] = $row['role'];
  $_SESSION['id'] = $row['id'];
  $_SESSION['no_telp'] = $row['no_telp'];
  $_SESSION['nama'] = $row['nama'];
  $_SESSION['gambar'] = $row['gambar'];


  header("Location: cek_login.php");
  exit();
} else {
  // echo 'bawah';
  // die;
  echo '<script>alert("Username atau Password Salah!");</script>';
  echo '<script>window.location.href = "../index.php";</script>';
}
