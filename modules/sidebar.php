<ul class="navbar-nav sidebar sidebar-dark accordion" style="border-right: 1px solid #d3d3d3; background-color: burlywood;" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <div class="position-relative " style="min-height: 30vh; background-image: url(../assets/img/kedai.jpg); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <div class="position-absolute bg-dark" style="top: 0; left:0; right:0; bottom:0; z-index:10; opacity: 40%;">

    </div>
    <a class="sidebar-brand d-flex align-items-center position-relative" style="z-index: 11;">
      <div class="sidebar-brand-icon">
        <td>
          <img src="../assets/img/hatara.jpg" height="40" alt="" class="gambar rounded-circle" style="border: 3px solid white;">
        </td>
      </div>
      <div class="sidebar-brand-text mx-3" style="font-weight: 400; font-size: 20px; font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;">Hatara </div>

    </a>
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="position-absolute text-center d-none d-md-inline" id="sidebarToggle" style="top: 20px; right: -60px; z-index: 50;">
      <button class="rounded-circle border-0 bg-white" style="outline: none; font-size: 18px;">
        <i class="fa fa-bars"></i>
      </button>
    </div>

    <h1 class="h6 text-center position-relative text-white mt-4" style="z-index: 11; font-size: 14px;">
      <span class="d-block">@<?= $_SESSION['username'] ?></span>
      <span class="d-block font-weight-normal"><?= $_SESSION['role'] ?></span>
    </h1>

  </div>


  <!-- Divider -->
  <!-- <hr class="sidebar-divider my-0"> -->

  <!-- Nav Item - Dashboard -->


  <!-- Divider -->
  <!-- <hr class="sidebar-divider"> -->

  <div class="sidebar-heading font-weight-normal text-white mt-4">
    Menu
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-database"></i>
      <span>Data Master</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <!-- <h6 class="collapse-header">Master Data:</h6> -->
        <?php if ($_SESSION['role'] == 'admin') : ?>
          <a class="collapse-item" href="users.php">Pengguna</a>
        <?php endif; ?>

        <a class="collapse-item" href="diskon.php">Diskon</a>
        <a class="collapse-item" href="kategori.php">Kategori</a>
        <a class="collapse-item" href="katalog.php">Katalog</a>
      </div>
    </div>
  </li>

  <!-- Nav Item - Utilities Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
      <i class="fas fa-cart-arrow-down"></i>
      <span>Transaksi</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="transaksi.php">Transaksi Pesanan</a>
        <a class="collapse-item" href="proses-pesanan.php">Pesanan Diproses</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#laporan" aria-expanded="true" aria-controls="laporan">
      <i class="fas fa-file"></i>
      <span>Laporan</span>
    </a>
    <div id="laporan" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="laporan-harian.php">Laporan Harian</a>

        <a class="collapse-item" href="laporan-penjualan.php">Laporan Penjualan</a>
        <?php if ($_SESSION['role'] == 'admin') : ?>
          <a class="collapse-item" href="laporan-pelanggan.php">Laporan Pelanggan</a>
          <a class="collapse-item" href="laporan-produk-terlaris.php">Laporan Produk Terlaris</a>
          <a class="collapse-item" href="laporan-penjualan-kategori.php">Kategori Pembelian</a>
        <?php endif; ?>
      </div>
    </div>
  </li>

  <!-- Heading -->




  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">



</ul>