<?php
date_default_timezone_set('Asia/Jakarta'); // Atur sesuai zona waktu Anda

include_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_transaksi'])) {
    $id_transaksi = $_GET['id_transaksi'];

    // Ambil data transaksi dari database
    $queryTransaksi = "SELECT * FROM transaksi WHERE id_transaksi = '$id_transaksi'";
    $resultTransaksi = mysqli_query($koneksi, $queryTransaksi);
    $transaksi = $resultTransaksi->fetch_assoc();

    // Ambil waktu dari database dan waktu sekarang
    $waktu = $transaksi['waktu'];
    $waktu_sekarang = date('H:i:s');

    // Gabungkan waktu dengan tanggal hari ini
    $tanggal_hari_ini = date('Y-m-d');
    $datetime_waktu = new DateTime("$tanggal_hari_ini $waktu");
    $datetime_waktu_sekarang = new DateTime("$tanggal_hari_ini $waktu_sekarang");

    // Hitung selisih waktu
    $interval = $datetime_waktu_sekarang->diff($datetime_waktu);

    // Format hasil selisih waktu
    if ($interval->h > 0) {
        $waktu_penyajian = $interval->h . ' jam ' . $interval->i . ' menit';
    } else {
        $waktu_penyajian = $interval->i . ' menit';
    }

    // Update database dengan hasil waktu_penyajian
    $queryUpdate = "UPDATE transaksi SET 
                    status = 'selesai',
                    waktu_penyajian = '$waktu_penyajian'
                    WHERE id_transaksi = '$id_transaksi'";
    $resultUpdate = mysqli_query($koneksi, $queryUpdate);

    if ($resultUpdate) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Proses selesai';
        header("Location: proses-pesanan.php?page=tampil");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Error: ' . mysqli_error($koneksi);
        header("Location: proses-pesanan.php?page=tampil");
    }
    exit();
}
