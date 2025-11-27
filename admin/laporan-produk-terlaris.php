<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Produk Terlaris</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-produk-terlaris/tampil.php';
    break;
  
  case 'export':
    include 'laporan-produk-terlaris/export.php';
    break;
  
  case 'exportbulan':
    include 'laporan-produk-terlaris/exportbulan.php';
    break;
  

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>