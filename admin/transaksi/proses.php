<?php
session_start();
include '../config/koneksi.php';

// Ambil data dari POST dan lakukan validasi
$kasir = mysqli_real_escape_string($koneksi, $_POST['kasir'] ?? '');
$tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal'] ?? '');
$waktu = mysqli_real_escape_string($koneksi, $_POST['waktu'] ?? '');

$telepon = mysqli_real_escape_string($koneksi, $_POST['telepon'] ?? '');
$nomor_transaksi = mysqli_real_escape_string($koneksi, $_POST['nomor_transaksi'] ?? '');

$status = mysqli_real_escape_string($koneksi, $_POST['status'] ?? '');
$nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan'] ?? '');
$nomor_meja = mysqli_real_escape_string($koneksi, $_POST['nomor_meja'] ?? '');
$jenis_pesanan = mysqli_real_escape_string($koneksi, $_POST['jenis_pesanan'] ?? '');
$diskon = mysqli_real_escape_string($koneksi, $_POST['diskon'] ?? 0);
$total_pembayaran = mysqli_real_escape_string($koneksi, $_POST['total_pembayaran'] ?? 0);

// Data item pembelian
$items = $_POST['nama_produk'] ?? [];
$jumlah = $_POST['jumlah'] ?? [];
$id_produk = $_POST['id_produk'] ?? [];

// Validasi data yang wajib diisi
if (empty($kasir) || empty($tanggal) || empty($waktu) || empty($items) || empty($total_pembayaran || empty($nomor_transaksi) || empty($telepon))) {
    die('Data tidak valid. Mohon periksa kembali.');
}

if (isset($_POST['bayar'])) {
    // Query untuk menyimpan data transaksi
    $querytransaksi = "INSERT INTO transaksi (kasir, nama_pelanggan, nomor_meja, telepon, nomor_transaksi, jenis_pesanan, tanggal, waktu, total_pembayaran, diskon, status) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_transaksi = $koneksi->prepare($querytransaksi);
    $stmt_transaksi->bind_param('ssssssssdds', $kasir, $nama_pelanggan, $nomor_meja, $telepon, $nomor_transaksi, $jenis_pesanan, $tanggal, $waktu, $total_pembayaran, $diskon, $status);
    
    if ($stmt_transaksi->execute()) {
        $last_id_transaksi = $stmt_transaksi->insert_id; // ID transaksi terakhir

        // Query untuk menyimpan detail transaksi
        $query_detail = "INSERT INTO detail_transaksi (id_transaksi, id_produk, jumlah) VALUES (?, ?, ?)";
        $stmt_detail = $koneksi->prepare($query_detail);

        foreach ($items as $index => $nama_produk) {
            $jumlah_item = (int)($jumlah[$index] ?? 0);
            $id_produk_item = (int)($id_produk[$index] ?? 0);

            if ($jumlah_item > 0 && $id_produk_item > 0) {
                $stmt_detail->bind_param('iii', $last_id_transaksi, $id_produk_item, $jumlah_item);
                $stmt_detail->execute();
            }
        }

        // Redirect ke halaman pembayaran
        header("Location: transaksi.php?page=bayar&id_transaksi=$last_id_transaksi");
        exit;
    } else {
        // Tangani error pada penyimpanan transaksi
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = $stmt_transaksi->error;
        header("Location: transaksi.php?page=tampil");
        exit;
    }
}
?>
