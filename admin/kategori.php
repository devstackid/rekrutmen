<?php
include '../modules/header.php';
// include '../config/is_admin.php';
?>

<title>Data Kategori</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'kategori/tampil.php';
    break;
  case 'tambah':
    include 'kategori/tambah.php';
    break;
  case 'ubah':
    include 'kategori/update.php';
    break;
  case 'proses':
    include 'kategori/proses.php';
    break;
  case 'proses_ubah':
    include 'kategori/proses_ubah.php';
    break;
  case 'hapus':
    include 'kategori/hapus.php';
    break;

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>