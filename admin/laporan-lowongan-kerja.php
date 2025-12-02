<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Laporan Penerimaan Lowongan Kerja</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'laporan-lowongan-kerja/tampil.php';
    break;
  
  case 'cetak':
    include 'laporan-lowongan-kerja/cetak.php';
    break;
  
  case 'export':
    include 'laporan-lowongan-kerja/export.php';
    break;
  

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>