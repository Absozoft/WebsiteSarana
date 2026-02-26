<?php
// Middleware untuk admin
include 'middleware.php';
include '../config/koneksi.php';

// Cek apakah ada parameter ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: kategori.php?pesan=ID tidak valid&status=gagal");
    exit();
}

$id = $_GET['id'];

// Cek apakah kategori dengan ID tersebut ada
$cek_query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id='$id'");
if (mysqli_num_rows($cek_query) === 0) {
    header("Location: kategori.php?pesan=Kategori tidak ditemukan&status=gagal");
    exit();
}

// Cek apakah kategori ini sedang digunakan oleh pengaduan
$cek_penggunaan = mysqli_query($koneksi, "SELECT COUNT(*) as jumlah FROM pengaduan WHERE kategori_id='$id'");
$data_penggunaan = mysqli_fetch_assoc($cek_penggunaan);

if ($data_penggunaan['jumlah'] > 0) {
    header("Location: kategori.php?pesan=Kategori tidak dapat dihapus karena masih digunakan oleh " . $data_penggunaan['jumlah'] . " laporan&status=gagal");
    exit();
}

// Hapus kategori
$sql = "DELETE FROM kategori WHERE id='$id'";

if (mysqli_query($koneksi, $sql)) {
    header("Location: kategori.php?pesan=Kategori berhasil dihapus&status=sukses");
    exit();
} else {
    header("Location: kategori.php?pesan=Gagal menghapus kategori: " . mysqli_error($koneksi) . "&status=gagal");
    exit();
}
?>
