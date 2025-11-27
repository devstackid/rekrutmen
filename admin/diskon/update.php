<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data dari database berdasarkan ID
    $query = "SELECT * FROM diskon WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data tidak ditemukan!';
        header("Location: diskon.php?page=tampil");
        exit;
    }
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'ID tidak ditemukan!';
    header("Location: diskon.php?page=tampil");
    exit;
}
?>
<!-- Begin Page Content -->
<div class="container-fluid bg-white h-100 pt-4">
   <h1 class="h3 mb-4 text-gray-800">Ubah Data Diskon</h1>

   <div class="card card-body">
     <form action="diskon.php?page=proses_ubah" method="post">
        <input type="hidden" name="id" value="<?= $row['id']; ?>"> <!-- ID untuk identifikasi data -->
        <div class="row">
            
            <div class="col-12">
                <div class="form-group">
                    <label>Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $row['keterangan']; ?>">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Diskon</label>
                    <input type="number" min="0" name="diskon" class="form-control" id="diskon" value="<?= $row['diskon']; ?>">
                </div>
            </div>

            
        </div>
        <a href="diskon.php?page=tampil" class="btn btn-warning">Batal</a>
        <button name="ubah" value="ubah" class="btn btn-primary">Simpan Perubahan</button>
     </form>
   </div>
</div>
