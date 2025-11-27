<!-- Begin Page Content -->
<div class="container-fluid p-4 h-100 bg-white">


  <div class="d-flex align-items-center justify-content-between">
    <h1 class="h4 text-gray-800">Laporan Harian <span class="d-block font-weight-normal" style="font-size: 14px;">Cetak data laporan</span></h1>
    <div class="d-flex justify-content-end">
      <div>
        <a data-toggle="modal" data-target="#exportLaporanHarian" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Cetak</a>

      </div>
    </div>
  </div>

  <!-- export modal -->
  <div class="modal fade" id="exportLaporanHarian" tabindex="-1" aria-labelledby="exportLaporanHarianLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exportLaporanHarianLabel">Pilih metode pembayaran <span class="d-block font-weight-normal" style="font-size: 14px;">Pilih untuk mencetak data berdasarkan metode pembayaran</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="laporan-harian.php?page=export" method="get" id="print" target="_blank">
          <input type="hidden" name="page" value="export">
          <div class="form-group">
            <label for="metode">Pilih</label>
            <select class="custom-select" name="metode">
              <option value="" selected>Semua</option>
              <option value="tunai">Tunai</option>
              <option value="qris">Qris</option>
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
        <table class="table table-bordered" id="mytable" style="width: 100%;">
          <thead>
            <tr>
              <th>No</th>
              <th>Kasir</th>
              <th>Produk</th>
              <th>Jumlah</th>
              <th>Diskon</th>
              <th>Total Pembayaran</th>
              <th>Metode Pembayaran</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $no = 1;

            $query = "
      SELECT 
          t.id_transaksi,
          p.nama_produk AS produk,
          dt.jumlah,
          t.diskon,
          t.total_pembayaran,
          t.kasir,
          t.metode_pembayaran
      FROM 
          transaksi t
      JOIN 
          detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
      JOIN 
          katalog p ON dt.id_produk = p.id
      WHERE 
          DATE(t.tanggal) = CURDATE()
      ORDER BY 
          t.id_transaksi, dt.id_detail;
    ";

            $result = mysqli_query($koneksi, $query);
            $transactions = [];
            while ($row = mysqli_fetch_assoc($result)) {
              $transactions[$row['id_transaksi']][] = $row;
            }

            foreach ($transactions as $transactionId => $items) {
              $rowspan = count($items);
              $firstItem = true;

              foreach ($items as $item) {
                echo "<tr>";

                if ($firstItem) {
                  echo "<td rowspan='{$rowspan}'>{$no}</td>";
                  echo "<td rowspan='{$rowspan}'>{$item['kasir']}</td>";
                  echo "<td>{$item['produk']}</td>";
                  echo "<td>{$item['jumlah']}</td>";
                  echo "<td rowspan='{$rowspan}'>" . number_format($item['diskon'], 0, ',', '.') . "%</td>";
                  echo "<td rowspan='{$rowspan}'>" . number_format($item['total_pembayaran'], 0, ',', '.') . "</td>";
                  echo "<td rowspan='{$rowspan}'>{$item['metode_pembayaran']}</td>";
                  $no++;
                  $firstItem = false;
                } else {
                  echo "<td>{$item['produk']}</td>";
                  echo "<td>{$item['jumlah']}</td>";
                }

                echo "</tr>";
              }
            }
            ?>
          </tbody>
        </table>



      </div>

    </div>
  </div>

</div>
<!-- /.container-fluid -->




