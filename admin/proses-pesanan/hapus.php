<?php
include '../config/koneksi.php';
session_start();

$id_transaksi = $_GET['id_transaksi'];

// Pastikan $id_transaksi aman untuk digunakan
$id_transaksi = mysqli_real_escape_string($koneksi, $id_transaksi);

// Hapus detail transaksi
$queryItems = "DELETE FROM detail_transaksi WHERE id_transaksi = ?";
$stmtItems = $koneksi->prepare($queryItems);
$stmtItems->bind_param("s", $id_transaksi);

if ($stmtItems->execute()) {
    // Hapus transaksi setelah detail dihapus
    $queryTransaksi = "DELETE FROM transaksi WHERE id_transaksi = ?";
    $stmtTransaksi = $koneksi->prepare($queryTransaksi);
    $stmtTransaksi->bind_param("s", $id_transaksi);

    if ($stmtTransaksi->execute()) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data pesanan berhasil dihapus';
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Gagal menghapus data transaksi.';
    }
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'Gagal menghapus detail transaksi.';
}

// Redirect kembali ke halaman tampil
header("Location: proses-pesanan.php?page=tampil");
exit();
