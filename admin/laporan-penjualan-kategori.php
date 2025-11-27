<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Penjualan Per Kategori</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-penjualan-kategori/tampil.php';
    break;
  
  case 'export':
    include 'laporan-penjualan-kategori/export.php';
    break;
  
  case 'exportbulan':
    include 'laporan-penjualan-kategori/exportbulan.php';
    break;
  

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>