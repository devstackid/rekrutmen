<!-- Begin Page Content -->
<div class="container-fluid h-100 p-4 bg-white">


  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 text-gray-800">Data Proses Pesanan </h1>
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
              <th style="width: 50px;">No</th>
              <th>Nama Pelangan</th>
              <th>Waktu Transaksi</th>
              <th>Metode Pembayaran</th>
              <th>Total Transaksi</th>
              <th>Status Order</th>
              <th style="width: 150px;" class="not-export-col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $no = 1;
            $userId = $_SESSION['id'];
            $userRole = $_SESSION['role'];
            $query = "SELECT * FROM transaksi 
            ORDER BY id_transaksi DESC";

            $result = mysqli_query($koneksi, $query);

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_pelanggan']; ?></td>
                <td><?= $row['tanggal']; ?> <?= $row['waktu']; ?></td>
                <td class=""><?= $row['metode_pembayaran']; ?></td>
                <td><?= 'Rp ' . number_format($row['total_pembayaran'], 0, ',', '.'); ?></td>
                <td class=""><?= $row['status']; ?></td>


                <td class="not-export-col d-flex" style="flex-shrink: 0;">
                  <?php if($row['status'] == 'proses'): ?>
                  <a href="proses-pesanan.php?page=proses_ubah&id_transaksi=<?= $row['id_transaksi']; ?>" class="btn btn-sm btn-primary mr-1">Selesai</a>
                  <?php endif; ?>
                  <a href="proses-pesanan.php?page=detail&id_transaksi=<?= $row['id_transaksi'] ?>" class="btn btn-sm btn-warning mr-1">Detail</a>
                  <a href="proses-pesanan.php?page=hapus&id_transaksi=<?= $row['id_transaksi']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                </td>
              </tr>


            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->