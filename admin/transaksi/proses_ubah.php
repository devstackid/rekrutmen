<?php
include '../config/koneksi.php';

$id_transaksi = $_POST['id_transaksi'];
$tanggal = $_POST['tanggal'];
$waktu = $_POST['waktu'];
$metode_pembayaran = $_POST['metode_pembayaran'];
$id_kasir = $_POST['id_kasir'];

// Query untuk update data
$queryUpdate = "UPDATE transaksi SET 
                tanggal = '$tanggal', 
                waktu = '$waktu', 
                metode_pembayaran = '$metode_pembayaran',
                id_kasir = '$id_kasir'
                WHERE id_transaksi = '$id_transaksi'";

$resultUpdate = mysqli_query($koneksi, $queryUpdate);

if ($resultUpdate) {
    $_SESSION['result'] = 'success';
    $_SESSION['message'] = 'Data berhasil diubah';
    header("Location: transaksi.php?page=tampil");
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'Error: ' . mysqli_error($koneksi);
    header("Location: transaksi.php?page=edit&id=$id_transaksi");
}
?>
