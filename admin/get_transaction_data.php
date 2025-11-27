<?php
include_once '../config/koneksi.php';

if (isset($_POST['id_transaksi'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $query = "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'";
    $result = mysqli_query($koneksi, $query);

    if ($transaksi = mysqli_fetch_assoc($result)) {
        echo json_encode($transaksi);
    } else {
        echo json_encode([]);
    }
}
?>
