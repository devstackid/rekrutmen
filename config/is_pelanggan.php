<?php
if ($_SESSION['role'] != 'pelanggan') {
  header("Location: ../index.php");
  exit();
}
