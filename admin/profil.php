<?php
include '../modules/header.php';
include '../config/is_pelamar.php';
?>

<title>Pengaturan Profil</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'update';
}
switch ($page) {
  case 'update':
    include 'profil/update.php';
    break;
  case 'proses_ubah':
    include 'profil/proses_ubah.php';
    break;
  

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>