<?php
include_once '../config/koneksi.php';

if (isset($_POST['id_produk'])) {
    $id_produk = $_POST['id_produk'];
    $query = "SELECT * FROM katalog WHERE id = '$id_produk'";
    $result = mysqli_query($koneksi, $query);

    if ($produk = mysqli_fetch_assoc($result)) {
        echo json_encode($produk);
    } else {
        echo json_encode([]);
    }
}
?>
