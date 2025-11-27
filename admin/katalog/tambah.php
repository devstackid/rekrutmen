<?php
ini_set('date.timezone', 'Asia/Makassar');
?>
<!-- Begin Page Content -->
<div class="container-fluid bg-white h-100 pt-4">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Data Katalog Produk</h1>

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
        <form action="katalog.php?page=proses" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-3">
              <label class="mb-2">Pilih Gambar</label>
              <div class="custom-file mb-3">
                <input type="file" class="custom-file-input" name="gambar" id="gambar" required>
                <label class="custom-file-label" for="gambar">Choose file...</label>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control " id="nama_produk" placeholder="Nama Produk">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Kategori</label>
                <select class="form-control" name="kategori_id">
                  <option value="">Pilih</option>
                  <?php
                  include_once '../config/koneksi.php';
                  $queryKategori = "SELECT * FROM kategori ORDER BY id DESC";
                  $resultKategori = mysqli_query($koneksi, $queryKategori);
                  while ($kategori = mysqli_fetch_assoc($resultKategori)) {
                  ?>
                    <option value='<?= $kategori['id']; ?>'><?= $kategori['kategori']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Harga</label>
                <input type="text" name="harga" class="form-control " id="harga" placeholder="Harga">
              </div>
            </div>

            <div class="col-3">
              <div class="form-group">
                <label>Stok</label>
                <select class="form-control" name="stok" id="stok">
                  <option value="">Pilih</option>
                  <option value="tersedia">Tersedia</option>
                  <option value="habis">Habis</option>
                </select>
              </div>
            </div>

            <div class="col-9">
              <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
              </div>
            </div>

            

          </div>

          <button name="tambah" value="tambah" class="btn btn-primary">Simpan</button>
        </form>



      </div>
    </div>
  </div>

</div>