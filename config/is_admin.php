<?php
if ($_SESSION['role'] == 'kasir') {
  header("Location: ../index.php");
  exit();
}
