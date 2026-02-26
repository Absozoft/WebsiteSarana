<?php 
// Middleware untuk admin
include 'middleware.php';
include '../config/koneksi.php';

$user_id = $_SESSION['user_id'];
$password_lama = $_POST['password_lama'];
$password_baru = $_POST['password_baru'];
$confirm_password = $_POST['confirm_password'];

// Validasi konfirmasi password
if ($password_baru !== $confirm_password) {
    header("Location: ubah-password.php?pesan=Password baru dan konfirmasi password tidak cocok&status=gagal");
    exit();
}

// Validasi panjang password minimal
if (strlen($password_baru) < 6) {
    header("Location: ubah-password.php?pesan=Password baru minimal 6 karakter&status=gagal");
    exit();
}

// Ambil data user dari tabel 'users' berdasarkan user_id
$query = mysqli_query(
    $koneksi,
    "SELECT * FROM users WHERE id='$user_id'"
);
$cek = mysqli_num_rows($query);
if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);
    // Verifikasi password lama
    if (password_verify($password_lama, $data['password'])) {
        // Hash password baru
        $password_baru_hashed = password_hash($password_baru, PASSWORD_DEFAULT);
        // Update password di database
        $update_query = mysqli_query(
            $koneksi,
            "UPDATE users SET password='$password_baru_hashed' WHERE id='$user_id'"
        );
        if ($update_query) {
            header("Location: ubah-password.php?pesan=Password berhasil diubah&status=sukses");
            exit();
        } else {
            header("Location: ubah-password.php?pesan=Gagal mengubah password&status=gagal");
            exit();
        }
    } else {
        header("Location: ubah-password.php?pesan=Password lama salah&status=gagal");
        exit();
    }
} else {
    header("Location: ubah-password.php?pesan=User tidak ditemukan&status=gagal");
    exit();
}

?>
