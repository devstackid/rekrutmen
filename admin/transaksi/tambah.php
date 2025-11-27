 <?php
  ini_set('date.timezone', 'Asia/Makassar');
  ?>
 <!-- Begin Page Content -->
 <div class="container-fluid bg-white h-100 pt-4">

   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800">Data Transaksi Penjualan</h1>

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
         <form action="transaksi.php?page=proses" method="post">
           <div class="row">
             <div class="col-3">
               <div class="form-group">
                 <label>Tanggal</label>
                 <input type="date" name="tanggal" class="form-control" id="tanggal" placeholder="Tanggal..">
               </div>
             </div>
             <div class="col-3">
               <div class="form-group">
                 <label>Waktu</label>
                 <input type="time" name="waktu" class="form-control" id="waktu" placeholder="Waktu..">
               </div>
             </div>
             <!-- <div class="col-3">
               <div class="form-group">
                 <label>Total Pembayaran</label>
                 <input type="text" name="total_pembayaran" class="form-control" id="total_pembayaran" placeholder="Rp.">
               </div>
             </div> -->
             <div class="col-3">
               <div class="form-group">
                 <label>Metode Pembayaran</label>
                 <input type="text" name="metode_pembayaran" class="form-control" id="metode_pembayaran" placeholder="Metode Pembayaran..">
               </div>
             </div>
             <div class="col-3">
               <div class="form-group">
                 <label>Kasir</label>

                 <?php if ($_SESSION['role'] == 'admin') { ?>
                   <!-- Jika yang login adalah admin, tampilkan select dengan opsi -->
                   <select class="form-control" name="id_kasir">
                     <option value="">Pilih</option>
                     <?php
                      include_once '../config/koneksi.php';
                      $queryKasir = "SELECT * FROM users ORDER BY id DESC";
                      $resultKasir = mysqli_query($koneksi, $queryKasir);
                      while ($kasir = mysqli_fetch_assoc($resultKasir)) {
                      ?>
                       <option value='<?= $kasir['id']; ?>'><?= $kasir['nama']; ?></option>
                     <?php } ?>
                   </select>

                 <?php } else if ($_SESSION['role'] == 'kasir') { ?>
                   <!-- Jika yang login adalah kasir, tampilkan select dalam mode read-only -->
                   <input type="hidden" name="id_kasir" value="<?= $_SESSION['id']; ?>">
                   <select class="form-control" name="id_kasir" disabled>
                     <option value="<?= $_SESSION['id']; ?>" selected><?= $_SESSION['nama']; ?></option>
                   </select>
                 <?php } ?>

               </div>
             </div>
           </div>
           <button name="tambah" value="tambah" class="btn btn-primary">Simpan</button>
         </form>





       </div>
     </div>
   </div>

 </div>

 <script>
   const currentDate = new Date();

   const dateInput = document.getElementById('tanggal');
   dateInput.value = currentDate.toISOString().split('T')[0]; 

   const timeInput = document.getElementById('waktu');
   timeInput.value = currentDate.toTimeString().split(' ')[0].slice(0, 5);
 </script>

 <!-- <script>
   const totalPembayaranInput = document.getElementById('total_pembayaran');

   totalPembayaranInput.addEventListener('input', function(e) {
     let value = e.target.value.replace(/[^0-9]/g, '');

     value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

     e.target.value = 'Rp ' + value; 
   });

   totalPembayaranInput.addEventListener('focus', function(e) {
     e.target.value = e.target.value.replace(/^Rp /, ''); 
   });

   totalPembayaranInput.addEventListener('blur', function(e) {
     if (e.target.value !== '') {
       e.target.value = 'Rp ' + e.target.value.replace(/[^0-9.]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
     }
   });

   document.querySelector('form').addEventListener('submit', function(e) {
     const rawValue = totalPembayaranInput.value.replace('Rp ', '').replace(/\./g, '');
     document.getElementById('total_pembayaran').value = rawValue; 
   });
 </script> -->