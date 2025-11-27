<?php
include '../config/koneksi.php';

if (isset($_POST['tambah'])) {
    // Ambil data dari form
    $kategori_id = $_POST['kategori_id'];
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];

    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    // Ambil informasi file yang diupload
    $gambar = $_FILES['gambar']['name'];
    $temp = $_FILES['gambar']['tmp_name'];
    $gambarPath = "./uploads/" . $gambar;

    // Inisialisasi variabel error
    $errors = [];

    // Validasi file gambar (wajib diisi dan harus berupa gambar)
    if (empty($gambar)) {
        $errors[] = "Gambar harus diupload.";
    } else {
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($gambar, PATHINFO_EXTENSION));

        if (!in_array($file_extension, $allowed_extensions)) {
            $errors[] = "Format file tidak valid. Harus jpg, jpeg, png, atau gif.";
        }
    }

    // Validasi kategori_id
    if (empty($kategori_id)) {
        $errors[] = "kategori harus diisi.";
    }
    if (empty($nama_produk)) {
        $errors[] = "nama produk harus diisi.";
    }

    // Validasi harga
    if (empty($harga)) {
        $errors[] = "Harga harus diisi.";
    }

    // Validasi deskripsi
    if (empty($deskripsi)) {
        $errors[] = "Deskripsi harus dipilih.";
    }

    // Validasi periode (harus tanggal valid, dan periode berakhir harus setelah periode awal)
    
    if (empty($stok)) {
        $errors[] = "Keterangan ketersediaan/stok produk harus diisi";
    }
    

    // Jika tidak ada error, lanjutkan proses penyimpanan
    if (empty($errors)) {
        // Pindahkan file gambar ke direktori yang sesuai
        if (move_uploaded_file($temp, $gambarPath)) {
            // Simpan data ke database
            $query = "INSERT INTO katalog (kategori_id, nama_produk, harga, stok, deskripsi, gambar) 
                      VALUES ($kategori_id, '$nama_produk', $harga, '$stok', '$deskripsi', '$gambar')";
            $result = mysqli_query($koneksi, $query);

            if ($result) {
                $_SESSION['result'] = 'success';
                $_SESSION['message'] = 'Data berhasil ditambahkan.';
                header("Location: katalog.php?page=tampil");
            } else {
                $_SESSION['result'] = 'error';
                $_SESSION['message'] = 'Gagal menambahkan data: ' . mysqli_error($koneksi);
                header("Location: katalog.php?page=tambah");
            }
        } else {
            $_SESSION['result'] = 'error';
            $_SESSION['message'] = 'Gagal mengupload gambar.';
            header("Location: katalog.php?page=tambah");
        }
    } else {
        // Jika ada error, simpan pesan error di session dan kembalikan ke halaman tambah
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = implode('<br>', $errors);
        header("Location: katalog.php?page=tambah");
    }
}
?>
