<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Seleksi Diproses</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-seleksi-diproses/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-seleksi-diproses/cetak.php';
    break;
  
  case 'export':
    include 'laporan-seleksi-diproses/export.php';
    break;
  

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>