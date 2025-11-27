<?php 
include '../config/koneksi.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $no_telp = $_POST['no_telp'];
    $role = $_POST['role'];

    // Mulai query dasar tanpa password
    $query = "UPDATE users SET nama = '$nama', username = '$username', no_telp = '$no_telp', role = '$role'";

    // Jika ada password baru, tambahkan dalam query
    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        $query .= ", password = '$password'";
    }

    // Tambahkan kondisi WHERE
    $query .= " WHERE id = '$id'";

    // Eksekusi query
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Buat pesan sukses dengan session
        $_SESSION['result'] = 'success';
        $_SESSION['message'] = 'Data berhasil diperbarui';

        header("Location:users.php");
    } else {
        // Buat pesan error dengan session
        $_SESSION['result'] = 'error';
        $_SESSION['message'] = 'Data gagal diperbarui';
        //refresh page
        header("Location:users.php?page=ubah&id=$id");
    }
}
