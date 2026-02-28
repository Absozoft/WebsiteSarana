<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $_SESSION['error'] = "Method request tidak valid!";
    header("Location: data-pengaduan-admin.php");
    exit;
}

$pengaduan_id = isset($_POST['pengaduan_id']) ? intval($_POST['pengaduan_id']) : 0;
$pesan = isset($_POST['pesan']) ? trim($_POST['pesan']) : '';
$status = isset($_POST['status']) ? trim($_POST['status']) : '';

// Validasi
if (!$pengaduan_id || !$pesan || !$status) {
    $_SESSION['error'] = "Semua field harus diisi!";
    header("Location: detail-pengaduan.php?id=$pengaduan_id");
    exit;
}

$valid_status = ['pending', 'proses', 'selesai', 'ditolak'];
if (!in_array($status, $valid_status)) {
    $_SESSION['error'] = "Status tidak valid!";
    header("Location: detail-pengaduan.php?id=$pengaduan_id");
    exit;
}

$pesan_esc = mysqli_real_escape_string($koneksi, $pesan);
$tanggal_selesai = ($status === 'selesai') ? ", tanggal_selesai = '" . date('Y-m-d H:i:s') . "'" : '';

$query = "INSERT INTO feedback (pengaduan_id, pesan) VALUES ($pengaduan_id, '$pesan_esc');
          UPDATE pengaduan SET status = '$status'$tanggal_selesai WHERE id = $pengaduan_id";

if (mysqli_multi_query($koneksi, $query)) {
    $_SESSION['success'] = "Feedback berhasil ditambahkan!";
} else {
    $_SESSION['error'] = "Error: " . mysqli_error($koneksi);
}

header("Location: detail-pengaduan.php?id=$pengaduan_id");
exit;
?>
