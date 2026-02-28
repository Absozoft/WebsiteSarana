<?php
session_start();
include '../config/koneksi.php';

// Validasi akses admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Validasi parameter ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: daftar-akun.php");
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Cek apakah akun yang akan dihapus ada
$check_query = mysqli_query($koneksi, "SELECT username FROM users WHERE id = '$id'");
if (!$check_query || mysqli_num_rows($check_query) === 0) {
    header("Location: daftar-akun.php?error=Akun tidak ditemukan");
    exit();
}

$user_data = mysqli_fetch_assoc($check_query);
$username = $user_data['username'];

// Cegah admin menghapus dirinya sendiri
if ($id == $_SESSION['user_id']) {
    header("Location: daftar-akun.php?error=Anda tidak dapat menghapus akun sendiri");
    exit();
}

// Hapus data pengaduan user terlebih dahulu (foreign key constraint)
$delete_pengaduan = mysqli_query($koneksi, "DELETE FROM pengaduan WHERE user_id = '$id'");

if (!$delete_pengaduan) {
    header("Location: daftar-akun.php?error=Gagal menghapus data pengaduan");
    exit();
}

// Hapus akun user
$delete_query = mysqli_query($koneksi, "DELETE FROM users WHERE id = '$id'");

if ($delete_query) {
    header("Location: daftar-akun.php?success=Akun '$username' berhasil dihapus");
    exit();

    
} else {
    header("Location: daftar-akun.php?error=Gagal menghapus akun: " . mysqli_error($koneksi));
    exit();
}
?>
