<?php
// Middleware untuk admin
include 'middleware.php';
include '../config/koneksi.php';

// Cek apakah request method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: kategori.php?pesan=Akses tidak valid&status=gagal");
    exit();
}

// Ambil data dari form
$id = $_POST['id'];
$nama_kategori = trim($_POST['nama_kategori']);
$deskripsi = trim($_POST['deskripsi']);

// Validasi input
if (empty($id) || empty($nama_kategori) || empty($deskripsi)) {
    header("Location: edit-kategori.php?id=$id&pesan=Semua field harus diisi&status=gagal");
    exit();
}

// Cek apakah kategori dengan ID tersebut ada
$cek_query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id='$id'");
if (mysqli_num_rows($cek_query) === 0) {
    header("Location: kategori.php?pesan=Kategori tidak ditemukan&status=gagal");
    exit();
}

// Cek apakah nama kategori sudah digunakan oleh kategori lain
$cek_nama = mysqli_query($koneksi, "SELECT * FROM kategori WHERE nama_kategori='$nama_kategori' AND id != '$id'");
if (mysqli_num_rows($cek_nama) > 0) {
    header("Location: edit-kategori.php?id=$id&pesan=Nama kategori sudah digunakan&status=gagal");
    exit();
}

// Update data kategori
$sql = "UPDATE kategori SET 
        nama_kategori = '$nama_kategori', 
        deskripsi = '$deskripsi' 
        WHERE id = '$id'";

if (mysqli_query($koneksi, $sql)) {
    header("Location: kategori.php?pesan=Kategori berhasil diupdate&status=sukses");
    exit();
} else {
    header("Location: edit-kategori.php?id=$id&pesan=Gagal mengupdate kategori: " . mysqli_error($koneksi) . "&status=gagal");
    exit();
}
?>
