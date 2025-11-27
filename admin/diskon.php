<?php
include '../modules/header.php';
// include '../config/is_admin.php';
?>

<title>Data Diskon</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'diskon/tampil.php';
    break;
  case 'tambah':
    include 'diskon/tambah.php';
    break;
  case 'ubah':
    include 'diskon/update.php';
    break;
  case 'proses':
    include 'diskon/proses.php';
    break;
  case 'proses_ubah':
    include 'diskon/proses_ubah.php';
    break;
  case 'hapus':
    include 'diskon/hapus.php';
    break;

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>