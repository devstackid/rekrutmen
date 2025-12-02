<?php
include '../modules/header.php';
include '../config/is_admin.php';
?>

<title>Data Bidang Pekerjaan</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'tampil';
}
switch ($page) {
  case 'tampil':
    include 'bidang-pekerjaan/tampil.php';
    break;
  case 'tambah':
    include 'bidang-pekerjaan/tambah.php';
    break;
  case 'ubah':
    include 'bidang-pekerjaan/update.php';
    break;
  case 'proses':
    include 'bidang-pekerjaan/proses.php';
    break;
  case 'proses_ubah':
    include 'bidang-pekerjaan/proses_ubah.php';
    break;
  case 'hapus':
    include 'bidang-pekerjaan/hapus.php';
    break;

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>