<?php
include '../modules/header.php';
// include '../config/is_admin.php';
?>

<title>Data Lamaran Kerja</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'diterima';
}
switch ($page) {
  case 'diterima':
    include 'seleksi/seleksi-diterima.php';
    break;
  case 'ditolak':
    include 'seleksi/seleksi-ditolak.php';
    break;
  case 'seleksi':
    include 'seleksi/tes-seleksi.php';
    break;
  case 'kirim-jawaban':
    include 'seleksi/kirim-jawaban.php';
    break;
  

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>