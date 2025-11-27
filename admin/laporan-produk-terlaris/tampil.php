<!-- Begin Page Content -->
<div class="container-fluid p-4 h-100 bg-white">


  <div class="d-flex align-items-center justify-content-between">
    <h1 class="h4 text-gray-800">Laporan Produk Terlaris <span class="d-block font-weight-normal" style="font-size: 14px;">Cetak data laporan</span></h1>
    <!-- <a href="activities.php?page=tambah" class="btn btn-primary">Tambah</a> -->
    <div class="d-flex justify-content-end">
        <div>
          <a href="laporan-produk-terlaris.php?page=export" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> Cetak</a>
          <button type="button" class="btn btn-warning fs-5" data-toggle="modal" data-target="#exportBulanModal">
            Pilih Bulan
          </button>
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
      <th>Nama Produk</th>
      <th>Jumlah Terjual</th>
      <th>Pendapatan Dari Produk</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include_once '../config/koneksi.php';
    $no = 1;

    // Query untuk menghitung produk terlaris
    $query = "
      SELECT p.nama_produk, SUM(dt.jumlah) AS jumlah_terjual, SUM(dt.jumlah * p.harga) AS pendapatan
      FROM katalog p
      JOIN detail_transaksi dt ON p.id = dt.id_produk
      JOIN transaksi t ON t.id_transaksi = dt.id_transaksi
      GROUP BY p.id, p.nama_produk
      ORDER BY jumlah_terjual DESC;
    ";

    $result = mysqli_query($koneksi, $query);

    while ($row = mysqli_fetch_assoc($result)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $row['nama_produk']; ?></td>
        <td><?= $row['jumlah_terjual']; ?></td>
        <td>Rp<?= number_format($row['pendapatan'], 0, ',', '.'); ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>

  </div>

    </div>
  </div>

</div>
<!-- /.container-fluid -->

<div class="modal fade" id="exportBulanModal" tabindex="-1" aria-labelledby="exportBulanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exportBulanModalLabel">Pilih Bulan <span class="d-block font-weight-normal" style="font-size: 14px;">Pilih untuk mencetak data berdasarkan bulan dan tahun</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="laporan-produk-terlaris.php?page=exportbulan" method="get" id="print" target="_blank">
          <input type="hidden" name="page" value="exportbulan">
          <div class="form-group">
            <label for="Pilih Bulan">Bulan</label>
            <select class="custom-select" name="bulan">
              <option selected value="1">Januari</option>
              <option value="2">Februari</option>
              <option value="3">Maret</option>
              <option value="4">April</option>
              <option value="5">Mei</option>
              <option value="6">Juni</option>
              <option value="7">Juli</option>
              <option value="8">Agustus</option>
              <option value="9">September</option>
              <option value="10">Oktober</option>
              <option value="11">November</option>
              <option value="12">Desember</option>
            </select>
          </div>

          <div class="form-group">
            <label>Tahun</label>
            <input type="text" class="form-control" name="tahun" value="<?= date('Y') ?>">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" form="print"><i class="fas fa-file-pdf"></i> Print</button>
      </div>
    </div>
  </div>
</div>