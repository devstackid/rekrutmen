<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Seleksi Diterima</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-seleksi-diterima/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-seleksi-diterima/cetak.php';
    break;
  
  case 'export':
    include 'laporan-seleksi-diterima/export.php';
    break;
  

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>