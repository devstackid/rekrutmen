<!-- Begin Page Content -->
<div class="container-fluid p-4 h-100 bg-white">


  <div class="d-flex align-items-center justify-content-between">
    <h1 class="h4 text-gray-800">Laporan Penjualan <span class="d-block font-weight-normal" style="font-size: 14px;">Cetak data laporan</span></h1>
    <!-- <a href="activities.php?page=tambah" class="btn btn-primary">Tambah</a> -->
    <div class="d-flex justify-content-end">
      <div>
        <a href="laporan-penjualan.php?page=cetak" class="btn btn-danger" target="_blank"><i class="fas fa-file-pdf"></i> Cetak Semua</a>
        <button type="button" class="btn btn-warning fs-5" data-toggle="modal" data-target="#exportBulanModal">
          Opsi Cetak
        </button>
      </div>
    </div>
  </div>
  <!-- Page Heading -->

  <div class="modal fade" id="exportBulanModal" tabindex="-1" aria-labelledby="exportBulanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exportBulanModalLabel">Pilih Opsi <span class="d-block font-weight-normal" style="font-size: 14px;">Pilih untuk mencetak data berdasarkan periode, tanggal, tahun dan metode pembayaran</span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="laporan-penjualan.php?page=export" method="get" id="print" class="row" target="_blank">
            <div class="col-4">
              <input type="hidden" name="page" value="export">
              <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="number" min="1" max="31" class="form-control" name="tanggal" placeholder="opsional">
              </div>
            </div>
            <div class="form-group col-5">
              <label for="Pilih Bulan">Bulan</label>
              <select class="custom-select" name="bulan" required>
                <option value="1" selected>Januari</option>
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
            <div class="form-group col-3">
              <label>Tahun</label>
              <input type="text" class="form-control" name="tahun" value="<?= date('Y') ?>" required>
            </div>
            <div class="form-group col-12">
            <label for="metode">Metode Pembayaran</label>
              <select class="custom-select" name="metode">
                <option value="" selected>Semua</option>
                <option value="qris">QRIS</option>
                <option value="tunai">Tunai</option>
              </select>
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
              <th>Tanggal</th>
              <th>Total Item</th>
              <th>Total Pembayaran</th>
              <th>Metode Pembayaran</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $no = 1;

            $query = "
            SELECT t.id_transaksi, t.tanggal, t.total_pembayaran, t.metode_pembayaran, 
                   SUM(dt.jumlah) AS total_item
            FROM transaksi t
            JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
            GROUP BY t.id_transaksi, t.tanggal, t.total_pembayaran, t.metode_pembayaran;
        ";
            $result = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= date("d-m-Y", strtotime($row['tanggal'])); ?></td>
                <td><?= $row['total_item']; ?></td>
                <td>Rp<?= number_format($row['total_pembayaran'], 0, ',', '.'); ?></td>
                <td><?= $row['metode_pembayaran']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>

</div>
<!-- /.container-fluid -->