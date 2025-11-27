<?php
ini_set('date.timezone', 'Asia/Makassar');

if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];

    include_once '../config/koneksi.php';
    $query = "SELECT * FROM transaksi WHERE id_transaksi = $id_transaksi";
    $result = mysqli_query($koneksi, $query);
    $dataTransaksi = mysqli_fetch_assoc($result);
}
?>

<!-- Begin Page Content -->
<div class="container-fluid bg-white h-100 pt-4">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Transaksi Penjualan</h1>

    <div class="card card-body">
        <div class="row">
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
            <div class="col-12">
                <form action="transaksi.php?page=proses_ubah" method="post">
                    <input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?= $dataTransaksi['tanggal'] ?>" placeholder="Tanggal..">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Waktu</label>
                                <input type="time" name="waktu" class="form-control" id="waktu" value="<?= $dataTransaksi['waktu'] ?>" placeholder="Waktu..">
                            </div>
                        </div>
                        
                        <div class="col-3">
                            <div class="form-group">
                                <label>Metode Pembayaran</label>
                                <input type="text" name="metode_pembayaran" class="form-control" id="metode_pembayaran" value="<?= $dataTransaksi['metode_pembayaran'] ?>" placeholder="Metode Pembayaran..">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Kasir</label>
                                <?php if ($_SESSION['role'] == 'admin') { ?>
                                    <select class="form-control" name="id_kasir">
                                        <option value="">Pilih</option>
                                        <?php
                                        $queryKasir = "SELECT * FROM users ORDER BY id DESC";
                                        $resultKasir = mysqli_query($koneksi, $queryKasir);
                                        while ($kasir = mysqli_fetch_assoc($resultKasir)) {
                                        ?>
                                            <option value='<?= $kasir['id']; ?>' <?= $kasir['id'] == $dataTransaksi['id_kasir'] ? 'selected' : ''; ?>><?= $kasir['nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } else if ($_SESSION['role'] == 'kasir') { ?>
                                    <input type="hidden" name="id_kasir" value="<?= $_SESSION['id']; ?>">
                                    <select class="form-control" name="id_kasir" disabled>
                                        <option value="<?= $_SESSION['id']; ?>" selected><?= $_SESSION['nama']; ?></option>
                                    </select>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <button name="ubah" value="ubah" class="btn btn-primary">Simpan Perubahan</button>
                    <input type="hidden" name="id_transaksi" value="<?= $id_transaksi ?>">
                </form>
            </div>
        </div>
    </div>
</div>


<!-- <script>
    const totalPembayaranInput = document.getElementById('total_pembayaran');

    totalPembayaranInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/[^0-9]/g, '');

        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        e.target.value = 'Rp ' + value;
    });

    totalPembayaranInput.addEventListener('focus', function(e) {
        e.target.value = e.target.value.replace(/^Rp /, '');
    });

    totalPembayaranInput.addEventListener('blur', function(e) {
        if (e.target.value !== '') {
            e.target.value = 'Rp ' + e.target.value.replace(/[^0-9.]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    });

    document.querySelector('form').addEventListener('submit', function(e) {
        const rawValue = totalPembayaranInput.value.replace('Rp ', '').replace(/\./g, '');
        document.getElementById('total_pembayaran').value = rawValue;
    });
</script> -->
