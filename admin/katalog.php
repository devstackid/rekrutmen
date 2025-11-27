<?php
include '../modules/header.php';
// include '../config/is_admin.php';
?>

<title>Data Katalog</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'katalog/tampil.php';
    break;
  case 'tambah':
    include 'katalog/tambah.php';
    break;
  case 'ubah':
    include 'katalog/update.php';
    break;
  case 'proses':
    include 'katalog/proses.php';
    break;
  case 'proses_ubah':
    include 'katalog/proses_ubah.php';
    break;
  case 'hapus':
    include 'katalog/hapus.php';
    break;

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>