<?php
include '../config/koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $kategori_id = $_POST['kategori_id'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];
    $gambar = $_FILES['gambar']['name'];
    $temp = $_FILES['gambar']['tmp_name'];
    $gambarPath = "./uploads/" . $gambar;
    $uploadDir = "./uploads/";

    // Jika gambar tidak diubah, tetap gunakan gambar lama
    if (empty($gambar)) {
        $gambar = $_POST['gambar_lama'];
    } else {
        $gambar_lama = $_POST['gambar_lama'];

        // Hapus gambar lama jika ada
        if (file_exists($uploadDir . $gambar_lama)) {
            unlink($uploadDir . $gambar_lama);
        }
        // Pindahkan file baru ke direktori upload
        move_uploaded_file($temp, $gambarPath);
    }

    // Query untuk update data
    $query = "UPDATE katalog 
              SET kategori_id = $kategori_id, nama_produk = '$nama_produk', harga = $harga,  stok = '$stok', deskripsi = '$deskripsi', gambar = '$gambar' 
              WHERE id = '$id'";

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil diupdate.';
        header("Location: katalog.php?page=tampil");
    } else {
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Gagal mengupdate data: ' . mysqli_error($koneksi);
        header("Location: katalog.php?page=ubah&id=$id");
    }
}
?>
