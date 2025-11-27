<!-- Begin Page Content -->
<div class="container-fluid h-100 p-4 bg-white">


  <div class="card card-body border-0 p-0 mt-2">

    <div class="row">
      <div class="col-8">
        <div class="d-flex align-items-center justify-content-between">
          <?php
          $queryKategori = "
              SELECT * FROM kategori
          ";
          $resultKategori = mysqli_query($koneksi, $queryKategori);
          $kategori = $resultKategori->fetch_all(MYSQLI_ASSOC);
          ?>
          <div class="d-flex align-items-center">
            <h1 class="h4 mr-2">Daftar Menu</h1>
            <select class="form-control" id="category" style="max-width: max-content;">
              <option value="">Semua</option>
              <?php foreach ($kategori as $ktg): ?>
                <option value="<?= $ktg['id'] ?>"><?= $ktg['kategori'] ?></option>
              <?php endforeach; ?>
            </select>

          </div>

          <form action="">
            <input type="text" class="form-control" name="search" id="search" placeholder="Cari item..">
          </form>
        </div>

        <div class="row row-cols-1 row-cols-md-3 mt-3" id="wrapperKatalog">
          <?php
          $queryKatalog = "
              SELECT katalog.*, kategori.kategori AS nama_kategori
              FROM katalog
              JOIN kategori ON katalog.kategori_id = kategori.id
              ORDER BY katalog.id DESC
          ";
          $resultKatalog = mysqli_query($koneksi, $queryKatalog);
          $katalog = $resultKatalog->fetch_all(MYSQLI_ASSOC);
          ?>
          <?php if (!empty($katalog)) : ?>
            <?php foreach ($katalog as $k) : ?>
              <div class="col mb-4">
                <a class="card h-100 position-relative katalog" style="cursor: pointer;" data-nama="<?= $k['nama_produk'] ?>" data-id_produk="<?= $k['id'] ?>" data-harga="<?= $k['harga'] ?>">
                  <span class="position-absolute bg-primary2 text-white px-2 py-1 rounded text-capitalize" style="z-index: 10; top:10px; right:10px; font-size: 12px;">
                    <?= $k['stok'] ?>
                  </span>
                  <div class="rounded-circle overflow-hidden bg-white border ml-3 mt-2" style="z-index: 20; width: 70px; height: 70px;">
                    <img src="./uploads/<?= htmlspecialchars($k['gambar']) ?>" width="70" alt="">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title text-dark" style="font-size: 16px;"><?= htmlspecialchars($k['nama_produk']) ?></h5>
                    <p class="card-text text-black-50" style="font-size: 12px;"><?= htmlspecialchars($k['deskripsi']) ?></p>
                  </div>
                </a>
              </div>

            <?php endforeach; ?>
          <?php else : ?>
            <div class="col-12">
              <p class="text-center">Tidak ada data katalog yang tersedia.</p>
            </div>
          <?php endif; ?>
        </div>
      </div>


      <div class="col-4 p-3 pb-5 bg-gray-100 rounded" style="min-height: 60vh;">
        <div class="d-flex align-items-center justify-content-between">
          <h1 class="h6 text-gray-800 font-weight-bold">Buat Pesanan</h1>
          <!-- <button class="btn btn-warning btn-sm">Reset</button> -->
        </div>
        <hr>
        <form action="transaksi.php?page=proses" method="post">
          <input type="hidden" name="kasir" id="kasir" value="<?= $_SESSION['nama'] ?>">
          <input type="hidden" name="tanggal" id="tanggal">
          <input type="hidden" name="waktu" id="waktu">
          <input type="hidden" name="status" id="status" value="proses">
          <input type="hidden" name="nomor_transaksi" id="nomor_transaksi" value="">


          <div class="row mb-3">
            <div class="col-7">
              <div class="form-group">
                <label style="font-size: 14px;">Pelanggan</label>
                <input type="text" name="nama_pelanggan" class="form-control form-control-sm" id="nama_pelanggan" placeholder="" required>
              </div>
            </div>
            <div class="col-5">
              <div class="form-group">
                <label style="font-size: 14px;">Nomor Meja</label>
                <input type="text" name="nomor_meja" class="form-control form-control-sm" id="nomor_meja" placeholder="" required>
              </div>
            </div>
            <div class="col-12 d-flex align-items-center">
              <div class="form-group mr-3" style="max-width: 150px ;">
                <label style="font-size: 14px;">Telepon</label>
                <input type="text" name="telepon" class="form-control form-control-sm" id="telepon" placeholder="" required>
              </div>
              <div class="form-group" style="min-width: 180px;">
                <label style="font-size: 14px;">Jenis pesanan</label>
                <select name="jenis_pesanan" id="jenis_pesanan" class="form-control form-control-sm w-full">
                  <option value="dine_in" selected>Makan di tempat</option>
                  <option value="take_away">Take away</option>
                </select>
              </div>
            </div>


            <div class="col-12 px-0" id="wrapperDiskon">
              <div class="col-12 d-flex align-items-center mt-3">
                <?php
                $queryDiskon = "
              SELECT * FROM diskon
          ";
                $resultDiskon = mysqli_query($koneksi, $queryDiskon);
                $diskon = $resultDiskon->fetch_all(MYSQLI_ASSOC);
                ?>
                <label class="mr-3" style="font-size: 14px;">Diskon</label>

                <select name="diskon" id="diskon" class="form-control form-control-sm">
                  <option value="0" selected>-</option>
                  <?php foreach ($diskon as $d) : ?>
                    <option value="<?= $d['diskon'] ?>"><?= $d['keterangan'] ?> - <?= number_format($d['diskon']) ?>%</option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>


            <div class="col-12 mt-3" id="wrapperItem">

            </div>


            <div class="col-12 mt-3">
              <div class="form-group d-flex align-items-center justify-content-between">
                <label style="font-size: 14px;">Total</label>
                <input type="text" name="total_pembayaran" class="form-control form-control-sm bg-white" style="max-width: max-content;" id="total_pembayaran" placeholder="Rp." readonly required>
              </div>
            </div>

          </div>

          <div class="position-absolute row bg-primary2" style="bottom:0; width: 100%;">
            <button id="cetak-nota" type="button" style="font-size: 14px;" class="col-6 bg-transparent border-top-0 border-bottom-0 border-left-0 py-3 text-white font-weight-bold border-right">Cetak Nota</button>

            <button name="bayar" value="bayar" style="font-size: 14px;" class="col-6 bg-transparent border-0 py-3 text-white font-weight-bold">Bayar</button>

          </div>
        </form>

        <div id="nota-kasir" class="mx-auto bg-white p-5" style="display: none; font-family: Arial, sans-serif; top: 20px;">
          <h3 class="text-center" style="font-size: 4rem;">Nota Kasir</h3>
          <hr>
          <!-- Nomor meja -->
          <p class="text-center font-weight-bold" style="font-size: 3rem;"><span class="d-block font-weight-normal" style="font-size: 2rem;">Nomor Meja</span># <span id="nomorMeja">...</span></p>
          <p class="text-center text-uppercase font-weight-bold" style="font-size: 3rem;"><?= $_SESSION['nama']; ?></p>

          <p><small style="font-size: 1.5rem;" id="waktuSekarang"><?= date('d-m-Y H:i:s') ?></small></p>
          <hr>
          <p class="text-center" style="font-size: 2rem;">
            <span id="jenisPesanan">Makan di tempat</span>
          </p>
          <hr>
          <table style="width: 100%; border-collapse: collapse;">

            <tbody id="daftarItem">
              <!-- Item akan diisi secara dinamis -->
            </tbody>
          </table>

        </div>

      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->


<script>
  const currentDate = new Date();

  const dateInput = document.getElementById('tanggal');
  dateInput.value = currentDate.toISOString().split('T')[0];

  const timeInput = document.getElementById('waktu');
  timeInput.value = currentDate.toTimeString().split(' ')[0].slice(0, 5);
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    // Event untuk input search
    $('#search').on('keyup', function() {
      const query = $(this).val();
      const category = $('#category').val(); // Ambil kategori yang dipilih

      // Kirim request AJAX
      $.ajax({
        url: 'search.php',
        type: 'GET',
        data: {
          search: query,
          category: category
        },
        success: function(data) {
          $('#wrapperKatalog').html(data); // Update hasil katalog
        },
        error: function(xhr, status, error) {
          console.error(error);
        },
      });
    });

    // Event untuk select kategori
    $('#category').on('change', function() {
      const category = $(this).val();
      const query = $('#search').val(); // Ambil nilai input search

      // Kirim request AJAX
      $.ajax({
        url: 'search.php',
        type: 'GET',
        data: {
          search: query,
          category: category
        },
        success: function(data) {
          $('#wrapperKatalog').html(data); // Update hasil katalog
        },
        error: function(xhr, status, error) {
          console.error(error);
        },
      });
    });
  });
</script>

<script>
  $(document).ready(function() {
    const $wrapperDiskon = $('#wrapperDiskon');
    const $wrapperItem = $('#wrapperItem');
    const $notaKasir = $('#nota-kasir tbody');
    const $totalPembayaran = $('#total_pembayaran');
    const $diskonSelect = $('#diskon');
    const $nomorMejaInput = $('#nomor_meja'); // Input nomor meja
    const $jenisPesananSelect = $('#jenis_pesanan'); // Select jenis pesanan
    const $nomorMejaSpan = $('#nomorMeja'); // Span nomor meja
    const $jenisPesananSpan = $('#jenisPesanan'); // Span jenis pesanan
    const btnCetak = document.getElementById('cetak-nota')



    function calculateTotal() {
      let total = 0;

      $wrapperItem.find('.form-group').each(function() {
        const $jumlahInput = $(this).find('input[name="jumlah[]"]');
        const jumlah = parseInt($jumlahInput.val()) || 0;

        const $hargaInput = $(this).find('input[name="harga[]"]');
        const harga = parseFloat($hargaInput.val()) || 0;

        total += jumlah * harga;
      });

      const diskon = parseFloat($diskonSelect.val()) || 0;
      total = total - (total * (diskon / 100));
      $totalPembayaran.val(total.toFixed(2));
    }

    function toggleDiskonVisibility() {
      if ($wrapperItem.find('.form-group').length > 0) {
        $wrapperDiskon.show();
      } else {
        $wrapperDiskon.hide();
      }
    }

    function updateNotaKasir() {
      $notaKasir.empty(); // Kosongkan isi tabel sebelum memperbarui
      $wrapperItem.find('.form-group').each(function() {
        const namaProduk = $(this).find('input[name="nama_produk[]"]').val();
        const jumlah = $(this).find('input[name="jumlah[]"]').val();

        $notaKasir.append(`
        <tr>
          <td class="pb-3 pt-3 border-bottom" style="font-size: 2rem;">${namaProduk} x ${jumlah}</td>
        </tr>
      `);
      });

      // Perbarui span nomor meja
      const nomorMeja = $nomorMejaInput.val();
      $nomorMejaSpan.text(nomorMeja || '...');

      // Perbarui span jenis pesanan
      const jenisPesanan = $jenisPesananSelect.val();
      if (jenisPesanan === 'dine_in') {
        $jenisPesananSpan.text('Makan di tempat');
      } else if (jenisPesanan === 'take_away') {
        $jenisPesananSpan.text('Take away');
      } else {
        $jenisPesananSpan.text('...');
      }
    }

    $(document).on('click', '.katalog', function() {
      const namaProduk = $(this).data('nama');
      const idProduk = $(this).data('id_produk');
      const hargaProduk = $(this).data('harga');

      const existingItem = $wrapperItem
        .find(`input[name="id_produk[]"][value="${idProduk}"]`)
        .closest('.form-group');

      if (existingItem.length > 0) {
        const $jumlahInput = existingItem.find('input[name="jumlah[]"]');
        const currentValue = parseInt($jumlahInput.val()) || 0;
        $jumlahInput.val(currentValue + 1);
      } else {
        const inputGroup = `
        <div class="form-group d-flex align-items-center">
          <input type="text" name="nama_produk[]" class="form-control form-control-sm mr-2 bg-white" value="${namaProduk}" readonly>
          <input type="number" min="1" style="max-width: 60px;" name="jumlah[]" class="form-control form-control-sm mr-2" value="1">
          <input type="hidden" name="harga[]" value="${hargaProduk}">
          <input type="hidden" name="id_produk[]" value="${idProduk}">
          <button type="button" class="btn btn-danger btn-sm remove-item">Hapus</button>
        </div>
      `;
        $wrapperItem.append(inputGroup);
      }

      toggleDiskonVisibility();
      calculateTotal();
      updateNotaKasir();
    });

    $(document).on('click', '.remove-item', function() {
      $(this).closest('.form-group').remove();
      toggleDiskonVisibility();
      calculateTotal();
      updateNotaKasir();
    });

    $diskonSelect.on('change', function() {
      calculateTotal();
      updateNotaKasir();
    });

    $(document).on('input', 'input[name="jumlah[]"]', function() {
      calculateTotal();
      updateNotaKasir();
    });

    // Tambahkan event listener untuk input nomor meja
    $nomorMejaInput.on('input', function() {
      updateNotaKasir();
    });

    // Tambahkan event listener untuk select jenis pesanan
    $jenisPesananSelect.on('change', function() {
      updateNotaKasir();
    });
  });
</script>

<script>
  document.getElementById('cetak-nota').addEventListener('click', function(e) {
    e.preventDefault();

    const notaContainer = document.getElementById('nota-kasir');
    const width = screen.width;
    const height = screen.height;

    // Buka window baru dengan ukuran layar penuh
    const printWindow = window.open('', '', `width=${width},height=${height},top=0,left=0`);

    printWindow.document.write(`
      <!DOCTYPE html>
      <html>
      <head>
        <title>Cetak Nota</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
      </head>
      <body>
        ${notaContainer.innerHTML}
      </body>
      </html>
    `);

    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
  });
</script>

<script>
    function generateRandomString(length) {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let result = '';
        for (let i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return result;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const inputNomorTransaksi = document.getElementById('nomor_transaksi');
        inputNomorTransaksi.value = generateRandomString(8);
    });
</script>