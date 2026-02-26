<?php
session_start();
include '../config/koneksi.php';

// Validasi akses admin
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit();
}

// Validasi method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: daftar-akun.php");
    exit();
}

// Validasi input
if (!isset($_POST['id']) || empty($_POST['id'])) {
    header("Location: daftar-akun.php?error=ID tidak valid");
    exit();
}

$id = mysqli_real_escape_string($koneksi, $_POST['id']);
$username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
$nama_lengkap = mysqli_real_escape_string($koneksi, trim($_POST['nama_lengkap']));
$email = mysqli_real_escape_string($koneksi, trim($_POST['email']));
$nis = mysqli_real_escape_string($koneksi, trim($_POST['nis']));
$kelas = mysqli_real_escape_string($koneksi, trim($_POST['kelas']));
$role = mysqli_real_escape_string($koneksi, $_POST['role']);
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Validasi field required
if (empty($username) || empty($nama_lengkap) || empty($email)) {
    header("Location: edit-akun.php?id=$id&error=Semua field harus diisi");
    exit();
}

// Validasi email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: edit-akun.php?id=$id&error=Format email tidak valid");
    exit();
}

// Validasi role
if (!in_array($role, ['siswa', 'admin'])) {
    header("Location: edit-akun.php?id=$id&error=Role tidak valid");
    exit();
}

// Cek apakah username sudah digunakan oleh user lain
$check_username = mysqli_query($koneksi, "SELECT id FROM users WHERE username = '$username' AND id != '$id'");
if (mysqli_num_rows($check_username) > 0) {
    header("Location: edit-akun.php?id=$id&error=Username sudah digunakan");
    exit();
}

// Cek apakah email sudah digunakan oleh user lain
$check_email = mysqli_query($koneksi, "SELECT id FROM users WHERE email = '$email' AND id != '$id'");
if (mysqli_num_rows($check_email) > 0) {
    header("Location: edit-akun.php?id=$id&error=Email sudah digunakan");
    exit();
}

// Build query UPDATE
if (!empty($password)) {
    // Validasi panjang password
    if (strlen($password) < 6) {
        header("Location: edit-akun.php?id=$id&error=Password minimal 6 karakter");
        exit();
    }
    
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $update_query = "UPDATE users SET 
                     username = '$username',
                     nama_lengkap = '$nama_lengkap',
                     email = '$email',
                     nis = '$nis',
                     kelas = '$kelas',
                     role = '$role',
                     password = '$password_hashed'
                     WHERE id = '$id'";
} else {
    // Jika password kosong, jangan update password
    $update_query = "UPDATE users SET 
                     username = '$username',
                     nama_lengkap = '$nama_lengkap',
                     email = '$email',
                     nis = '$nis',
                     kelas = '$kelas',
                     role = '$role'
                     WHERE id = '$id'";
}

// Jalankan query
$result = mysqli_query($koneksi, $update_query);

if ($result) {
    header("Location: daftar-akun.php?success=Akun '$username' berhasil diperbarui");
    exit();
} else {
    header("Location: edit-akun.php?id=$id&error=Gagal memperbarui akun: " . mysqli_error($koneksi));
    exit();
}
?>
