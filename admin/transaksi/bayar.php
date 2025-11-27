<!-- Begin Page Content -->
<?php
// include '../config/koneksi.php';

$id_transaksi = $_GET['id_transaksi'] ?? 0;
if (!$id_transaksi) {
    die("ID Transaksi tidak valid.");
}

// Query untuk mendapatkan data transaksi
$queryTransaksiId = "SELECT t.*, k.nama_produk, k.harga 
                     FROM transaksi t
                     LEFT JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
                     LEFT JOIN katalog k ON dt.id_produk = k.id
                     WHERE t.id_transaksi = ?";
$stmt_transaksi = $koneksi->prepare($queryTransaksiId);
$stmt_transaksi->bind_param('i', $id_transaksi);
$stmt_transaksi->execute();
$result_transaksi = $stmt_transaksi->get_result();
$data_transaksi_id = $result_transaksi->fetch_assoc();

// Query untuk detail transaksi
$queryDetail = "SELECT dt.jumlah, k.nama_produk, k.harga 
                FROM detail_transaksi dt
                JOIN katalog k ON dt.id_produk = k.id
                WHERE dt.id_transaksi = ?";
$stmt_detail = $koneksi->prepare($queryDetail);
$stmt_detail->bind_param('i', $id_transaksi);
$stmt_detail->execute();
$data_detail = $stmt_detail->get_result();
$details = $data_detail->fetch_all(MYSQLI_ASSOC);

$queryTotalHarga = "SELECT SUM(k.harga * dt.jumlah) AS total_harga 
                    FROM detail_transaksi dt
                    JOIN katalog k ON dt.id_produk = k.id
                    WHERE dt.id_transaksi = $id_transaksi";
$resultSubtotal = mysqli_query($koneksi, $queryTotalHarga);

// Ambil hasil query
if ($resultSubtotal) {
    $row = mysqli_fetch_assoc($resultSubtotal);
    $subtotal = $row['total_harga'];
}

// Validasi data
if (!$data_transaksi_id) {
    die("Transaksi tidak ditemukan.");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_transaksi = mysqli_real_escape_string($koneksi, $_POST['id_transaksi'] ?? '');
    $metode_pembayaran = mysqli_real_escape_string($koneksi, $_POST['metode_pembayaran'] ?? '');
    $jumlah_tunai = mysqli_real_escape_string($koneksi, $_POST['jumlah_tunai'] ?? '');
    $jumlah_qris = mysqli_real_escape_string($koneksi, $_POST['jumlah_qris'] ?? '');

    // Validasi nominal pembayaran
    $total_pembayaran = $data_transaksi_id['total_pembayaran'];

    $queryUpdate = "
            UPDATE transaksi SET 
                metode_pembayaran = '$metode_pembayaran'
            WHERE id_transaksi = '$id_transaksi'
        ";
        $resultUpdate = mysqli_query($koneksi, $queryUpdate);

        if ($resultUpdate) {
            $_SESSION['result'] = 'success';
            $_SESSION['message'] = 'Berhasil mencetak nota dan memperbarui transaksi.';
            header("Location: proses-pesanan.php?page=tampil");
            exit;
        } else {
            $_SESSION['result'] = 'error';
            $_SESSION['message'] = 'Gagal memperbarui transaksi.';
        }
}




?>
<div class="container-fluid h-100 p-4 bg-white">
    <div class="card card-body border-0 p-0 mt-2">
        <div class="row px-4">
            <!-- Detail Pesanan -->
            <div class="col-12">
                <?php
                if (isset($_SESSION['result'])) {
                    if ($_SESSION['result'] == 'success') {
                ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['message'] ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['message'] ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                <?php
                    }
                    unset($_SESSION['result']);
                    unset($_SESSION['message']);
                }
                ?>
            </div>
            <div class="col-4 p-3 pb-5 bg-gray-100 rounded" style="min-height: 60vh;">
                <div class="d-flex align-items-center justify-content-between">
                    <h1 class="h6 text-gray-800 font-weight-bold">Detail Pesanan</h1>
                </div>
                <hr>
                
                <?php if (!empty($data_transaksi_id['jenis_pesanan'])) : ?>
                    <?php if ($data_transaksi_id['jenis_pesanan'] === 'dine_in') : ?>
                        <span>Makan di tempat</span>
                    <?php elseif ($data_transaksi_id['jenis_pesanan'] === 'take_away') : ?>
                        <span>Take away</span>
                    <?php else : ?>
                        <span>Jenis pesanan tidak diketahui</span>
                    <?php endif; ?>
                <?php else : ?>
                    <span>Jenis pesanan belum ditentukan</span>
                <?php endif; ?>

                <hr>
                <?php if (!empty($details)): ?>
                    <?php foreach ($details as $detail): ?>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span><?= htmlspecialchars($detail['nama_produk']) ?></span>
                            <div class="">
                                <span><?= htmlspecialchars($detail['jumlah']) ?> x</span>
                                <span>Rp<?= number_format($detail['harga'], 0, ',', '.') ?></span>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Tidak ada item dalam transaksi ini.</p>
                <?php endif; ?>
                <div class="d-flex align-items-center justify-content-between mt-4">
                    <span>Diskon</span>
                    <span><?= htmlspecialchars($data_transaksi_id['diskon']) ?>%</span>
                </div>
                <hr>
                
                <div class="d-flex align-items-center justify-content-between mt-4">
                    <span>*Termasuk Pajak</span>
                </div>
                <hr>

                <div class="d-flex align-items-center justify-content-between">
                    <span>Total</span>
                    <span>Rp<?= number_format($data_transaksi_id['total_pembayaran'], 0, ',', '.') ?></span>
                </div>
            </div>
            <!-- Konfirmasi Pembayaran -->
            <div class="col-8 px-5 d-flex flex-column justify-content-center">
                <div>
                    <h1 class="text-center">Rp<?= number_format($data_transaksi_id['total_pembayaran'], 0, ',', '.') ?></h1>
                    <p class="text-center text-black-50">Jumlah yang harus dibayar</p>
                </div>

                <form action="" method="post" id="form-pembayaran">
                    <input type="hidden" name="id_transaksi" id="id_transaksi" value="<?= $id_transaksi ?>">
                    <input type="hidden" name="metode_pembayaran" id="metode_pembayaran" value="">

                    <h1 class="h6 text-center mt-5 mb-4">Metode Pembayaran</h1>
                    <div class="mb-3 w-100 d-flex align-items-center justify-content-center">
                        <button id="btn-tunai" type="button" class="btn btn-light shadow-sm mr-2 px-5 w-25">Tunai</button>
                        <button id="btn-qris" type="button" class="btn btn-light shadow-sm px-5 w-25">Qris</button>
                    </div>

                    <div class="form-group" id="input-tunai" style="display: none;">
                        <label style="font-size: 14px;">Tunai</label>
                        <input type="number" class="form-control" name="jumlah_tunai" id="jumlah_tunai" value="" placeholder="Rp." required>
                        <small id="kembalian" class="form-text text-muted" style="display: none;"></small>
                    </div>

                    <div id="input-qris" style="display: none;">
                        <input type="hidden" name="jumlah_qris" value="QRIS">
                    </div>


                    <button id="cetak-nota" type="button" name="update" class="btn btn-warning w-100 shadow-sm" style="display: none;">
                        Cetak Nota
                    </button>
                </form>

                <div id="nota-container" class="p-5 mx-auto w-50 " style="display:none; font-family: Arial, sans-serif; top: 20">
                    <h3 class="text-center">Nota Pembelian</h3>
                    <p class="text-center text-uppercase font-weight-bold"><span class="d-block text-capitalize">Nomor Meja :</span>#<?= $data_transaksi_id['nomor_meja'] ?></p>
                    <p class="text-center text-uppercase font-weight-bold"><?= $data_transaksi_id['kasir'] ?></p>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <img src="../../assets/img/hatara.jpg" width="150" alt="">
                    </div>
                    <p class="text-center" style="font-size: 12px;">Jl. Kembang Bakung No. 12 <span class="text-center d-block">Kota Banjarbaru</span>
                        <span class="text-center d-block">Telpon : 0895342715137</span>
                    </p>

                    <p><strong>No. Transaksi:</strong> <?= $data_transaksi_id['nomor_transaksi'] ?><span class="d-block"><strong>Waktu:</strong> <?= date('d-m-Y H:i:s') ?></span></p>

                    <hr>
                    <p class="text-center">
                        <?php if ($data_transaksi_id['jenis_pesanan'] === 'dine_in') : ?>
                            <span>Makan di tempat</span>
                        <?php elseif ($data_transaksi_id['jenis_pesanan'] === 'take_away') : ?>
                            <span>Take away</span>
                        <?php endif; ?>
                    </p>
                    <hr>
                    <table style="width: 100%; border-collapse: collapse;">

                        <tbody>
                            <?php foreach ($details as $detail) : ?>
                                <tr>
                                    <td><?= $detail['nama_produk'] ?> x <?= $detail['jumlah'] ?></td>
                                    <td class="text-right"><?= number_format($detail['harga'], 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="border-top">
                                <td class="font-weight-bold pt-2">Subtotal</td>
                                <td class="text-right pt-2">Rp.<?= number_format($subtotal, 0, ',', '.')?></td>

                            </tr>
                            <tr>
                                <td class="font-weight-bold">Diskon</td>
                                <?php if($data_transaksi_id['diskon'] > 0): ?>
                                <td class="text-right"><?= number_format($data_transaksi_id['diskon']) ?>%</td>
                                <?php else: ?>
                                    <td class="text-right">0%</td>
                                <?php endif; ?>

                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <small>*Sudah termasuk pajak</small>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h4><strong>Total </strong></h4>
                        <h4><strong>Rp<?= number_format($data_transaksi_id['total_pembayaran'], 0, ',', '.') ?> </strong></h4>
                    </div>

                    <hr>

                    <p class="text-center">Instagram : Hatara.coffee</p>
                    <p class="text-center">Terimakasih!</p>
                    <p class="font-weight-bold text-center"><?= $data_transaksi_id['nama_pelanggan'] ?></p>


                </div>
            </div>


        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script>
    const currentDate = new Date();

    const dateInput = document.getElementById('tanggal');
    if (dateInput) {
        dateInput.value = currentDate.toISOString().split('T')[0];
    }

    const timeInput = document.getElementById('waktu');
    if (timeInput) {
        timeInput.value = currentDate.toTimeString().split(' ')[0].slice(0, 5);
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    const totalPembayaran = <?= $data_transaksi_id['total_pembayaran'] ?>;

    const btnTunai = document.getElementById('btn-tunai');
    const btnQris = document.getElementById('btn-qris');
    const metodePembayaran = document.getElementById('metode_pembayaran');
    const inputTunai = document.getElementById('input-tunai');
    const jumlahTunai = document.getElementById('jumlah_tunai');
    const kembalianText = document.getElementById('kembalian');
    const btnCetak = document.getElementById('cetak-nota')

    function resetInputs() {
        inputTunai.style.display = 'none';
        kembalianText.style.display = 'none';
        kembalianText.textContent = '';
        jumlahTunai.value = '';
        jumlahTunai.classList.remove('border-success', 'border-danger');
        metodePembayaran.value = '';
        btnCetak.style.display = 'none';
    }

    btnTunai.addEventListener('click', function() {
        resetInputs();
        metodePembayaran.value = 'Tunai';
        inputTunai.style.display = 'block';
    });

    btnQris.addEventListener('click', function() {
        resetInputs();
        metodePembayaran.value = 'QRIS';
        btnCetak.style.display = 'block';
    });

    jumlahTunai.addEventListener('input', function() {
        const nominal = parseInt(jumlahTunai.value.replace(/\D/g, ''), 10) || 0;

        if (nominal < totalPembayaran) {
            jumlahTunai.classList.add('border-danger');
            jumlahTunai.classList.remove('border-success');
            kembalianText.style.display = 'none';
            btnCetak.style.display = 'none'
        } else {
            jumlahTunai.classList.add('border-success');
            jumlahTunai.classList.remove('border-danger');

            if (nominal > totalPembayaran || nominal == totalPembayaran) {
                const kembalian = nominal - totalPembayaran;
                kembalianText.textContent = `Kembalian: Rp${kembalian.toLocaleString('id-ID')}`;
                kembalianText.style.display = 'block';
                btnCetak.style.display = 'block'

            } else {
                kembalianText.style.display = 'none';
                btnCetak.style.display = 'none'

            }
        }
    });
</script>

<script>
    document.getElementById('cetak-nota').addEventListener('click', function(e) {
        e.preventDefault();

        // Tampilkan nota sebelum mencetak
        const notaContainer = document.getElementById('nota-container');
        notaContainer.style.display = 'block';

        // Ambil konten untuk dicetak
        const printContent = notaContainer.innerHTML;
        const originalContent = document.body.innerHTML;

        // Ganti konten body dengan nota
        document.body.innerHTML = printContent;

        // Cetak nota
        window.print();

        // Kembalikan konten asli
        document.body.innerHTML = originalContent;

        // Kirim form setelah mencetak
        document.getElementById('form-pembayaran').submit();
    });
</script>