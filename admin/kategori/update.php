<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data dari database berdasarkan ID
    $query = "SELECT * FROM kategori WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data tidak ditemukan!';
        header("Location: kategori.php?page=tampil");
        exit;
    }
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'ID tidak ditemukan!';
    header("Location: kategori.php?page=tampil");
    exit;
}
?>
<!-- Begin Page Content -->
<div class="container-fluid bg-white h-100 pt-4">
   <h1 class="h3 mb-4 text-gray-800">Ubah Data Kategori</h1>

   <div class="card card-body">
     <form action="kategori.php?page=proses_ubah" method="post">
        <input type="hidden" name="id" value="<?= $row['id']; ?>"> <!-- ID untuk identifikasi data -->
        <div class="row">
            
            <div class="col-3">
                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="kategori" class="form-control" id="kategori" value="<?= $row['kategori']; ?>">
                </div>
            </div>

            
        </div>
        <button name="ubah" value="ubah" class="btn btn-warning">Simpan Perubahan</button>
     </form>
   </div>
</div>
