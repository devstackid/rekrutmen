<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "hatara";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
  echo "Koneksi Gagal";
}
