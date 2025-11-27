<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Data Pelanggan</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-pelanggan/tampil.php';
    break;
  
  case 'export':
    include 'laporan-pelanggan/export.php';
    break;
  
  

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>