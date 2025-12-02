<!-- Begin Page Content -->
<div class="container-fluid h-100 p-4 bg-white">


  <div class="d-flex align-items-center justify-content-between mb-4">
    <h1 class="h4 text-gray-800">Data Seleksi Ditolak </h1>

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
              <th>Pelamar</th>
              <th>Posisi/Jabatan</th>
              <th>Tanggal</th>
              <th>Email</th>
              <th>Status</th>
              <th>Catatan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include_once '../config/koneksi.php';
            $no = 1;
            $query = "
SELECT 
    rekrutmen.*,
    pengguna.nama AS nama_pelamar,
    pengguna.nomor_telepon AS nomor_telepon,
    lowongan_kerja.judul AS judul_lowongan,
    bidang_pekerjaan.bidang_pekerjaan AS nama_bidang
FROM rekrutmen
JOIN pengguna 
    ON rekrutmen.pelamar_id = pengguna.id
JOIN lowongan_kerja 
    ON rekrutmen.lowongan_id = lowongan_kerja.id
JOIN bidang_pekerjaan 
    ON lowongan_kerja.bidang_pekerjaan_id = bidang_pekerjaan.id
    WHERE rekrutmen.status = 'ditolak'
ORDER BY rekrutmen.id DESC
";

            $result = mysqli_query($koneksi, $query);

            // define helper once to avoid redeclare errors
            if (!function_exists('format_date')) {
              function format_date($date)
              {
                if (empty($date) || $date === '0000-00-00') {
                  return '';
                }
                $ts = strtotime($date);
                if ($ts === false) {
                  return $date;
                }
                return date('d-m-Y', $ts);
              }
            }

            while ($row = mysqli_fetch_assoc($result)) {
            ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['nama_pelamar']; ?></td>
                <td><?= $row['nama_bidang']; ?></td>
                <td><?= format_date($row['tanggal']); ?></td>
                <td><?= $row['email']; ?></td>
                <td><?= $row['status']; ?></td>
                <td><?= $row['catatan']; ?></td>


              </tr>

            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->