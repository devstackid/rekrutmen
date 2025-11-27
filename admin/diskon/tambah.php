 <?php
  ini_set('date.timezone', 'Asia/Makassar');
  ?>
 <!-- Begin Page Content -->
 <div class="container-fluid bg-white h-100 pt-4">

   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800">Data Diskon</h1>

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
         <form action="diskon.php?page=proses" method="post">
           <div class="row">
             
             <div class="col-12">
               <div class="form-group">
                 <label>Keterangan</label>
                 <input type="text" name="keterangan" class="form-control " id="keterangan" placeholder="Keterangan Diskon Produk..">
               </div>
             </div>
             <div class="col-12">
               <div class="form-group">
                 <label>Diskon</label>
                 <input type="number" min="0" name="diskon" class="form-control " id="diskon" placeholder="Besar diskon..">
               </div>
             </div>

             

           </div>

           <a href="diskon.php?page=tampil" class="btn btn-warning">Kembali</a>
           <button name="tambah" value="tambah" class="btn btn-primary">Simpan</button>
         </form>



       </div>
     </div>
   </div>

 </div>

 