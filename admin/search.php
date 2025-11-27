<?php
require '../config/koneksi.php';

$search = $_GET['search'] ?? ''; // Input pencarian
$category = $_GET['category'] ?? ''; // ID kategori

// Query dasar
$queryKatalog = "
    SELECT katalog.*, kategori.kategori AS nama_kategori
    FROM katalog
    JOIN kategori ON katalog.kategori_id = kategori.id
    WHERE 1
";

// Tambahkan kondisi pencarian
if ($search !== '') {
    $queryKatalog .= " AND (katalog.nama_produk LIKE '%$search%' OR kategori.kategori LIKE '%$search%')";
}

// Tambahkan filter berdasarkan kategori
if ($category !== '') {
    $queryKatalog .= " AND kategori.id = '$category'";
}

$queryKatalog .= " ORDER BY katalog.id DESC";

$resultKatalog = mysqli_query($koneksi, $queryKatalog);
$katalog = $resultKatalog->fetch_all(MYSQLI_ASSOC);

if (!empty($katalog)) {
    foreach ($katalog as $k) {
        $namaProduk = htmlspecialchars($k['nama_produk'], ENT_QUOTES, 'UTF-8');
        $idProduk = htmlspecialchars($k['id'], ENT_QUOTES, 'UTF-8');
        $hargaProduk = htmlspecialchars($k['harga'], ENT_QUOTES, 'UTF-8');
        $stokProduk = htmlspecialchars($k['stok'], ENT_QUOTES, 'UTF-8');
        $gambarProduk = htmlspecialchars($k['gambar'], ENT_QUOTES, 'UTF-8');
        $deskripsiProduk = htmlspecialchars($k['deskripsi'], ENT_QUOTES, 'UTF-8');
    
        echo <<<HTML
        <div class="col mb-4">
            <a class="card h-100 position-relative katalog" 
               style="cursor: pointer;" 
               data-nama="{$namaProduk}" 
               data-id="{$idProduk}" 
               data-harga="{$hargaProduk}">
               
               <span class="position-absolute bg-primary text-white px-2 py-1 rounded text-capitalize" 
                     style="z-index: 10; top:10px; right:10px; font-size: 12px;">
                    {$stokProduk}
               </span>
               
               <div class="rounded-circle overflow-hidden bg-white border ml-3 mt-2" 
                    style="z-index: 20; width: 70px; height: 70px;">
                   <img src="./uploads/{$gambarProduk}" 
                        width="70" 
                        alt="Gambar produk {$namaProduk}">
               </div>
               
               <div class="card-body">
                   <h5 class="card-title text-dark" style="font-size: 16px;">{$namaProduk}</h5>
                   <p class="card-text text-black-50" style="font-size: 12px;">{$deskripsiProduk}</p>
               </div>
            </a>
        </div>
        HTML;
    }
    
} else {
    echo '<div class="col-12"><p>Item tidak ditemukan!</p></div>';
}
?>
