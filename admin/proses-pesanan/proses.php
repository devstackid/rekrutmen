<?php
session_start();
include_once '../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tambah'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $total_pembayaran = $_POST['total_pembayaran'];
    
    if (!empty($id_transaksi)) {
        // Loop melalui item transaksi yang diinputkan
        $id_produk_arr = $_POST['id_produk'];
        $harga_per_unit_arr = $_POST['harga_per_unit'];
        $jumlah_arr = $_POST['jumlah'];
        $subtotal_arr = $_POST['subtotal'];

        // Mulai transaksi SQL
        mysqli_begin_transaction($koneksi);

        try {
            foreach ($id_produk_arr as $index => $id_produk) {
                if (!empty($id_produk)) {
                    $harga_per_unit = $harga_per_unit_arr[$index];
                    $jumlah = $jumlah_arr[$index];
                    $subtotal = $subtotal_arr[$index];

                    // Query untuk memasukkan detail transaksi ke dalam tabel
                    $query = "INSERT INTO detail_transaksi (id_transaksi, id_produk, harga_per_unit, jumlah, subtotal)
                              VALUES ('$id_transaksi', '$id_produk', '$harga_per_unit', '$jumlah', '$subtotal')";
                    mysqli_query($koneksi, $query);
                }
            }

            // Update kolom total_transaksi dan status di tabel transaksi
            $updateQuery = "UPDATE transaksi SET total_pembayaran = '$total_pembayaran', status = 'selesai' WHERE id_transaksi = '$id_transaksi'";
            mysqli_query($koneksi, $updateQuery);

            // Commit transaksi
            mysqli_commit($koneksi);
            $_SESSION['result'] = 'success';
            $_SESSION['message'] = 'Data detail transaksi berhasil ditambahkan dan transaksi diperbarui.';
        } catch (Exception $e) {
            // Rollback jika ada kesalahan
            mysqli_rollback($koneksi);
            $_SESSION['result'] = 'error';
            $_SESSION['message'] = 'Gagal menambahkan data detail transaksi: ' . $e->getMessage();
        }

    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Transaksi belum dipilih.';
    }

    // Redirect setelah proses selesai
    header('Location: detail-transaksi.php?page=tampil');
    exit();
}
?>
