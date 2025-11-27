<?php
include '../config/koneksi.php';
$id = $_GET['id'];

// make deleete query
$detailTransaksiQuery = "DELETE FROM detail_transaksi WHERE id_transaksi = '$id'";
$execute = mysqli_query($koneksi, $detailTransaksiQuery);

$query = "DELETE FROM transaksi WHERE id_transaksi = '$id'";


$result = mysqli_query($koneksi, $query);
if ($result) {
  $_SESSION['result'] = 'success';
  $_SESSION['message'] = 'Data berhasil dihapus';

  header("Location: transaksi.php?page=tampil");
  exit();
} else {
  $_SESSION['result'] = 'error';
  $_SESSION['message'] = 'Data gagal dihapus';
  //refresh page
  header("Location: transaksi.php?page=tampil");
  exit();
}
