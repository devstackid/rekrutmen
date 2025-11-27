<?php
include '../modules/header.php';
// include '../config/is_admin.php';
?>

<title>Data Proses Pesanan</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'proses-pesanan/tampil.php';
    break;
  case 'detail':
    include 'proses-pesanan/detail.php';
    break;
  case 'proses_ubah':
    include 'proses-pesanan/proses_ubah.php';
    break;
  case 'hapus':
    include 'proses-pesanan/hapus.php';
    break;

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>