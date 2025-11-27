<?php
include '../modules/header.php';
// include '../config/is_admin.php';
?>

<title>Data Transaksi Penjualan</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'transaksi/tampil.php';
    break;
  case 'bayar':
    include 'transaksi/bayar.php';
    break;
  case 'tambah':
    include 'transaksi/tambah.php';
    break;
  case 'ubah':
    include 'transaksi/update.php';
    break;
  case 'proses':
    include 'transaksi/proses.php';
    break;
  case 'proses_ubah':
    include 'transaksi/proses_ubah.php';
    break;
  case 'hapus':
    include 'transaksi/hapus.php';
    break;

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>