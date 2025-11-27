<?php
include '../modules/header.php';
// include '../config/is_admin.php';
?>

<title>Laporan Harian</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-harian/tampil.php';
    break;
  
  case 'export':
    include 'laporan-harian/export.php';
    break;
  

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>