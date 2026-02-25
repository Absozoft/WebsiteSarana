<?php
/**
 * Middleware untuk pengecekan login dan role admin
 * Harus di-include di awal file yang memerlukan proteksi admin
 */

session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login.php");
    exit();
}

// Cek apakah user memiliki role admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // Jika bukan admin, arahkan ke halaman dashboard user biasa atau halaman error
    header("Location: ../data-pengaduan.php");
    exit();
}

// Jika semua pengecekan lolos, script dapat melanjutkan
