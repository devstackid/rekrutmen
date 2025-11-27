<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data dari database berdasarkan ID
    $query = "SELECT * FROM katalog WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data tidak ditemukan!';
        header("Location: katalog.php?page=tampil");
        exit;
    }
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'ID tidak ditemukan!';
    header("Location: katalog.php?page=tampil");
    exit;
}
?>
<!-- Begin Page Content -->
<div class="container-fluid bg-white h-100 pt-4">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Katalog Produk</h1>

    <div class="card card-body">
        <div class="row">
            <div class="col-12">
                <?php
                if (isset($_SESSION['result'])) {
                    if ($_SESSION['result'] == 'success') {
                ?>
                        <!-- Success -->
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['message'] ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Success -->
                    <?php
                    } else {
                    ?>
                        <!-- danger -->
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= $_SESSION['message'] ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- danger -->
                <?php
                    }
                    unset($_SESSION['result']);
                    unset($_SESSION['message']);
                }
                ?>

            </div>
            <div class="col-12">
                <form action="katalog.php?page=proses_ubah" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6 d-flex align-items-start mb-4">
                            <div class="rounded-circle mr-2 overflow-hidden flex-shrink-0" style="width: 100px; height: 100px;">
                                <img src="./uploads/<?= $row['gambar'] ?>" class="w-100" style="object-position: cover;" alt="">
                            </div>
                            <div>
                                <label class="mb-2">Pilih Gambar</label>
                                <div class="custom-file mb-3">
                                    <input type="file" class="custom-file-input" name="gambar" id="gambar">
                                    <label class="custom-file-label" for="gambar">Choose file...</label>
                                </div>
                            </div>

                            <input type="hidden" name="gambar_lama" value="<?= $row['gambar']; ?>">
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control " id="nama_produk" value="<?= $row['nama_produk']; ?>">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select class="form-control" name="kategori_id">
                                    <option value="">Pilih</option>
                                    <?php
                                    $queryKategori = "SELECT * FROM kategori ORDER BY id DESC";
                                    $resultKategori = mysqli_query($koneksi, $queryKategori);
                                    while ($kategori = mysqli_fetch_assoc($resultKategori)) {
                                        $selected = ($row['kategori_id'] == $kategori['id']) ? 'selected' : '';
                                    ?>
                                        <option value='<?= $kategori['id']; ?>' <?= $selected; ?>><?= $kategori['kategori']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Harga</label>
                                <input type="text" name="harga" class="form-control" id="harga" value="<?= $row['harga']; ?>">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Stok</label>
                                <select class="form-control" name="stok" id="stok">
                                    <option value="tersedia" <?= $row['stok'] == 'tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                                    <option value="habis" <?= $row['stok'] == 'habis' ? 'selected' : ''; ?>>Habis</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $row['deskripsi']; ?></textarea>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <button name="update" value="update" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>