<?php
include '../config/koneksi.php';

$id_transaksi = $_GET['id_transaksi'];

// Query data transaksi
$queryTransaksi = "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'";
$data_transaksi = mysqli_query($koneksi, $queryTransaksi);
$transaksi = $data_transaksi->fetch_assoc();

$jenis_pesanan = $transaksi['jenis_pesanan'];
if($jenis_pesanan == 'dine_in'){
    $jenis_pesanan = 'Makan di tempat';
}else{
    $jenis_pesanan = 'Take away';
}

// Query data items
$queryItems = "
SELECT 
    d.*, 
    k.nama_produk, 
    k.harga 
FROM 
    detail_transaksi d
JOIN 
    katalog k 
ON 
    d.id_produk = k.id 
WHERE 
    d.id_transaksi = '$id_transaksi'";

$data_items = mysqli_query($koneksi, $queryItems);

if (!$data_items) {
    die("Query detail transaksi gagal: " . mysqli_error($koneksi));
}

$items = $data_items->fetch_all(MYSQLI_ASSOC);

?>


<!-- Begin Page Content -->
<div class="container-fluid h-100 p-4 bg-white">

    <div class="card card-body border-0 p-0 mt-2">
        <div class="row">
            <div class="col-12 mb-3">
                <h1 class="h4">Detail Pesanan</h1>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label style="font-size: 14px;">Nomor Transaksi</label>
                    <input type="text" class="form-control bg-white " value="<?= $transaksi['nomor_transaksi'] ?>" disabled>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label style="font-size: 14px;">Kasir</label>
                    <input type="text" class="form-control bg-white " value="<?= $transaksi['kasir'] ?>" disabled>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label style="font-size: 14px;">Nama Pelanggan</label>
                    <input type="text" class="form-control bg-white " value="<?= $transaksi['nama_pelanggan'] ?>" disabled>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label style="font-size: 14px;">Nomor Telepon</label>
                    <input type="text" class="form-control bg-white " value="<?= $transaksi['telepon'] ?>" disabled>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label style="font-size: 14px;">Nomor Meja</label>
                    <input type="text" class="form-control bg-white " value="<?= $transaksi['nomor_meja'] ?>" disabled>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label style="font-size: 14px;">Tanggal</label>
                    <input type="text" class="form-control bg-white " value="<?= $transaksi['tanggal'] ?> - <?= $transaksi['waktu'] ?>" disabled>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label style="font-size: 14px;">Status</label>
                    <input type="text" class="form-control bg-white " value="<?= $transaksi['status'] ?>" disabled>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label style="font-size: 14px;">Waktu Penyajian</label>
                    <input type="text" class="form-control bg-white " value="<?= $transaksi['waktu_penyajian'] ?>" disabled>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label style="font-size: 14px;">Jenis Pesanan</label>
                    <input type="text" class="form-control bg-white " value="<?= $jenis_pesanan ?>" disabled>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label style="font-size: 14px;">Diskon</label>
                    <input type="text" class="form-control bg-white " value="<?= $transaksi['diskon'] ?>%" disabled>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label style="font-size: 14px;">Metode Pembayaran</label>
                    <input type="text" class="form-control bg-white " value="<?= $transaksi['metode_pembayaran'] ?>" disabled>
                </div>
            </div>
            <div class="col-3">
                <label style="font-size: 14px;">Item Pesanan</label>
                <div class="row">
                    <?php foreach ($items as $item): ?>
                        <div class="col-11 border-bottom py-2 d-flex align-items-center justify-content-between">
                            <p><?= $item['nama_produk'] ?></p>
                            <p><span><?= $item['jumlah'] ?>x</span> <?= 'Rp ' . number_format($item['harga'], 0, ',', '.'); ?></p>
                        </div>

                    <?php endforeach; ?>
                    <div class="col-11 d-flex align-items-center justify-content-between py-2">
                        <p>Total Pembayaran</p>
                        <p class="font-weight-bold"><?= 'Rp ' . number_format($transaksi['total_pembayaran'], 0, ',', '.'); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->