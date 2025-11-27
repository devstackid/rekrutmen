<?php
ini_set('date.timezone', 'Asia/Makassar');
include_once '../config/koneksi.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid bg-white h-100 pt-4">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Tambah Detail Transaksi Penjualan</h1>

  <div class="card card-body">
    <div class="row">
      <div class="col-12">
        <?php
        if (isset($_SESSION['result'])) {
          $alertType = $_SESSION['result'] == 'success' ? 'success' : 'danger';
          echo "<div class='alert alert-$alertType alert-dismissible fade show' role='alert'>
                  <strong>{$_SESSION['message']}</strong>
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
          unset($_SESSION['result'], $_SESSION['message']);
        }
        ?>
      </div>

      <div class="col-12">
        <form action="detail-transaksi.php?page=proses" method="post" id="transaksiForm">

          <!-- Pilih Transaksi -->
          <div class="row">
          <div class="col-3">
              <div class="form-group">
                <label>Pilih Transaksi</label>
                <select class="form-control" name="id_transaksi" id="id_transaksi">
                  <option value="">Pilih</option>
                  <?php
                  $queryTransaksi = ($_SESSION['role'] == 'admin') ? 
                    "SELECT transaksi.*, users.nama AS nama_kasir FROM transaksi JOIN users ON transaksi.id_kasir = users.id WHERE status = 'proses' ORDER BY id_transaksi DESC" :
                    "SELECT transaksi.*, users.nama AS nama_kasir FROM transaksi JOIN users ON transaksi.id_kasir = users.id WHERE id_kasir = '{$_SESSION['id']}' AND status = 'proses' ORDER BY id_transaksi DESC";
                  $resultTransaksi = mysqli_query($koneksi, $queryTransaksi);
                  while ($transaksi = mysqli_fetch_assoc($resultTransaksi)) {
                    echo "<option value='{$transaksi['id_transaksi']}'>{$transaksi['tanggal']} | {$transaksi['waktu']} | {$transaksi['nama_kasir']} | {$transaksi['metode_pembayaran']}</option>";
                  }
                  ?>
                </select>
              </div>
            </div>

            <!-- Input Tanggal -->
            <div class="col-3">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" id="tanggal" readonly>
              </div>
            </div>

            <!-- Input Waktu -->
            <div class="col-3">
              <div class="form-group">
                <label>Waktu</label>
                <input type="time" name="waktu" class="form-control" id="waktu" readonly>
              </div>
            </div>

            <!-- Metode Pembayaran -->
            <div class="col-3">
              <div class="form-group">
                <label>Metode Pembayaran</label>
                <input type="text" name="metode_pembayaran" class="form-control" id="metode_pembayaran" readonly>
              </div>
            </div>
          </div>

          <div id="itemContainer">
            <div class="row itemRow">
              <!-- Pilih Produk -->
              <div class="col-3">
                <div class="form-group">
                  <label>Pilih Produk</label>
                  <select class="form-control" name="id_produk[]">
                    <option value="">Pilih</option>
                    <?php
                    $queryProduk = "SELECT * FROM katalog ORDER BY id DESC";
                    $resultProduk = mysqli_query($koneksi, $queryProduk);
                    while ($produk = mysqli_fetch_assoc($resultProduk)) {
                      echo "<option value='{$produk['id']}'>{$produk['nama_produk']}</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <!-- Harga Satuan -->
              <div class="col-3">
                <div class="form-group">
                  <label>Harga Satuan</label>
                  <input type="text" name="harga_per_unit[]" class="form-control harga_per_unit" readonly>
                </div>
              </div>

              <!-- Jumlah Pembelian -->
              <div class="col-3">
                <div class="form-group">
                  <label>Jumlah</label>
                  <input type="number" min="1" name="jumlah[]" class="form-control jumlah">
                </div>
              </div>

              <!-- Subtotal -->
              <div class="col-3">
                <div class="form-group">
                  <label>Subtotal</label>
                  <input type="text" name="subtotal[]" class="form-control subtotal" readonly>
                </div>
              </div>
            </div>
          </div>

          <!-- Input Total Pembayaran -->
          <div class="row mt-3">
            <div class="col-3">
              <div class="form-group">
                <label>Total Pembayaran</label>
                <input type="text" name="total_pembayaran" class="form-control" id="total_pembayaran" readonly>
              </div>
            </div>
          </div>

          <button type="button" class="btn btn-secondary" id="addItem">Tambah Item</button>
          <button name="tambah" value="tambah" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- HTML -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    function calculateTotal() {
        let total = 0;
        $('.subtotal').each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        $('#total_pembayaran').val(total.toFixed(2));
    }

    // Fungsi untuk menambahkan baris item baru
    $('#addItem').click(function() {
        const newRow = $('.itemRow:first').clone();
        newRow.find('input').val('');
        newRow.find('select').val('');
        $('#itemContainer').append(newRow);
    });

    // Mengisi data harga satuan dan subtotal ketika produk dipilih
    $(document).on('change', 'select[name="id_produk[]"]', function() {
        const id_produk = $(this).val();
        const row = $(this).closest('.itemRow');
        if (id_produk) {
            $.ajax({
                url: 'get_product_data.php',
                type: 'POST',
                data: { id_produk: id_produk },
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        row.find('.harga_per_unit').val(data.harga);
                        row.find('.subtotal').val('');
                        calculateTotal();
                    }
                }
            });
        } else {
            row.find('.harga_per_unit, .subtotal').val(''); // Clear fields
            calculateTotal();
        }
    });

    // Menghitung subtotal ketika jumlah diubah
    $(document).on('input', '.jumlah', function() {
        const row = $(this).closest('.itemRow');
        const harga_per_unit = parseFloat(row.find('.harga_per_unit').val()) || 0;
        const jumlah = parseFloat($(this).val()) || 0;
        const subtotal = harga_per_unit * jumlah;
        row.find('.subtotal').val(subtotal.toFixed(2));
        calculateTotal();
    });

    $('#id_transaksi').change(function() {
        const id_transaksi = $(this).val();
        if (id_transaksi) {
            $.ajax({
                url: 'get_transaction_data.php',
                type: 'POST',
                data: { id_transaksi: id_transaksi },
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        $('#tanggal').val(data.tanggal);
                        $('#waktu').val(data.waktu);
                        $('#metode_pembayaran').val(data.metode_pembayaran);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        } else {
            $('#tanggal, #waktu, #metode_pembayaran').val('');
        }
    });

});
</script>
