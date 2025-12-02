<?php
include '../config/koneksi.php';
$id = $_GET['id'];

// Mulai transaksi untuk memastikan penghapusan data secara atomic
mysqli_begin_transaction($koneksi);

try {
    
    // Hapus data dari tabel users
    $queryUser = "DELETE FROM pengguna WHERE id = '$id'";
    $resultUser = mysqli_query($koneksi, $queryUser);
    if (!$resultUser) {
        throw new Exception('Gagal menghapus data pengguna.');
    }

    // Jika semua query berhasil, commit transaksi
    mysqli_commit($koneksi);

    // Buat pesan sukses dengan session
    $_SESSION['result'] = 'success';
    $_SESSION['message'] = 'Data berhasil dihapus';

    header("Location: users.php?page=tampil");

} catch (Exception $e) {
    // Jika ada kegagalan, rollback transaksi
    mysqli_rollback($koneksi);

    // Buat pesan error dengan session
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = $e->getMessage();

    header("Location: users.php?page=tampil");
}
?>
