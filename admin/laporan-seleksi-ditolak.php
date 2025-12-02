<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Seleksi Ditolak</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-seleksi-ditolak/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-seleksi-ditolak/cetak.php';
    break;
  
  case 'export':
    include 'laporan-seleksi-ditolak/export.php';
    break;
  

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>