<?php
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan data dari database berdasarkan ID
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data tidak ditemukan!';
        header("Location: users.php?page=tampil");
        exit;
    }
} else {
    $_SESSION['result'] = 'error';
    $_SESSION['message'] = 'ID tidak ditemukan!';
    header("Location: users.php?page=tampil");
    exit;
}
?>
<!-- Begin Page Content -->
<div class="container-fluid bg-white h-100 pt-4">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Ubah Data Pengguna</h1>

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
        <form action="users.php?page=proses_ubah" method="post">
          <div class="row">
            <div class="col-3">
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="<?= $row['nama']; ?>">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Username / Email</label>
                <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?= $row['username']; ?>">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>No. Telepon</label>
                <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="Nomor Telepon" value="<?= $row['no_telp']; ?>">
              </div>
            </div>

            <div class="col-12">
              <div class="form-group">
                <label>Role</label>
                <select class="form-control" name="role" id="role">
                  <option value="">Pilih</option>
                  <option value="admin" <?= $row['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                  <option value="kasir" <?= $row['role'] == 'kasir' ? 'selected' : ''; ?>>Kasir</option>
                  <option value="owner" <?= $row['role'] == 'owner' ? 'selected' : ''; ?>>Owner</option>
                </select>
              </div>
            </div>

          </div>

          <!-- Hidden input untuk menyimpan ID pengguna -->
          <input type="hidden" name="id" value="<?= $row['id']; ?>">

          <button name="update" value="update" class="btn btn-primary">Ubah</button>
        </form>

      </div>
    </div>
  </div>

</div>

