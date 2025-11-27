<?php
include '../modules/header.php';
// include '../config/is_admin.php';
?>

<title>Laporan Penjualan</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-penjualan/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-penjualan/cetak.php';
    break;
  
  case 'export':
    include 'laporan-penjualan/export.php';
    break;
  

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>