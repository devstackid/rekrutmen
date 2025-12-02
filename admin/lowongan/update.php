<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data dari database berdasarkan ID
    $query = "SELECT * FROM lowongan_kerja WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data tidak ditemukan!';
        header("Location: lowongan.php?page=tampil");
        exit;
    }
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'ID tidak ditemukan!';
    header("Location: lowongan.php?page=tampil");
    exit;
}
?>
<!-- Begin Page Content -->
<div class="container-fluid bg-white h-100 pt-4">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Ubah Data Lowongan Pekerjaan</h1>

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
                <form action="lowongan.php?page=proses_ubah" method="post">
                    

                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" name="judul" class="form-control " id="judul" value="<?= $row['judul'] ?>" placeholder="Judul">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Bidang Pekerjaan</label>
                                <select class="form-control" name="bidang_pekerjaan_id">
                                    <option value="">Pilih</option>
                                    <?php
                                    include_once '../config/koneksi.php';
                                    $queryBidangPekerjaan = "SELECT * FROM bidang_pekerjaan ORDER BY id DESC";
                                    $resultBidangPekerjaan = mysqli_query($koneksi, $queryBidangPekerjaan);
                                    while ($bidang_pekerjaan = mysqli_fetch_assoc($resultBidangPekerjaan)) {
                                        $selected = ($row['bidang_pekerjaan_id'] == $bidang_pekerjaan['id']) ? 'selected' : '';
                                    ?>
                                        <option value='<?= $bidang_pekerjaan['id']; ?>' <?= $selected; ?>><?= $bidang_pekerjaan['bidang_pekerjaan']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $row['deskripsi'] ?></textarea>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label>Tanggal Buka</label>
                                <input type="date" name="tanggal_buka" class="form-control " id="tanggal_buka" value="<?= $row['tanggal_buka'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Tanggal Berakhir</label>
                                <input type="date" name="tanggal_berakhir" class="form-control " id="tanggal_berakhir" value="<?= $row['tanggal_berakhir'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Salary</label>
                                <input type="number" min="0" name="salary" class="form-control " id="salary" placeholder="Salary" value="<?= $row['salary'] ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Persyaratan</label>
                                <input type="text" name="persyaratan" class="form-control " id="persyaratan" placeholder="Persyaratan" value="<?= $row['persyaratan'] ?>">
                            </div>
                        </div>





                    </div>

                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <button name="update" value="update" class="btn btn-dark">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>