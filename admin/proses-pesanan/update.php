<?php
ini_set('date.timezone', 'Asia/Makassar');
include_once '../config/koneksi.php';

$id_detail = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_detail > 0) {
    $queryOldDetailTransaksi = "SELECT id_transaksi FROM detail_transaksi WHERE id_detail='$id_detail'";
    $resultOldDetailTransaksi = mysqli_query($koneksi, $queryOldDetailTransaksi);

    if ($resultOldDetailTransaksi && mysqli_num_rows($resultOldDetailTransaksi) > 0) {
        $fetchIdTransaksi = mysqli_fetch_assoc($resultOldDetailTransaksi);
        $id_transaksi = $fetchIdTransaksi['id_transaksi'];

        $queryOldTransaksi = "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'";
        $resultOldTransaksi = mysqli_query($koneksi, $queryOldTransaksi);

        if ($resultOldTransaksi && mysqli_num_rows($resultOldTransaksi) > 0) {
            $resultQueryTransaksi = mysqli_fetch_assoc($resultOldTransaksi);

            $tanggal = $resultQueryTransaksi['tanggal'];
            $waktu = $resultQueryTransaksi['waktu'];
            $metode_pembayaran = $resultQueryTransaksi['metode_pembayaran'];
            $total_pembayaran = $resultQueryTransaksi['total_pembayaran'];
        } else {
            echo "Data transaksi tidak ditemukan.";
        }
    } else {
        echo "Data detail transaksi tidak ditemukan.";
    }

    $queryDetailTransaksiById = "SELECT detail_transaksi.*, katalog.harga 
                             FROM detail_transaksi 
                             JOIN katalog ON detail_transaksi.id_produk = katalog.id 
                             WHERE id_detail='$id_detail'";
    $resultDetailTransaksiById = mysqli_query($koneksi, $queryDetailTransaksiById);

    if ($resultDetailTransaksiById && mysqli_num_rows($resultDetailTransaksiById) > 0) {
        $dataProduk = mysqli_fetch_assoc($resultDetailTransaksiById);
    } else {
        echo "Data Produk detail transaksi tidak ditemukan.";
    }
} else {
    echo "ID detail transaksi tidak valid.";
}
?>
<!-- Begin Page Content -->
<div class="container-fluid bg-white h-100 pt-4">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Detail Transaksi Penjualan</h1>

    <div class="card card-body">
        <div class="row">
            <div class="col-12">
                <?php
                if (isset($_SESSION['result'])) {
                    $alertType = $_SESSION['result'] == 'success' ? 'success' : 'danger';
                    echo "<div class='alert alert-$alertType alert-dismissible fade show' role='alert'>
                  <strong>{$_SESSION['message']}</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
                    unset($_SESSION['result'], $_SESSION['message']);
                }
                ?>
            </div>

            <div class="col-12">
                <form action="detail-transaksi.php?page=proses_ubah" method="post" id="transaksiForm">
                    <input type="hidden" name="id_detail" value="<?= $id_detail ?>">
                    <!-- Pilih Transaksi -->
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Pilih Transaksi</label>
                                <select class="form-control" name="id_transaksi" id="id_transaksi" onchange="updateFields()" readonly>
                                    <option value="">Pilih</option>
                                    <?php
                                    // Menentukan query berdasarkan peran user
                                    $queryTransaksi = ($_SESSION['role'] == 'admin') ?
                                        "SELECT transaksi.*, users.nama AS nama_kasir FROM transaksi JOIN users ON transaksi.id_kasir = users.id ORDER BY id_transaksi DESC" :
                                        "SELECT transaksi.*, users.nama AS nama_kasir FROM transaksi JOIN users ON transaksi.id_kasir = users.id WHERE id_kasir = '{$_SESSION['id']}' ORDER BY id_transaksi DESC";
                                    $resultTransaksi = mysqli_query($koneksi, $queryTransaksi);

                                    // Mengisi dropdown dengan opsi transaksi
                                    while ($transaksi = mysqli_fetch_assoc($resultTransaksi)) {
                                        // Cek jika transaksi adalah yang aktif
                                        $selected = ($transaksi['id_transaksi'] == $id_transaksi) ? 'selected' : '';
                                        echo "<option value='{$transaksi['id_transaksi']}' $selected>{$transaksi['tanggal']} | {$transaksi['waktu']} | {$transaksi['nama_kasir']} | {$transaksi['metode_pembayaran']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- Input Tanggal -->
                        <div class="col-3">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="<?= $tanggal ?>" id="tanggal" readonly>
                            </div>
                        </div>

                        <!-- Input Waktu -->
                        <div class="col-3">
                            <div class="form-group">
                                <label>Waktu</label>
                                <input type="time" name="waktu" class="form-control" id="waktu" value="<?= $waktu ?>" readonly>
                            </div>
                        </div>

                        <!-- Metode Pembayaran -->
                        <div class="col-3">
                            <div class="form-group">
                                <label>Metode Pembayaran</label>
                                <input type="text" name="metode_pembayaran" class="form-control" id="metode_pembayaran" value="<?= $metode_pembayaran ?>" readonly>
                            </div>
                        </div>

                    </div>

                    <div id="itemContainer">
                        <div class="row itemRow">
                            <!-- Pilih Produk -->
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Pilih Produk</label>
                                    <select class="form-control" name="id_produk">
                                        <option value="">Pilih</option>
                                        <?php
                                        $queryProduk = "SELECT * FROM katalog ORDER BY id DESC";
                                        $resultProduk = mysqli_query($koneksi, $queryProduk);
                                        while ($produk = mysqli_fetch_assoc($resultProduk)) {
                                            // Tentukan apakah produk ini yang harus dipilih
                                            $selected = ($produk['id'] == $dataProduk['id_produk']) ? 'selected' : '';
                                            echo "<option value='{$produk['id']}' $selected>{$produk['nama_produk']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <!-- Harga Satuan -->
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Harga Satuan</label>
                                    <input type="text" name="harga_per_unit" value="<?= $dataProduk['harga'] ?>" class="form-control harga_per_unit" readonly>
                                </div>
                            </div>

                            <!-- Jumlah Pembelian -->
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Jumlah</label>
                                    <input type="number" min="1" name="jumlah" value="<?= $dataProduk['jumlah'] ?>" class="form-control jumlah">
                                </div>
                            </div>

                            <!-- Subtotal -->
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Subtotal</label>
                                    <input type="text" name="subtotal" class="form-control subtotal" value="<?= $dataProduk['subtotal'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <button name="update" value="update" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- HTML -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        
        $(document).on('change', 'select[name="id_produk"]', function() {
            const id_produk = $(this).val();
            const row = $(this).closest('.itemRow');
            if (id_produk) {
                $.ajax({
                    url: 'get_product_data.php',
                    type: 'POST',
                    data: {
                        id_produk: id_produk
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data) {
                            row.find('.harga_per_unit').val(data.harga);
                            row.find('.subtotal').val('');
                        }
                    }
                });
            } else {
                row.find('.harga_per_unit, .subtotal').val(''); // Clear fields
            }
        });

        $(document).on('input', '.jumlah', function() {
            const row = $(this).closest('.itemRow');
            const harga_per_unit = parseFloat(row.find('.harga_per_unit').val()) || 0;
            const jumlah = parseFloat($(this).val()) || 0;
            const subtotal = harga_per_unit * jumlah;
            row.find('.subtotal').val(subtotal.toFixed(2));
            calculateTotal();
        });


        $('#id_transaksi').change(function() {
            const id_transaksi = $(this).val();
            if (id_transaksi) {
                $.ajax({
                    url: 'get_transaction_data.php',
                    type: 'POST',
                    data: {
                        id_transaksi: id_transaksi
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data) {
                            $('#tanggal').val(data.tanggal);
                            $('#waktu').val(data.waktu);
                            $('#metode_pembayaran').val(data.metode_pembayaran);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            } else {
                $('#tanggal, #waktu, #metode_pembayaran').val('');
            }
        });

    });
</script>


<script>
    function updateFields() {
        const selectedOption = document.getElementById('id_transaksi').selectedOptions[0];
        const [tanggal, waktu, namaKasir, metodePembayaran] = selectedOption.text.split(' | ');

        document.getElementById('tanggal').value = tanggal.trim();
        document.getElementById('waktu').value = waktu.trim();
        document.getElementById('metode_pembayaran').value = metodePembayaran.trim();
    }
</script>