<?php
// Middleware untuk admin
include 'middleware.php';
include '../config/koneksi.php';

// Ambil Data
$nama_kategori = trim($_POST['nama_kategori']);
$deskripsi = trim($_POST['deskripsi']);

// Validasi input
if (empty($nama_kategori) || empty($deskripsi)) {
    header("Location: input-kategori.php?pesan=Semua field harus diisi&status=gagal");
    exit();
}

// Cek apakah nama kategori sudah ada
$cek_query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE nama_kategori='$nama_kategori'");
if (mysqli_num_rows($cek_query) > 0) {
    header("Location: input-kategori.php?pesan=Nama kategori sudah ada&status=gagal");
    exit();
}

// masukan data tersebut ke table input aspirasi

$sql = "INSERT INTO kategori (`nama_kategori`, `deskripsi` ) VALUES ('$nama_kategori', '$deskripsi')";

if (mysqli_query($koneksi, $sql)) {
    header("Location: kategori.php?pesan=Kategori berhasil ditambahkan&status=sukses");
    exit();
} else {
    header("Location: input-kategori.php?pesan=Gagal menambahkan kategori: " . mysqli_error($koneksi) . "&status=gagal");
    exit();
}


?>