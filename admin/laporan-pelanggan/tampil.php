<!-- Begin Page Content -->
<div class="container-fluid p-4 h-100 bg-white">


  <div class="d-flex align-items-center justify-content-between">
    <h1 class="h4 text-gray-800">Laporan Data Pelanggan <span class="d-block font-weight-normal" style="font-size: 14px;">Cetak data laporan</span></h1>
    <!-- <a href="activities.php?page=tambah" class="btn btn-primary">Tambah</a> -->
    <div class="d-flex justify-content-end">
      <div>
        <a href="laporan-pelanggan.php?page=export" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> Cetak</a>
      </div>
    </div>
  </div>
  <!-- Page Heading -->


  <div class="card card-body border-0 p-0 mt-2">
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
        <table class="table table-bordered table-striped" id="mytable" style="width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Pelanggan</th>
              <th>Nomor telepon</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $no = 1;

            // Query untuk mendapatkan jumlah transaksi dan total pendapatan per metode pembayaran
            $query = "
      SELECT * FROM transaksi
    ";

            $result = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_pelanggan']; ?></td>
                <td><?= $row['telepon']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>


      </div>

    </div>
  </div>

</div>
<!-- /.container-fluid -->