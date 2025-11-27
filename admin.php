<?php
// include '../modules/header.php';
// include '../config/is_admin.php';
?>

<title>Dashboard</title>

<?php
// check page from url
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 'dashboard';
}
echo $page;
die;
switch ($variable) {
  case 'value':
    # code...
    break;

  default:
    # code...
    break;
}
?>

<?php
include '../modules/footer.php';
?>